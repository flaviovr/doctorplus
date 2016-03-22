<?php
$this->assign('title', 'Alertas');
?>
<div class="container">
	<ol class='breadcrumb'>
	  <li><a href="<?=$this->Url->build(["controller" => "Pages","action" => "display","home"]);?>"><span class='fa fa-home'></span> Início</a></li>
	  <li class="active">Alertas</li>
	</ol>

	<h1 class="roundTop">
		<i class='fa fa-bell '></i>
		Alertas
	</h1>


	<div class='row data'>
		<div class='col-lg-12'>
			<div class="row">
				<?php foreach ($alerta as $item){ ;?>
				<div class="col-xs-12">
					<div class="alerta">
						<b class="lead"><span class="fa fa-fw fa-bell"></span> Cirurgia cancelada </b>
						<span class="fa fa-fw fa-user"></span> Alberto Luiz Batista Santos
						<span class="fa fa-fw fa-clock-o"></span> 23 Nov, 08:55
						<a href="<?=$this->Url->build(["action" => "index"]);?>" class='btn btn-sm btn-danger pull-right'> <i class='fa fa-ban'></i> Excluir</a>
					</div>
				</div>
				<?php }?>
				<?php if($alerta->isEmpty()){
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
