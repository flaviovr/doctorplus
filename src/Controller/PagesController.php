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

use Cake\Core\Configure;
use Cake\Network\Exception\NotFoundException;
use Cake\View\Exception\MissingTemplateException;
use Cake\Event\Event;
use Cake\Mailer\Email;
use Cake\I18n\Time;

/**
 * Static content controller
 *
 * This controller will render views from Template/Pages/
 *
 * @link http://book.cakephp.org/3.0/en/controllers/pages-controller.html
 */
class PagesController extends AppController
{
    public function display()
    {

        $path = func_get_args();
        $count = count($path);
        if (!$count) return $this->redirect('/');
        $page = $subpage = null;
        if (!empty($path[0])) $page = $path[0];
        if (!empty($path[1])) $subpage = $path[1];
        $this->set(compact('page', 'subpage'));

        try {
            $this->render(implode('/', $path));
        } catch (MissingTemplateException $e) {
            if (Configure::read('debug')) {
                throw $e;
            }
            throw new NotFoundException();
        }
    }

    //Action da pagina de envio de feedback do sistema
    public function feedback(){

        $msg='';

        // Caso Poste o Formulári
        if ($this->request->is('post')) {

            // pego o valor da MSG no request
            $msg =$this->request->data('mensagem');

            // Se nao estiver vazia
            if(!empty($msg)){

                // Data a ser usada no email
                $data = new Time();

                // Crio objeto email
                $email = new Email();

                //Configuro o objeto de email e passo as variáveis para se renderizar no E-mail
                $email->transport('smtpMail')
                    ->template('feedback', 'default')
                    ->emailFormat('html')
                    ->from(['flavio.motta@cssj.com.br' => 'Flávio Motta'])
                    ->to('flaviovr@gmail.com')
                    ->subject('Feedback enviado pelo DoctorPlus')
                    ->viewVars([
                        'data'=> $data->nice(),
                        'texto'=> $msg,
                        'user' => $this->Auth->user('nome_usuario')
                        ]);

                // Caso envie o e-mail
                if($email->send()) {
                    // Exibe mensagem de sucesso
                    $this->Flash->success(__('Sua sugestão foi enviada com sucesso.'));
                    // Esvazio o campo de Mensagem
                    $msg = '';
                } else {
                    // Exibe mensagem de Erro ao enviar e-mail
                    $this->Flash->error(__('Erro ao enviar sua solicitação, tente novamente.'));
                }
            }

        }
        //Defino variável na view
        $this->set('mensagem', $msg);
    }

    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        // Defino acoes permitidas na autenticação
        $this->Auth->allow(['esqueci']);
    }

}
