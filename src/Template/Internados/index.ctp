<?php
$this->assign('title', 'Internações');
?>
<div class="container">
	<ol class='breadcrumb'>
	  <li><a href="<?=$this->Url->build(["controller" => "Pages","action" => "display","home"]);?>"><span class='fa fa-home'></span> Início</a></li>
	  <li class="active">Internações</li>
	</ol>

	<h1><i class='fa fa-bed '></i> Internações</h1>

	<div class="row">


		<div class='col-lg-12'>

			<div id='buscainternado' class="well">
				<?= $this->Form->create('internados');?>
					<div class=" row">
						<div class='coluna col-lg-10 '>
							<div class="input-group">
								<div class='input-group-addon'><span class='glyphicon glyphicon-user'></span></div>
							  	<input type="text" class="form-control" name="nomePaciente" value='<?=$nomePaciente?>' placeholder="Nome do paciente">
							</div>
						</div>
						<div class='coluna col-lg-2 '>
							<button type="submit" class="btn btn-default btn-block">Buscar</button>
						</div>
				  	</div>
				<?= $this->Form->end();?>
			</div>
		</div>
	</div>
	<div class='row'>
		<div class='col-lg-12'>
			<div class="row">
				<?php foreach ($internados as $internado){ ?>
				<div class="col-xs-6">
					<div class="media marcacao">
						<div class="media-left">
							<i class="fa fa-bed fa-3x"></i>
						</div>
						<div class="media-body">
							<h4 class="media-heading"><?= ucwords(mb_strtolower(h($internado->NM_PACIENTE)));?></h4>
							<p class='tituloMsg text-info'><?= h($internado->LEITO);?></p>
						</div>
					</div>
				</div>
				<?php }?>
				<?php if($internados->isEmpty()){
					echo "<div class='col-lg-12 text-muted text-center'><h3><i class='fa-exclamation-circle fa '></i> Nenhum registro encontrado!</h3</div>";
				}?>
			</div>
		</div>
		<div class='col-lg-3'>
		</div>
	</div>
</div>
