<?php
// src/Model/Table/InternadosTable.php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class InternadosTable extends Table
{

    public function initialize(array $config)
    {
        //Define o nomeda tabela do model
        //$this->table('my_table');

        //Define o campo utilizado para associações no model
        //$this->displayField('username');

        //Define a chave primária do model
        //$this->primaryKey('id');
    }

    // public function validationDefault(Validator $validator)
    // {
    //     return $validator
    //         ->notEmpty('username', 'A username is required')
    //         ->notEmpty('password', 'A password is required')
    //         ->notEmpty('role', 'A role is required')
    //         ->add('role', 'inList', [
    //             'rule' => ['inList', ['admin', 'author']],
    //             'message' => 'Please enter a valid role'
    //         ]);
    // }

}
