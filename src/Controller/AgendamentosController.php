<?php
namespace App\Controller;

use Cake\I18n\Time;
use Cake\I18n\Date;
use Cake\Datasource\ConnectionManager;

class AgendamentosController extends AppController
{

	/* definições da paginação */
	public $paginate = [
        'limit' => 20,
        'order' => [
            'Agendamentos.DT_CIRURGIA' => 'desc'
        ]
    ];

	public function initialize() {
        parent::initialize();
		//Inclui component Flash
        $this->loadComponent('Flash'); // Include the FlashComponent

    }

	//Action que exibe detalhes do agendamento
	public function ver($id = null) {

		$db = ConnectionManager::get('default');

		// Verifico se foi passado um ID para ser exibido
		if(intval($id)>0) {
			//Caso um ID seja passado, Carrego o Registro referente ao ID incluindo suas tabelas relacionadas { Planos, Convenios }
			$agendamento = $this->Agendamentos->get($id, [ 'contain' => ['Convenios', 'Planos' => function($q){
						return $q->where(['Planos.CONVENIO_ID = Agendamentos.CONVENIO_ID' ]);
					}] ]);

			// Carregos os ítens da guia caso seja Pendente ou Confirmada
			$guias = array();
			if($agendamento->STATUS_CHR=='P' || $agendamento->STATUS_CHR=='C'){
				$data1 = $db->query("select a.TP_GUIA TIPO,  CD_GUIA, 'GUIA DE ' ||DECODE(a.tp_guia,'O','OPME','I','INTERNAÇÃO','C','CONSULTA','P','PROCEDIMENTO','R','PRORROGAÇÃO',a.tp_guia) || a.ds_justificativa justificativa, a.NR_GUIA, a.CD_SENHA, DECODE(a.TP_SITUACAO,'N','Negada', 'P','Pendente', 'A','Autorizada', 'G','Em Negociação', 'C','Entre em contato', 'S','Entre em Contato', a.TP_SITUACAO) AS Situacao FROM dbamv.guia@DBLINK_SOULPRD a WHERE a.cd_aviso_cirurgia = ".$agendamento->AVISO_ID)->fetchAll();
				foreach ($data1 as $guia) {
					$guias[$guia['JUSTIFICATIVA']]['dados'] = $guia;
					$guias[$guia['JUSTIFICATIVA']]['items'] = $db->query('select pf.ds_pro_fat, QT_AUTORIZADO, QT_AUTORIZADA_CONVENIO, ig.cd_pro_fat from dbamv.it_guia@DBLINK_SOULPRD ig left join dbamv.guia@DBLINK_SOULPRD g on g.cd_guia = ig.cd_guia left join dbamv.pro_fat@DBLINK_SOULPRD pf on pf.cd_pro_fat = ig.cd_pro_fat where g.cd_guia = '.$guia['CD_GUIA'])->fetchAll();
				}
			}
			// Defino a variável na view
			$this->set(compact(['guias','agendamento']));
			$this->set('statusData',$this->Agendamentos->contaStatus());
		} else {
			// Caso ID não seja passado, redireciono para index
			return $this->redirect(['controller'=>'agendamentos', 'action'=>'index']);
		}
	}

	// Action Principal, listagem de agendamentos
	public function index() {
		//Gero e Formato data atual para busca padrao
		$dataAtual = new Time('today');
		$dataAtual = $dataAtual->format('d/m/Y');


		// Defino Status padrão da busca
		$statusAgenda = 'C';

		// Pego id do usuário para busca
		$idMedico = $this->Auth->user('ID');

		//Limpo a variável de nomeaciente
		$nomePaciente=null;

		// Crio objeto de busca filtrando por medico
		$agendamentos = $this->Agendamentos->find('all')->contain(['Convenios'])->where(['PRESTADOR_ID =' => $idMedico])->order( ['DT_SUG_CIR' => 'DESC'] );

		// No caso de GET, efetua busca
		if($this->request->is('get')) {
			//Se usuário preencheu status, define a variavel de busca com o valor
			$statusAgenda = empty($this->request->query('statusAgenda')) ? '' : h($this->request->query('statusAgenda')) ;
			//Se usuário preencheu data e formata, define a variavel de busca com o valor
			$dataAtual = empty($this->request->query('dataAtual')) ? '' : new date($this->Agendamentos->fdata($this->request->query('dataAtual'))) ;
			$dataAtual = $dataAtual!='' ? $dataAtual->format('d/m/Y') : '' ;
			//Se usuário preencheu nome, define a variavel de busca com o valor
			$nomePaciente = empty($this->request->query('nomePaciente')) ? $nomePaciente : h($this->request->query('nomePaciente')) ;
		}

		// Se os filtros para busca forem preenchidos, incluir o where para cada item
		if (!empty($statusAgenda)) $agendamentos = $agendamentos->where(['STATUS_CHR ='=> h($statusAgenda)]);
		if (!empty($nomePaciente)) $agendamentos = $agendamentos->where(['NM_PACIENTE like'=> strtoupper('%'.h($nomePaciente).'%')]);
		if (!empty($dataAtual)) $agendamentos = $agendamentos->where(["to_char(DT_SUG_CIR,'dd/mm/YYYY') ="=> $dataAtual]);

		//debug($agendamentos);

		// Defino as variáveis da view.
		$this->set('statusData',$this->Agendamentos->contaStatus());
		$this->set('agendamentos', $this->paginate($agendamentos));
		$this->set('statusAgenda', $statusAgenda);
		$this->set('dataAtual', $dataAtual);
		$this->set('nomePaciente', $nomePaciente);

	}

