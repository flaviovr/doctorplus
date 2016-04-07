<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class AlertasTable extends Table
{

    public function initialize(array $config)
    {
        //Define o nomeda tabela do model
        $this->table('DP_ALERTAS');

        //Define o campo utilizado para associações no model
        $this->displayField('NOME');

        //Define a chave primária do model
        $this->primaryKey('CD_MENSAGEM');

        //Relacionamentos
        $this->belongsTo('Medicos', [
            'foreignKey' => 'CD_PRESTADOR',
            'bindingKey' => 'CD_PRESTADOR'
        ]);
        $this->belongsTo('Agendamentos', [
            'foreignKey' => 'CD_PRE_AGENDAMENTO',
            'bindingKey' => 'ID'
        ]);


    }


}
