<?php
$this->assign('title', 'Selecione a opção desejada');
?>



<ol class="breadcrumb bg-info">
  <li class="active"><span class='fa fa-home'></span> Início</li>
</ol>


<div class="row clearfix">

	<div class="col-lg-3 col-md-3 col-sm-4 col-xs-6">
		<a class='wraper' href='<?=$this->Url->build(['controller' => 'agendamentos']);?>'>
			<div class="menuItem">
				<div class='innerItem'>
					<i class='fa fa-calendar-o iconMenuItem'></i>
					<p class='titleMenuItem text-center'>Agendamento<p>
					<ul class='hidden-xs'>
						<li>Marcação de Consultas</li>
						<li>Reagendamento</li>
						<li>Lista de Especialidades</li>
					</ul>
				</div>
			</div>
		</a>
	</div>

	<!-- <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6">
		<a class='wraper' href='consultas'>
			<div class="menuItem">
				<div class='innerItem'>
					<i class='fa fa-heartbeat iconMenuItem'></i>
					<p class='titleMenuItem text-center'>Consultas<p>
					<ul class='hidden-xs'>
						<li>Marcação de Consultas</li>
						<li>Reagendamento</li>
						<li>Lista de Especialidades</li>
					</ul>
				</div>
			</div>
		</a>
	</div> -->

	<div class="col-lg-3 col-md-3 col-sm-4 col-xs-6">
		<a class='wraper' href='<?=$this->Url->build(['controller' => 'internados']);?>'>
			<div class="menuItem">
				<div class='innerItem'>
					<i class='fa fa-bed iconMenuItem'></i>
					<p class='titleMenuItem text-center'>Internações<p>
					<ul class='hidden-xs'>
						<li>Marcação de Consultas</li>
						<li>Reagendamento</li>
						<li>Lista de Especialidades</li>
					</ul>
				</div>
			</div>
		</a>
	</div>

	<!-- <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6">
		<a class='wraper' href='especialidades'>
			<div class="menuItem">
				<div class='innerItem'>
					<i class='fa fa-list-alt iconMenuItem'></i>
					<p class='titleMenuItem text-center'>Especialidades<p>
					<ul class='hidden-xs'>
						<li>Marcação de Consultas</li>
						<li>Reagendamento</li>
						<li>Lista de Especialidades</li>
					</ul>
				</div>
			</div>
		</a>
	</div> -->

	<div class="col-lg-3 col-md-3 col-sm-4 col-xs-6">
		<a class='wraper' href="<?=$this->Url->build(['controller' => 'medicos', 'action' => 'perfil' , $userAuth['ID'] ]);?>">
			<div class="menuItem">
				<div class='innerItem'>
					<i class='fa fa-user-md iconMenuItem'></i>
					<p class='titleMenuItem text-center'>Meu Perfil<p>
				</div>
			</div>
		</a>
	</div>

	<div class="col-lg-3 col-md-3 col-sm-4 col-xs-6">
		<a class='wraper' href='<?=$this->Url->build(['controller' => 'pages', 'action' => 'feedback']);?>'>
			<div class="menuItem">
				<div class='innerItem'>
					<i class='fa fa-comment iconMenuItem'></i>
					<p class='titleMenuItem text-center'>Dar Feedback<p>
				</div>
			</div>
		</a>
	</div>

	<div class="col-lg-3 col-md-3 col-sm-4 col-xs-6">
		<a class='wraper' href='<?=$this->Url->build(['controller' => 'medicos', 'action' => 'logout'])?>'>
			<div class="menuItem">
				<div class='innerItem'>
					<i class='fa fa-sign-out iconMenuItem'></i>
					<p class='titleMenuItem text-center'>Sair<p>
				</div>
			</div>
		</a>
	</div>
</div>
