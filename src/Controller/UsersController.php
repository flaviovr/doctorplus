<?php
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
        // Permito acesso as actions
        $this->Auth->allow(['add','esqueci']);
    }


    public function index()
    {
        //defino uma variavel na view com todos os usuarios
        $this->set('users', $this->Users->find('all'));
    }


    public function view($id)
    {
        //Passo os dados do usuario ($id) para uma variavel e defino na view
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
        //Se usuário já estiver logado, redireciona para home.
        if ($this->Auth->user()) return $this->redirect(['controller' => 'Pages', 'action' => 'display','home']) ;

        // Define a variável como nova Entidade
        $user = $this->Users->newEntity();

        // Defino a variável na view
        $this->set('user', $user);

        // Caso de POST - Login
        if ($this->request->is('post')) {

            // Tenta identificar o usuario com a funcao de autenticçao
            $user = $this->Auth->identify();

            //Caso encontre o usuário seja identificado
            if ($user) {
                // Define o usuario como o usuario autenticado
                $this->Auth->setUser($user);
                // Redireciona para home
                return $this->redirect(['controller' => 'Pages', 'action' => 'display','home']);
            }
            // Caso não encontre o usuario dispara um alert
            $this->Flash->error('Usuário ou senha inválido, tente novamente.');
        }
    }


    public function logout()
    {
        // Redireciona o usuario para a action de logout do controler
        return $this->redirect($this->Auth->logout());
    }


    public function esqueci()
    {
        // Variavel pque recebe o email do usuario
        $emailUser='';

        // Se o formulario  for postado
        if ($this->request->is('post')) {

            // Pega o e-mail enviado no POST
            $emailUser = $this->request->data('email');

            // Função retorna array com dados do usuário ou false caso não encontre e joga na variável
            if($user = $this->Users->localizaUser($emailUser)) {

                // Data a ser usada no email
                $data = new Time();

                // Crio objeto email
                $email = new Email();

                //Configuro o objeto de email e passo as variáveis para se renderizar no E-mail
                $email->transport('smtpMail')
                    ->template('esqueci', 'default')
                    ->emailFormat('html')
                    ->from(['flavio.motta@cssj.com.br' => 'Flávio Motta'])
                    ->to($emailUser)
                    ->subject('Enviado Pelo Doctos')
                    ->viewVars([
                        'data'=> $data->nice(),
                        'user' => $user[0],
                        ]);

                // Caso envie o e-mail
                if($email->send()) {
                    // Exibe mensagem de sucesso
                    $this->Flash->success(__('Sua solicitação foi enviada com sucesso, aguarde retorno.'));
                    //limpo a variavel com email do usuario
                    $emailUser='';
                } else {
                    // Exibe mensagem de Erro ao enviar e-mail
                    $this->Flash->error(__('Erro ao enviar sua solicitação, tente novamente.'));
                }
            } else {
                // Exibe mensagem de Erro de usuário nao encontrado
                $this->Flash->error(__('E-mail não encontrado no sistema.'));
            }

        }
        // Defino a variavel com email do usuario na view, para poder preencher o campo
        $this->set('emailUser',$emailUser);

    }
}
