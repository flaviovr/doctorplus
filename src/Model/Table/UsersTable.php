<?php
// src/Model/Table/UsersTable.php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class UsersTable extends Table
{

    public function initialize(array $config)
    {
        //Define o nomeda tabela do model
        //$this->table('my_table');

        //Define o campo utilizado para associações no model
        $this->displayField('username');

        //Define a chave primária do model
        $this->primaryKey('id');

    }
    public function validationDefault(Validator $validator)
    {
        // Validação padrão para o usuário
        return $validator
            ->notEmpty('username', 'A username is required')
            ->notEmpty('password', 'A password is required')
            ->notEmpty('role', 'A role is required')
            ->add('role', 'inList', [
                'rule' => ['inList', ['admin', 'author']],
                'message' => 'Please enter a valid role'
            ]);
    }

    /*
     * Funcao que Localiza se o usuário existe/retorna seu registro, utilizado para recuperar a senha
     * $email = string -> E-mail do usuário que deseja localizar
     */
    public function localizaUser($email){

        //Cria a busca passando parametro da função para o WHERE
        $query = $this->find('all')->where(['email'=> $email])->toArray();

        //Retorna os dados do usuário caso encontre ou retorna vazio caso não encontro o usuário
        return $query;

    }

}
