<?php
// src/Controller/AgendamentosController.php

namespace App\Controller;

use Cake\I18n\Date;


class AgendamentosController extends AppController
{

	
	public function initialize()
    {
        parent::initialize();
        $this->loadComponent('Flash'); // Include the FlashComponent
    }

	public function index() 
	{
		
		$dataAtual = new Date('today');
		$dataAtual = $dataAtual->format('Y-m-d');
		$statusAgenda = 'C';
		$idUser = $this->Auth->user('id');
		$nomePaciente=null;

		$agendamentos = $this->Agendamentos->find('all')->where(['CD_PRESTADOR =' => $idUser]);
		
		
		if($this->request->is('post')) {
			$statusAgenda = empty($this->request->data('statusAgenda')) ? '' : h($this->request->data('statusAgenda')) ;
			$dataAtual = empty($this->request->data('dataAtual')) ? '' : new date($this->Agendamentos->fdata($this->request->data('dataAtual'))) ;
			$dataAtual = $dataAtual!='' ? $dataAtual->format('Y-m-d') : '' ;
			$nomePaciente = empty($this->request->data('nomePaciente')) ? $nomePaciente : h($this->request->data('nomePaciente')) ;
		} 
		
		if (!empty($statusAgenda)) $agendamentos = $agendamentos->where(['STATUS_CHR ='=> h($statusAgenda)]);
		if (!empty($nomePaciente)) $agendamentos = $agendamentos->where(['NM_PACIENTE like'=> '%'.h($nomePaciente).'%']);
		if (!empty($dataAtual)) $agendamentos = $agendamentos->where(['DT_CIRURGIA ='=> $dataAtual]);
		
		
    	//pr($agendamentos);

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