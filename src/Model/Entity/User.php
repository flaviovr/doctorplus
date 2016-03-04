<?php
// src/Model/Entity/User.php
namespace App\Model\Entity;

use Cake\ORM\Entity;
use App\Auth\LegacyPasswordHasher;

class User extends Entity
{

    // Define os campos acessíveis
    protected $_accessible = [
        '*' => true,
        'id' => false
    ];


    // Função de gerar senha baseado na Autenticação do MV Soul
     protected function _setPassword($password)
    {
        //Crio instancia do Password Hasher e encripto a senha utilizando a funcao Hash - conferir se esta comentada antes de usar
        (new DefaultPasswordHasher)->hash($password) ; //return 'teste'.$password
    }


}
