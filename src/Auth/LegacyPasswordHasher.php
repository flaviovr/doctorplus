<?php
namespace App\Auth;

use Cake\Auth\AbstractPasswordHasher;
use Cake\Network\Request;
use Cake\Datasource\ConnectionManager;

class LegacyPasswordHasher extends AbstractPasswordHasher
{

    public function hash($password)
    {
        // Uno o nome do usuario com a senha no formato:  NOME.USUARIOSENHA e converto tudo para maiúsculo
        $password = h(mb_strtoupper($this->_config[0]['USERNAME'].$password), true);
        //Crio uma conecção com DB
        $connection = ConnectionManager::get('default');
        // Faco uma consulta com a Funcao de encriptar senha passando os dados de login NOME.USUARIOSENHA
        $result = $connection->query("Select FN_ENCRIPTA('$password') as SENHA from DUAL")->fetch('assoc');
	    /* Funcão retorna password com hash */
        $password = $result['SENHA'];
        //debug('usei hash');
	    return $password;
    }

    public function check($password, $hashedPassword)
    {
        // Comparo as strings geradas
        $password = $this->hash($password);
        //debug($password.'- '.$hashedPassword);
        // Retorno true se o $hashedPassword for igual a $password
        return $password === $hashedPassword;
    }

}
