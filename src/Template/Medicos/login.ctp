<!-- File: src/Template/Users/login.ctp (delete links added) -->
<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 *
 * use Cake\Cache\Cache;
 * use Cake\Core\Configure;
 * use Cake\Datasource\ConnectionManager;
 * use Cake\Error\Debugger;
 * use Cake\Network\Exception\NotFoundException;
 */

$this->layout = 'login';
?>

<div class="row centered text-center">
	<?= $this->Html->image('logo.png',['width'=>'100%']);?>
	<?= $this->Html->image('doctorplus.png',['class'=>'sistema']);?>
</div>

<h2>Acessar sua conta</h2>
<p>Digite seu nome de usuário e senha para acessar o sistema e agendar sua cirurgia com total segurança.</p>
<p><?= $this->Flash->render() ;?></p>
<?= $this->Form->create($medico,['class'=>'form clear-fix']);?>

	<div class="form-group">
		<?= $this->Form->label('USERNAME', 'Nome de Usuário', ['class'=>'sr-only'])?>
		<div class="input-group">
			<div class="input-group-addon"><span class="fa fa-user"></span></div>
			<?= $this->Form->input('USERNAME',['class'=>'form-control', 'placeholder'=> 'Nome de Usuário','label'=>false,'onkeyup' => 'this.value = this.value.toUpperCase();']) ?>
		</div>
	</div>

	<div class="form-group">
		<?= $this->Form->label('PASSWORD', 'Senha do Usuário', ['class'=>'sr-only'])?>
		<div class="input-group">
			<div class="input-group-addon"><span class="fa fa fa-asterisk"></span></div>
			<?= $this->Form->password('PASSWORD',['class'=>'form-control', 'placeholder'=> 'Senha do Usuário']) ?>
		</div>
	</div>

	<div class="form-group">
		<?= $this->Form->button(
				'Acessar',
				['type'=>'submit', 'name'=>'submit', 'class'=>'btn btn-primary pull-right']
		)?>
		<?= $this->Html->tag(
				'p',
				$this->Html->link(
					'Esqueceu sua senha ou não tem cadastro?',
					['controller'=>'Medicos', 'action'=>'esqueci']
				),
				['class'=>'form-control-static', 'escape'=>false])
		?>
	</div>

<?= $this->Form->end();?>
