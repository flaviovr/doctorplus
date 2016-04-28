<?php
$this->assign('title', 'Alertas');
$this->assign('title', 'Meus Alertas');
?>

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
			<?php foreach ($alertas as $item){ ?>
			<div class="col-xs-12">
				<div class="alerta">
					<b class="lead"><span class="fa fa-fw <?php echo $status[$item['STATUS']]['icon'];?>"></span> <?php echo $status[$item['STATUS']]['texto'];?> </b>
					<span class="fa fa-fw fa-user"></span> <?= $item['agendamento']['NM_PACIENTE']; ?>
					<span class="fa fa-fw fa-clock-o"></span> <?= $item['DT_MENSAGEM']; ?>
					<a href="<?=$this->Url->build([ 'action'=>'marcarLido', $item['CD_MENSAGEM']]);?>" class='btn btn-sm btn-danger pull-right'> <i class='fa fa-ban'></i> Marcar como lido</a>
				</div>
			</div>
			<?php }?>
			<?php if($alertas->isEmpty()){
				echo "<div class='col-lg-12 text-muted text-center'><h3><i class='fa-exclamation-circle fa '></i> Nenhum registro encontrado!</h3</div>";
			}?>
		</div>
	</div>
	<!-- PAGINAÇÃO -->
	<div class='col-lg-12 text-center'>
		<ul class="pagination pagination" >
			<?= $this->Paginator->first('<i class="fa fa-angle-double-left"></i>',['escape'=>false]);?>
			<?= $this->Paginator->prev('<i class="fa fa-angle-left"></i>',['escape'=>false]);?>
			<?= $this->Paginator->numbers(['modulus'=>6]);?>
			<?= $this->Paginator->next('<i class="fa fa-angle-right"></i>',['escape'=>false]);?>
			<?= $this->Paginator->last('<i class="fa fa-angle-double-right"></i>',['escape'=>false]);?>
		</ul>
		<p class="small"><?= $this->Paginator->counter(' Página {{page}} de {{pages}} &nbsp;&nbsp;-&nbsp;&nbsp; {{current}} de {{count}} registros');?></p>
	</div>
</div>
