<?php
// src/Controller/InternadosController.php

namespace App\Controller;

use Cake\I18n\Date;


class InternadosController extends AppController
{

	/* definições da paginação */
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

	// Action de Listagem de Internados
	public function index()
	{

		// Caso valor do campo de busca for preenchido coloco na variável, ou coloco vazio
		$buscar = !empty($this->request->query('buscar')) ? $this->request->query('buscar') : '';

		// Carrego listagem de agendamentos
		$internados = $this->Internados->find('all');
		// Caso faca busca - GET -
		if($this->request->is('get')) {
			// Se usuario preencher o campo, jogo valor na variavel de busca e adiciono a condicao no objeto de busca
			if (!empty($buscar)) {
				$internados->where(['NM_PACIENTE like' => '%'.strtoupper($buscar).'%']) ;
			}
		}

		// Passo as variaveis para a views
		$this->set('internados', $this->paginate($internados));
		$this->set('buscar', $buscar);
	}

	public function view($id = null) {}

	public function add(){}

	public function edit($id = null){}

	public function delete($id){}

}
