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

$this->assigncakeDescription = 'Doctor Plus';
?>
<style type="text/css">
.wraper {
  position: relative;
  background: blue;
  margin-bottom: 30px;
}
.wraper:before {
  display: block;
  content: "";
  width: 100%;
  padding-top: 100%;
}
.wraper > .main {
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
}
</style>
<nav class="navbar navbar-default">
	<div class="container">
		<!-- Brand and toggle get grouped for better mobile display -->

		<div class="navbar-header" >
			<button type="button" class=" navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
				<span class="sr-only">Toggle navigation</span>
				<span class="glyphicon glyphicon-menu-hamburger"> </span>
			</button>
			<a class="navbar-brand" href="#">MAIN menu</a>
		</div>

		<!-- Collect the nav links, forms, and other content for toggling -->
		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			<ul class="nav navbar-nav">
				<li class="active"><a href="/">Início <span class="sr-only">(current)</span></a></li>
				<li class="dropdown">
					<a href="/agendamentos" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Agendamentos <span class="caret"></span></a>
					<ul class="dropdown-menu">
						<li><a href="#">Agendamentos</a></li>
						<li role="separator" class="divider"> </li>
						<li><a href="#">Outros</a></li>
					</ul>
				</li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li><a href='users/logout' class='navbar-btn btn' ><?=$this->Html->tag('span', ' ', ['class' => 'glyphicon glyphicon-log-out'])?> SAIR</a></li>
				<li><a href='users/logout' class='navbar-btn btn' ><?=$this->Html->tag('span', ' ', ['class' => 'glyphicon glyphicon-check'])?> FEEDBACK</a></li>
			</ul>
		</div><!-- /.navbar-collapse -->
	</div><!-- /.container-fluid -->
</nav>

<div class="container">
	<?= $this->Html->link('SAIR',['controller'=>'Users','action'=>'logout'])?>;
	<div class="row clearfix">
		<div class="col-lg-3 col-md-4 col-sm-6"><div class='wraper'><div class="main">teste<br>breterw</div></div></div>
		<div class="col-lg-3 col-md-4 col-sm-6"><div class='wraper'><div class="main">teste</div></div></div>
		<div class="col-lg-3 col-md-4 col-sm-6"><div class='wraper'><div class="main">teste</div></div></div>
	
		<div class="col-lg-3 col-md-4 col-sm-6"><div class='wraper'><div class="main">teste<br>breterw</div></div></div>
		<div class="col-lg-3 col-md-4 col-sm-6"><div class='wraper'><div class="main">teste</div></div></div>
		<div class="col-lg-3 col-md-4 col-sm-6"><div class='wraper'><div class="main">teste</div></div></div>
	</div>
</div>