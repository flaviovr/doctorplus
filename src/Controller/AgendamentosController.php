<?php

namespace App\Controller;

use Cake\I18n\Time;
use Cake\I18n\Date;
use Cake\Datasource\ConnectionManager;

class AgendamentosController extends AppController
{

	public $paginate = [
        'limit' => 12,
        'order' => [
            'Agendamentos.DT_CIRURGIA' => 'desc'
        ]
    ];

	public function initialize()
    {
        parent::initialize();
		//Inclui component Flash
        $this->loadComponent('Flash'); // Include the FlashComponent
		//$this->loadComponent('RequestHandler');
    }

	public function index()
	{
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
		$agendamentos = $this->Agendamentos->find('all')->contain(['Convenios'])->where(['PRESTADOR_ID =' => $idMedico]);

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
		// Se os dados forem incluídos, incluir o where para cada ;item;
		if (!empty($statusAgenda)) $agendamentos = $agendamentos->where(['STATUS_CHR ='=> h($statusAgenda)]);
		if (!empty($nomePaciente)) $agendamentos = $agendamentos->where(['NM_PACIENTE like'=> strtoupper('%'.h($nomePaciente).'%')]);
		if (!empty($dataAtual)) $agendamentos = $agendamentos->where(['DT_CIRURGIA ='=> $dataAtual]);

		// Defino as variáveis da view.
		$this->set('statusData',$this->Agendamentos->contaStatus());
		$this->set('agendamentos', $this->paginate($agendamentos));
		$this->set('statusAgenda', $statusAgenda);
		$this->set('dataAtual', $dataAtual);
		$this->set('nomePaciente', $nomePaciente);

	}

	public function novo()
	{
		$agendamento = $this->Agendamentos->newEntity();

		// Pego as especialidades do usuario e Array de espcialidades
		foreach (explode(',',$this->Auth->user('ESPECIALIDADES')) as $value) $esp[substr($value, 0, strpos($value, '-'))] = substr($value,strpos($value, '-')+1);

		$convenios = $this->Agendamentos->Convenios->find('list');

		if($this->request->is('post'))
		{
			// Funcão que adiciona as OBServações no Request no campo OBS_FINAL
			$this->Agendamentos->geraObs($this->request->data);

			// Formato valores
			$d = $this->request->data;

			if($this->Agendamentos->processaAgenda($d)) {
				$this->Flash->success('Artigo salvo com sucesso!');
	            return $this->redirect(['action' => 'index']);
			} else {
				$this->Flash->error('Erro ao salvar, tente novamente.');
			}


		}


		//Passo para view as variáveis
        $this->set(compact(['agendamento','esp','convenios']));
	}

	public function getPlano($id=0)
	{
		$this->loadModel('Convenios');
		$this->set('planos', $this->Convenios->Planos->find('list')->where(['CONVENIO_ID'=>$id])->toArray());
	}

	public function getPaciente($cpf=0)
	{
		$this->loadModel('Pacientes');
		$this->set('dados', $this->Pacientes->find('all')->where(['NR_CPF'=>$cpf])->first());
	}

	public function getCirurgia($nome='', $sexo = 'M')
	{
		$this->loadModel('Cirurgias');
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
		$this->set('dados',$dados);
	}

	public function view($id = null) {}

	public function edit($id = null){}

	public function delete($id){}

}
