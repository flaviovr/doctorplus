<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class CirurgiasTable extends Table
{

    public function initialize(array $config)
    {
        //Define o nomeda tabela do model
        $this->table('DP_CIRURGIAS');

        //Define o campo utilizado para associações no model
        $this->displayField('DS_CIRURGIA');

        //Define a chave primária do model
        $this->primaryKey('CD_CIRURGIA');

        //Relacionamentos
        $this->hasMany('Agendamentos', [
            'foreignKey' => 'CD_CIRURGIA',
            'bindingKey' => 'CD_CIRURGIA',
            'className' => 'Cirurgias'
        ]);

    }

    // Funcao de validação
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
    public function localiza($email){

        //Cria a busca passando parametro da função para o WHERE
        $query = $this->find('all')->where(['EMAIL'=> $email])->toArray();

        //Retorna os dados do usuário caso encontre ou retorna vazio caso não encontro o usuário
        return $query;

    }

}
