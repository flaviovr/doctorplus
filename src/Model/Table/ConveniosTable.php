<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class ConveniosTable extends Table
{

    public function initialize(array $config)
    {
        //Define o nomeda tabela do model
        $this->table('DP_CONVENIOS');

        //Define o campo utilizado para associações no model
        $this->displayField('NOME');

        //Define a chave primária do model
        $this->primaryKey('ID');

        //Relacionamentos
        $this->hasMany('Agendamentos', [
            'foreignKey' => 'CONVENIO_ID',
            'bindingKey' => 'ID',
            'className' => 'Agendamentos'
        ]);
        $this->hasMany('Planos', [
            'foreignKey' => 'PLANO_ID',
            'bindingKey' => 'ID',
        ]);
    }

}
