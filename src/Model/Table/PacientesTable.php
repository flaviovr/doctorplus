<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class PacientesTable extends Table
{

    public function initialize(array $config)
    {
        //Define o nomeda tabela do model
        $this->table('DP_PACIENTES');

        //Define o campo utilizado para associações no model
        $this->displayField('NM_PACIENTE');

        //Define a chave primária do model
        $this->primaryKey('NR_CPF');

        //Relacionamento
        // $this->hasMany('Agendamentos', [
        //     'foreignKey' => 'plano_id',
        //     'bindingKey' => 'id',
        //     'className' => 'Agendamentos'
        // ]);
        // $this->belongsTo('Convenios', [
        //     'foreignKey' => 'convenio_id',
        //     'bindingKey' => 'id'
        // ]);

    }


}
