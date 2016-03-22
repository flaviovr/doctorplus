<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Datasource\ConnectionManager;

class AgendamentosTable extends Table
{

    public function initialize(array $config){
        //Define o nomeda tabela do model
        $this->table('DP_AGENDAS');

        //Define o campo utilizado para associações no model
        //$this->displayField('username');

        //Define a chave primária do model
        $this->primaryKey('LINHA');

        $this->belongsTo('Convenios', [
            'foreignKey' => 'convenio_id',
            'bindingKey' => 'id'
        ]);
        $this->belongsTo('Planos', [
            'foreignKey' => 'plano_id',
            'bindingKey' => 'id'
        ]);

        //$this->hasOne('Plano');


    }

    //public function validationDefault(Validator $validator){}


    /* Funçao que agregas informações sobre status de Agendamentos. quantidades, cor usada e ícone */
    public function contaStatus()
    {
        /* Crio conexão e faco uma consulta que busca os totais de cata STATUS_CHR*/
        $db = ConnectionManager::get('default');
        $result = $db->execute("SELECT Count(STATUS_CHR) AS COUNT, STATUS_CHR  FROM DP_AGENDAS GROUP BY STATUS_CHR ORDER BY STATUS_CHR asc")->fetchAll('assoc');
        
        /* Crio variavel que receberá os dados tratados e adiciono as informações de ícone e de cor*/
        $d =
            [
                'S'=> ['icon'=>'fa-calendar-o',         'cor'=> 'default'   ,'count'=>0],
                'A'=> ['icon'=>'fa-calendar-plus-o',    'cor'=> 'info'      ,'count'=>0],
                'P'=> ['icon'=>'fa-calendar-minus-o',   'cor'=> 'warning'   ,'count'=>0],
                'N'=> ['icon'=>'fa-calendar-times-o',   'cor'=> 'danger'    ,'count'=>0],
                'C'=> ['icon'=>'fa-calendar-check-o',   'cor'=> 'success'   ,'count'=>0],
                'R'=> ['icon'=>'fa-calendar-check-o',   'cor'=> 'extra'     ,'count'=>0],
            ];

        /*Dou um loop no array, trato o resultado e jogo na variavel 'count' correspondente ao array da letra : Ex.: $array =  ['A' => [ 'icone'=>'icone', 'cor' => 'text-info', count='0'] ]*/
        foreach ($result as $value) {
            $d[$value['STATUS_CHR']]['count'] = $value['COUNT']>0 ? $value['COUNT'] : 0;
        }
        return $d;
    }


    /* Função alterna formato da data se usado fdata('08/01/1983') retorna 1983-08-01 se usa fdata('1983-08-01') retorna 08/01/1983 */
    public function fdata( $data, $sep = '/' )
    {
        if(strripos($data,'/')) {
            $data = explode('/',$data);
            $data = array_reverse($data);
            $data = implode('-',$data);
        } else if(strripos($data,'-')){
            $data = explode('-',$data);
            $data = array_reverse($data);
            $data = implode('/',$data);
        }
        return $data;
    }

}
