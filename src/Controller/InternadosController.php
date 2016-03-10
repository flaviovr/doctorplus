<?php
// src/Controller/InternadosController.php

namespace App\Controller;

use Cake\I18n\Date;


class InternadosController extends AppController
{
	// public $paginate = [
    //     'limit' => 10,
    //     'order' => [
    //         'Internados.NM_PACIENTE' => 'asc'
    //     ]
    // ];

	public function initialize()
    {
        parent::initialize();
        // Incluir the FlashComponent
		$this->loadComponent('Flash');
    }

	public function index($busca = '')
	{
		//Defino variavel para o nome do paciente
		$nomePaciente='';

		// Crio o objeto de busca em todos os campos
		$query = $this->Internados->find();

		// Caso faca busca - POST -
		if($this->request->is('post')) {
			// Se usuario preencher o campo, jogo valor na variavel de busca e adiciono a condicao no objeto de busca
			$nomePaciente = empty($this->request->data('nomePaciente')) ? $nomePaciente : h($this->request->data('nomePaciente')) ;
			if (!empty($nomePaciente)) $query = $query->where(['NM_PACIENTE like'=> '%'.h($nomePaciente).'%']);
		}
		// Passo as variaveis para a views
		$this->set('internados',$query);
		$this->set('nomePaciente', $nomePaciente);
	}

	public function view($id = null) {}

	public function add(){}

	public function edit($id = null){}

	public function delete($id){}

}