	// Action para inclusão de novo Agendamento
	public function novo(){

		//Crio uma nova entidade para ser usada no form
		$agendamento = $this->Agendamentos->newEntity();

		// Pego as especialidades do usuario e Array de espcialidades
		foreach (explode(',',$this->Auth->user('ESPECIALIDADES')) as $value) $esp[substr($value, 0, strpos($value, '-'))] = substr($value,strpos($value, '-')+1);

		// Gero a lista de Convênios
		$convenios = $this->Agendamentos->Convenios->find('list');

		// Gero a lista de Planos em branco
		$planos = array();

		if($this->request->is('post'))
		{

			//Atribuo o request a variavel $d
			$d = $this->request->data;

			// Preparo para salvamento para executar as validações
			$agendamento = $this->Agendamentos->patchEntity($agendamento, $d);

			//Executo Função do Model que trata erros para exibição
			$erros = $this->Agendamentos->trataErros($agendamento->errors());

			if($this->Agendamentos->validaDuplicado($d)){

				//Caso nenhum erro de validação for encontrado
				if( empty($agendamento->errors())) {

						// Executo Função do Model que Formata os dados para salvar
						 $this->Agendamentos->preparaDados($d);

						// SAlvo dados - funcao retorna erros como string
						 $ok = $this->Agendamentos->salvaDados($d);

						//Faço Upload dos arquivos de LAUDO
						$this->Agendamentos->upload($d, 'LAUDO');
						$this->Agendamentos->upload($d, 'OPME');
						$this->Agendamentos->upload($d, 'PEDIDO');

						if($ok === true) {
							// Caso salve sem erros, exibo mensagem e redireciono para principal
							$this->Flash->success('Agendamento marcado com sucesso!');
							return $this->redirect(['action' => 'index']);
						} else {
							// Caso existam erros a Funcao Salvar Dados, exibo os erros
							$this->Flash->error($ok);
						}
				} else {
					// Caso existam erros de validação, exibo os erros
					$this->Flash->error($erros);
				}
			} else {
				// Caso existam erros a Funcao Salvar Dados, exibo os erros
				$this->Flash->error('Já existem um agendamento com o mesmo Procedimento/Paciente nesse dia.');
			}
			// Carrego os dados de Planos caso Convenio tenha sido selecionado
			$planos = $this->Agendamentos->Planos->find('list')->where(['CONVENIO_ID'=>$this->request->data('CONVENIO_ID')])->toArray();
			// Carrego a lista de cirurgias disponiveis
			$cirurgias = $this->Agendamentos->Cirurgias->find('list')->toArray();
		}
		//Defino as variáveis na View
        $this->set(compact(['agendamento','esp','convenios', 'cirurgias','planos']));

	}

	/*
	 * Função usada para consultas Ajax para listar Planos no select
 	 * $id = Id do Convenio Selecionado
	 */
	public function getPlano($id=0) {
		//Carrego o model de Convenios
		$this->loadModel('Convenios');
		// Defino a variavel de planos na view
		$this->set('planos', $this->Convenios->Planos->find('list')->where(['CONVENIO_ID'=>$id])->toArray());
	}

	/*
	 * Função usada para consultas Ajax para buscar dados do Paciente
	 * $cpf = CPF do paciente a ser consultado
	 */
	public function getPaciente($cpf=0)	{
		//Carrego o model de Convenios
		$this->loadModel('Pacientes');
		// Defino a variavel de Pacientes na view
		$this->set('dados', $this->Pacientes->find('all')->where(['NR_CPF'=>$cpf])->first());
	}

	/*
	 * Função usada para consultas Ajax para buscar Cirurgias
	 * $nome = Nome parcial da cirurgia a se buscar
	 * $sexo = Sexo do paciente, para filtrar cirurgias disponíveis para seu genero
	 */
	public function getCirurgia($nome='', $sexo = 'M'){
		//Carrego o model de Convenios
		$this->loadModel('Cirurgias');
		// Carrego os dados do convenio
		$dados = $this->Cirurgias->find('all', [
			'fields' => ['DS_CIRURGIA','CD_CIRURGIA'],
			'conditions' => [
				'DS_CIRURGIA LIKE' => '%'.strtoupper($nome).'%',
				'OR' => [
					['TP_SEXO' => 'A'],
					['TP_SEXO' => strtoupper($sexo)]
				]
			]
		]);
		//Defino a variavel na view
		$this->set('dados',$dados);
	}

}
