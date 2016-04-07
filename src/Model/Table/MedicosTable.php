<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class MedicosTable extends Table
{

    public function initialize(array $config)
    {
        //Define o nomeda tabela do model
        $this->table('DP_MEDICOS');

        //Define o campo utilizado para associações no model
        $this->displayField('USERNAME');

        //Define a chave primária do model
        $this->primaryKey('ID');

        $this->hasMany('Alertas', [
            'foreignKey' => 'CD_PRESTADOR',
            'bindingKey' => 'CD_PRESTADOR',
            'className' => 'Alertas'
        ]);

    }

    // Funcao de validação
    public function validationDefault(Validator $validator)
    {
        // Validação padrão para o usuário
        return $validator
            ->notEmpty('username', 'Preencha seu nome')
            ->notEmpty('password', 'Preencha a senha')
            ->notEmpty('role', 'Selecione o Perfil')
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
