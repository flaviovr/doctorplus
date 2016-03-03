<?php 
// src/Controller/UsersController.php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Mailer\Email;
use Cake\I18n\Time;

class UsersController extends AppController
{

    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Auth->allow(['add','esqueci']);
    }


    public function index()
    {
        $this->set('users', $this->Users->find('all'));
    }


    public function view($id)
    {
        $user = $this->Users->get($id);
        $this->set(compact('user'));
    }


    public function edit($id)
    {
        $user = $this->Users->get($id);
        if ($this->request->is(['post', 'put'])) {

            $this->Users->patchEntity($user, $this->request->data);
            if ($this->Users->save($user)) {
                $this->Flash->success(__('Usuário atualizado.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Unable to update your article.'));
        }
        $this->set('user', $user);
    }


    public function add()
    {
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->data);
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Unable to add the user.'));
        }
        $this->set('user', $user);
    }

    
    public function delete($id)
    {
        $this->request->allowMethod(['post', 'delete']);

        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The article with id: {0} has been deleted.', h($id)));
            return $this->redirect(['action' => 'index']);
        }
    }


    public function login()
    {


        if ($this->Auth->user()) return $this->redirect(['controller' => 'Pages', 'action' => 'display','home']) ;
        $user = $this->Users->newEntity();
        $this->set('user', $user);
        if ($this->request->is('post')) {
            
            $user = $this->Auth->identify();

            if ($user) {
                $this->Auth->setUser($user);
                return $this->redirect(['controller' => 'Pages', 'action' => 'display','home']);
            }

            $this->Flash->error(__('Usuário ou senha inválido, tente novamente.'));
        }
    }


    public function logout()
    {
        return $this->redirect($this->Auth->logout());
    }


    public function esqueci()
    {
        $emailUser='';
        if ($this->request->is('post')) {
            
            $emailUser = $this->request->data('email');
            
            if($user = $this->Users->localizaUser($emailUser)) {
                

                
                $data = new Time();
                
                $email = new Email();
                $email->transport('smtpMail')
                    ->template('esqueci', 'default')
                    ->emailFormat('html')
                    ->from(['flavio.motta@cssj.com.br' => 'Flávio Motta'])
                    ->to($emailUser)
                    ->subject('Enviado Pelo Doctos')
                    ->viewVars([
                        'data'=> $data->nice(),
                        'user' => $user[0],
                        'texto'=> 'Menagem que eu passei pro email'
                        ]);
                    
                if($email->send()) {
                    $this->Flash->success(__('Sua solicitação foi enviada com sucesso, aguarde retorno.'));    
                    //debug($email);
                    $emailUser='';
                } else {
                    $this->Flash->error(__('Erro ao enviar sua solicitação, tente novamente.'));    
                }
            } else {
                $this->Flash->error(__('E-mail não encontrado no sistema.'));
            }   
            
        }
        $this->set('emailUser',$emailUser);
        
    }
}
