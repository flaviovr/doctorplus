<?php
// src/Controller/InternadosController.php

namespace App\Controller;

use Cake\I18n\Date;


class InternadosController extends AppController
{


	public $paginate = [
        'limit' => 18,
        'order' => [
            'Agendamentos.DT_CIRURGIA' => 'desc'
        ]
    ];

	public function initialize()
    {
        parent::initialize();
        // Incluir the FlashComponent
		$this->loadComponent('Flash');

    }

	public function index()
	{

		// Caso valor do campo de busca for preenchido coloco na variável, ou coloco vazio
		$buscar = !empty($this->request->query('buscar')) ? $this->request->query('buscar') : '';
		$condicao = array();

		$internados = $this->Internados->find('all');
		// Caso faca busca - POST -
		if($this->request->is('get')) {
			// Se usuario preencher o campo, jogo valor na variavel de busca e adiciono a condicao no objeto de busca
			if (!empty($buscar)) {
				$internados->where(['NM_PACIENTE like' => '%'.strtoupper($buscar).'%']) ;
			}
		}


		//pr($options);
		//$this->paginate = $options;

		// Passo as variaveis para a views
		$this->set('internados', $this->paginate($internados));
		$this->set('buscar', $buscar);
	}

	public function view($id = null) {}

	public function add(){}

	public function edit($id = null){}

	public function delete($id){}

}
