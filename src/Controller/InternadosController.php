<?php
// src/Controller/InternadosController.php

namespace App\Controller;

use Cake\I18n\Date;


class InternadosController extends AppController
{

	
	public function initialize()
    {
        parent::initialize();
        $this->loadComponent('Flash'); // Include the FlashComponent
    }

	public function index() 
	{
		
		$nomePaciente='';
		$query = $this->Internados->find('all');
		if($this->request->is('post')) {
			$nomePaciente = empty($this->request->data('nomePaciente')) ? $nomePaciente : h($this->request->data('nomePaciente')) ;
			if (!empty($nomePaciente)) $query = $query->where(['NM_PACIENTE like'=> '%'.h($nomePaciente).'%']);
		} 
		//pr($query);
		$this->set('internados',$query);
		$this->set('nomePaciente', $nomePaciente);
	}

	public function view($id = null) {}

	public function add(){}

	public function edit($id = null){}

	public function delete($id){}

}