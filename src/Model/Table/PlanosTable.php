<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class PlanosTable extends Table
{

    public function initialize(array $config)
    {
        //Define o nomeda tabela do model
        $this->table('drplus_planos');

        //Define o campo utilizado para associações no model
        $this->displayField('NOME');

        //Define a chave primária do model
        $this->primaryKey('ID');

        //Relacionamento
        $this->hasMany('Agendamentos', [
            'foreignKey' => 'plano_id',
            'bindingKey' => 'id',
            'className' => 'Agendamentos'
        ]);
        $this->belongsTo('Convenios', [
            'foreignKey' => 'convenio_id',
            'bindingKey' => 'id'
        ]);

    }


}
