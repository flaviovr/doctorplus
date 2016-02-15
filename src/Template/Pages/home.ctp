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
 */
use Cake\Cache\Cache;
use Cake\Core\Configure;
use Cake\Datasource\ConnectionManager;
use Cake\Error\Debugger;
use Cake\Network\Exception\NotFoundException;

$this->layout = 'default';

$cakeDescription = 'Doctor Plus';
?>
<div class="container">

    	<div class="row">	

			<div id='loginWraper' class='col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2 col-xs-10 col-xs-offset-1'>

				<!-- <div class="row centered">
					<div class="col-sm-6 col-xs-12 text-center"><?= $this->Html->image('logo.png',['width'=>'100%']);?></div>
					<div class="col-sm-5 col-sm-offset-1 col-xs-12 text-center"><?= $this->Html->image('logodell.png',['class'=>'sistema']);?></div>
				</div> -->

				<div class="row centered text-center">
					<?= $this->Html->image('logo.png',['width'=>'100%']);?>				
					<?= $this->Html->image('logodell.png',['class'=>'sistema']);?>
				</div>
				
				<h2>Acessar Internet</h2>
				<p>Digite seu usuário e senha e clique em entrar para liberar o acesso a Internet.</p>

				<?= $this->Form->create(null,['class'=>'form clear-fix', 'url'=>'/login']);?>
							
					<div class="form-group">
						<?= $this->Form->label('userName', 'Nome de Usuário', ['class'=>'sr-only'])?>
						<div class="input-group">
							<div class="input-group-addon"><span class="glyphicon glyphicon-user"></span></div>
							<input type="text" class="form-control" id="userName" name="userName" value="" maxlength="32" autocomplete="off" placeholder="Nome de Usuário">
						</div>
					</div>
					
					<div class="form-group">
						<?= $this->Form->label('password', 'Senha do Usuário', ['class'=>'sr-only'])?>
						<div class="input-group">
							<div class="input-group-addon"><span class="glyphicon glyphicon glyphicon-asterisk"></span></div>
							<input type="password" class="form-control" id="password" placeholder="Senha de Acesso">
						</div>
					</div>
					
					<div class="form-group">
						<?= $this->Form->button('Acessar',['type'=>'submit', 'name'=>'submit', 'class'=>'btn btn-primary center-block'])?>
					</div>

				<?= $this->Form->end()?>
			</div>
    	</div>
    </div>