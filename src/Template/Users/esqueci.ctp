<!-- File: src/Template/Users/esqueci.ctp (delete links added) -->
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
$this->assign('title', 'Esqueceu sua senha?');
?>
<div class="container">

	<div class="row">

		<div id='loginWraper' class='col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2 col-xs-10 col-xs-offset-1 clearfix'>

			<div class="row centered text-center">
				<?= $this->Html->image('logo.png',['width'=>'100%']);?>
				<?= $this->Html->image('doctorplus.png',['class'=>'sistema']);?>
			</div>

			<h2>Esqueceu sua senha?</h2>
			<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum sit amet imperdiet quam, in pellentesque nunc. Ut sollicitudin tellus imperdiet velit faucibus, eu euismod urna scelerisque. Fusce dignissim magna ut augue euismod, nec maximus odio fringilla. Nulla eget magna velit. Duis ac ornare lorem.</p>
			<?= $this->Flash->render() ;?>

			<?= $this->Form->create(false,['class'=>'form clearfix']);?>

				<div class="form-group">
					<?= $this->Form->label('email', 'Digite seu e-mail', ['class'=>'sr-only'])?>
					<div class="input-group">
						<div class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></div>
						<?= $this->Form->input('email',['class'=>'form-control', 'placeholder'=> 'Digite seu e-mail','value'=>$emailUser, 'label'=>false]) ?>
						<!-- <input type="text" class="form-control" id="username" name="username" value="" maxlength="32" autocomplete="off" placeholder="Nome de Usuário"> -->
					</div>
				</div>

				<div class="form-group">
					<?= $this->Form->button(
							'Enviar Senha',
							['type'=>'submit', 'name'=>'submit', 'class'=>'btn btn-primary pull-right']
					)?>
				</div>

			<?= $this->Form->end();?>
			<hr/>
			<h2>Não possui cadastro?</h2>
			<p>Aliquam vulputate velit mi, eu fringilla nisi hendrerit sit amet. Praesent euismod bibendum accumsan. Etiam nec scelerisque turpis. Curabitur eget egestas arcu, a congue libero. Vestibulum nec ligula convallis, aliquet libero sed, vestibulum diam. </p>
			<br/>
			<?= $this->Html->link('Voltar', ['controller'=>'pages', 'action'=>'display','home'],['type'=>'button', 'class'=>'btn btn-primary pull-right'])?>
			<br/><br/><br/>
		</div>
	</div>
</div>
