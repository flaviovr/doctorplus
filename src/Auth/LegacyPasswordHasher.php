<?php
namespace App\Auth;

use Cake\Auth\AbstractPasswordHasher;
use Cake\Network\Request;

class LegacyPasswordHasher extends AbstractPasswordHasher
{

    public function hash($password)
    {
        //return encripta($password);
    }

    public function check($password, $hashedPassword)
    {
        //Pego o username que é passado na chamada do Auth no controller
    	$p = h($this->_config[0]['username'], true);
        //Converto para maiusculos
    	$p = mb_strtoupper($p);
        //desencripto o password
        $unhash = $this->decripta($hashedPassword);
        // Uno as strings com NOMEUSE.SENHA
        $password = $p.$password;
        //debug($password);die();
        //Completo o password com K para efetuar a comparação
        for ($cont=mb_strlen($password) ; $cont<=23 ; $cont++ ) $password .= 'K' ;
        //debug($password .'- ' .$unhash);die();
        // Comparo as strings geradas
        return $password === $unhash;
    }

	public function encripta($password)
	{
	    $hashedPass='';

	    //Adiciono 'K'na senha até completar 30 bytes
	    for ($cont=mb_strlen($password) ; $cont<=29 ; $cont++ ) $password .= 'K' ;

	    //Loop que percorre todos caracteres da string um a um
	    for ($cont=1 ; $cont<=mb_strlen($password) ; $cont++):

	        //Seleciono os caracteres em ordem
	        $parcial = mb_substr($password, $cont-1 ,1) ;

	        /**
	        * Com o caracter selecionado converto em código ASCII e adiciono 3
	        * Para funcao com UTF-8 usar uniord() ou utf8_char_code_at() no lugar de ord()*
	        **/
	        $parcial = uniord($parcial) + 3;

	        /* A partir do 2 caracter, a posição atual na string menos 1 multiplicado por 2 se soma ao valor atual do ASCII */
	        if($cont>1) $parcial += (($cont-1) * 2);

	        /* Converto o código ASCII em caractér novamente e adiciono ao password com hash */
	        $hashedPass .= chr($parcial);

	    endfor;

	    /* Funcão retorna password com hash */
	    return $hashedPass;
	}
    
	public function decripta($password)
	{
	    $hashedPass='';

	    //echo mb_strlen($password);

        //Loop em todos os caracteres da senha
	    for ($cont=1; $cont<mb_strlen($password) ; $cont++):

            // seleciono a letra
	        $parcial = mb_substr($password, $cont-1 ,1) ;

	        /**
	        * Com o caracter selecionado converto em código ASCII e adiciono 3
	        * Para funcao com UTF-8 usar uniord() ou utf8_char_code_at() no lugar de ord()*
	        **/
	        $parcial = ord($parcial) - 3;

	        /* A partir do 2 caracter, a posição atual na string menos 1 multiplicado por 2 se subtrai ao valor atual do ASCII */
	        if ($cont > 1) $parcial -= (($cont - 1) * 2);

	        /* Converto o código ASCII em caractér novamente e adiciono ao password com hash */
	        $hashedPass .= chr($parcial);

	    endfor;

	    /* Funcão retorna password com hash */
	    return $hashedPass;//preg_replace('/[[:^print:]]/', '', $hashedPass);//
	}

}
