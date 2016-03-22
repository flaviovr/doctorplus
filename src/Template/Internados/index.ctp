<?php
$this->assign('title', 'Internações');
?>
<div class="container">
	<ol class='breadcrumb'>
	  <li><a href="<?=$this->Url->build(["controller" => "Pages","action" => "display","home"]);?>"><span class='fa fa-home'></span> Início</a></li>
	  <li class="active">Internações</li>
	</ol>

	<h1 class="roundTop">
		<i class='fa fa-bed '></i>
		Internações
	</h1>

	<div class="row">


		<div class='col-lg-12'>

			<div class="well-busca roundBottom">
				<p class='title'> <i class='fa fa-filter'></i> Filtrar resultados</p>
				<?= $this->Form->create('internados',['type'=>'get']);?>
					<div class=" row">
						<div class='coluna col-lg-10 '>
							<div class="input-group">
								<div class='input-group-addon'><span class='fa fa-user'></span></div>
							  	<input type="text" class="form-control" name="buscar" value='<?=$buscar?>' onkeyup='this.value = this.value.toUpperCase();' placeholder="Nome do paciente">
							</div>
						</div>
						<div class='coluna col-lg-2 '>
							<button type="submit" class="btn btn-info btn-block">Buscar <i class='fa fa-flip-horizontal fa-search'></i></button>
						</div>
				  	</div>
				<?= $this->Form->end();?>
			</div>

		</div>

	</div>

	<div class='row data'>
		<div class='col-lg-12'>
			<div class="row">
				<?php foreach ($internados as $internado){ ;?>
				<div class="col-xs-6">
					<div class="media internado">
						<div class="media-left">
							<i class="fa fa-bed fa-3x text-default"></i>
						</div>
						<div class="media-body">
							<h4 class="media-heading"><?= ucwords(mb_strtolower(h($internado->NM_PACIENTE)));?></h4>
							<p class='tituloMsg text-default'><?= h($internado->LEITO);?></p>
						</div>
					</div>
				</div>
				<?php }?>
				<?php if($internados->isEmpty()){
					echo "<div class='col-lg-12 text-muted text-center'><h3><i class='fa-exclamation-circle fa '></i> Nenhum registro encontrado!</h3</div>";
				}?>
			</div>
		</div>
		<!-- PAGINAÇÃO -->
		<div class='col-lg-12 text-center'>
			<ul class="pagination" >
				<?= $this->Paginator->first('<i class="fa fa-angle-double-left"></i>',['escape'=>false]);?>
				<?= $this->Paginator->prev('<i class="fa fa-angle-left"></i>',['escape'=>false]);?>
				<?= $this->Paginator->numbers();?>
				<?= $this->Paginator->next('<i class="fa fa-angle-right"></i>',['escape'=>false]);?>
				<?= $this->Paginator->last('<i class="fa fa-angle-double-right"></i>',['escape'=>false]);?><br><br>
				<p class="small"><?= $this->Paginator->counter(' Página {{page}} de {{pages}} &nbsp;&nbsp;-&nbsp;&nbsp; {{current}} de {{count}} registros');?></p>
			</ul>
		</div>
	</div>
</div>
