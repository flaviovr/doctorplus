<?php

namespace App\Controller;

use Cake\I18n\Date;


class AgendamentosController extends AppController
{

	public function initialize()
    {
        parent::initialize();
		//Inclui component Flash
        $this->loadComponent('Flash'); // Include the FlashComponent
    }

	public function index()
	{
		//Gero e Formato data atual para busca padrao
		$dataAtual = new Date('today');
		$dataAtual = $dataAtual->format('Y-m-d');

		// Defino Status padrão da busca
		$statusAgenda = 'C';

		// Pego id do usuário para busca
		$idUser = $this->Auth->user('id');

		//Limpo a variável de nomeaciente
		$nomePaciente=null;

		// Crio objeto de busca filtrando por medico
		$agendamentos = $this->Agendamentos->find('all')->where(['CD_PRESTADOR =' => $idUser]);

		// No caso de POST, efetua busca
		if($this->request->is('post')) {
			//Se usuário preencheu status, define a variavel de busca com o valor
			$statusAgenda = empty($this->request->data('statusAgenda')) ? '' : h($this->request->data('statusAgenda')) ;

			//Se usuário preencheu data e formata, define a variavel de busca com o valor
			$dataAtual = empty($this->request->data('dataAtual')) ? '' : new date($this->Agendamentos->fdata($this->request->data('dataAtual'))) ;
			$dataAtual = $dataAtual!='' ? $dataAtual->format('Y-m-d') : '' ;

			//Se usuário preencheu nome, define a variavel de busca com o valor
			$nomePaciente = empty($this->request->data('nomePaciente')) ? $nomePaciente : h($this->request->data('nomePaciente')) ;
		}
		// Se os dados forem incluídos, incluir o where para cada ;item;
		if (!empty($statusAgenda)) $agendamentos = $agendamentos->where(['STATUS_CHR ='=> h($statusAgenda)]);
		if (!empty($nomePaciente)) $agendamentos = $agendamentos->where(['NM_PACIENTE like'=> '%'.h($nomePaciente).'%']);
		if (!empty($dataAtual)) $agendamentos = $agendamentos->where(['DT_CIRURGIA ='=> $dataAtual]);

		// Defino as variáveis da view.
		$this->set('statusData',$this->Agendamentos->contaStatus());
		$this->set(compact('agendamentos'));
		$this->set('statusAgenda', $statusAgenda);
		$this->set('dataAtual', $this->Agendamentos->fdata($dataAtual));
		$this->set('nomePaciente', $nomePaciente);
	}

	public function view($id = null) {}

	public function add(){}

	public function edit($id = null){}

	public function delete($id){}

}
