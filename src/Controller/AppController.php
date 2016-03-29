<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link      http://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;


/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link http://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{

    public function initialize()
    {
        parent::initialize();
        //Carrego Componente Flash
        $this->loadComponent('Flash');
        $this->loadComponent('Paginator');

        // Carrego componente de autenticacao e passo o parametro do Hasher e os dados do request
        $this->loadComponent('Auth', [
            'loginAction' => [
                'controller' => 'Medicos',
                'action' => 'login',
            ],
            'useModel' => 'Medicos',
            'authError' => 'Você precisa fazer login para acessar essa página',
            'authenticate' => [
                'Form' => [
                    'passwordHasher' => [ 'className' => 'Legacy', $this->request->data ],
                    'userModel' => 'Medicos',
                    'fields' => ['username' => 'USERNAME', 'password' => 'PASSWORD']
                ],
            ],

        ]);
    }

    public function beforeRender(Event $event)
    {
        // Atribuo o usuario logado a variavel e adiciono a variavel a view
        $medico = $this->Auth->user();
        $this->set('userAuth', $medico);
    }

    public function beforeFilter(Event $event)
    {
        $this->Auth->allow('feedback','getPlano');

    //    debug($this->Auth->Config);
    }
}
