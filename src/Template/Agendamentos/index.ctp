<?php
$this->assign('title', 'Agendamentos');
$this->assign('title', 'Listagem de Agendamentos');

?>

<ol class="breadcrumb bg-info">
	<li><a href="<?=$this->Url->build(["controller" => "Pages","action" => "display","home"]);?>"><span class='fa fa-home'></span> Início</a></li>
	<li class="active">Agendamentos</li>
</ol>

<h1 class="roundTop">
	<i class='fa fa-calendar-o'></i>
	Agendamentos
	<a href="<?php echo $this->Url->build(["controller" => "Agendamentos","action" => "novo"]);?>" class='btn btn-default pull-right'> <i class='fa fa-plus-circle'></i> Novo</a>
</h1>

<div class="row">

	<div class='col-lg-12'>

		<div class="well-busca ">

			<?= $this->Form->create('agendamentos',['type'=>'get']);?>

				<p class='title'> <i class='fa fa-filter'></i> Filtrar resultados</p>

				<div class="row">

					<div class='coluna col-lg-3 col-sm-6'>

						<select class="form-control" name='statusAgenda' style='border-top-left-radius: 0; border-bottom-left-radius: 0;'>
							<option value='S' <?= $statusAgenda=='S'? 'selected' : '' ;?> >Solicitada</option>
							<option value='A' <?= $statusAgenda=='A'? 'selected' : '' ;?> >Pré-agendada</option>
							<option value='P' <?= $statusAgenda=='P'? 'selected' : '' ;?> >Pendência</option>
							<option value='N' <?= $statusAgenda=='N'? 'selected' : '' ;?> >Cancelada</option>
							<option value='C' <?= $statusAgenda=='C'? 'selected' : '' ;?> >Confirmada</option>
							<option value='R' <?= $statusAgenda=='R'? 'selected' : '' ;?> >Realizadas</option>
							<option value=''  <?= $statusAgenda=='' ? 'selected' : '' ;?> >Todas</option>
						</select>
					</div>

					<div class='coluna col-lg-3  col-sm-6'>
						<div class="input-group ">
							<div class='input-group-addon'><span class='fa fa-calendar-o'></span></div>
							<input type="text" class="form-control dtp" name="dataAtual" value='<?= $dataAtual;?>' placeholder="Selecione a data">
						</div>
					</div>

					<div class='coluna col-lg-4 col-sm-10'>
						<div class="input-group">
							<div class='input-group-addon'><span class='fa fa-user'></span></div>
						  	<input type="text" class="form-control" name="nomePaciente" value='<?= $nomePaciente;?>' placeholder="Nome do paciente">
						</div>
					</div>

					<div class='coluna col-lg-2 col-sm-2'>
						<button type="submit" class="btn btn-info btn-block">Buscar <i class='fa fa-flip-horizontal fa-search'></i></button>
					</div>

			    </div>

			<?= $this->Form->end();?>
		</div>

		<div class=" well-status roundBottom legenda col-lg-12 text-center">
			<p class='label label-<?=$statusData['S']['cor']?> statuses'><i class="fa <?=$statusData['S']['icon']?>"></i>&nbsp;&nbsp;Solicitada&nbsp;&nbsp;<span class="badge"><?=$statusData['S']['count']?></span></p>
			<p class='label label-<?=$statusData['A']['cor']?> statuses'><i class="fa <?=$statusData['A']['icon']?>"></i>&nbsp;&nbsp;Pré-agendada&nbsp;&nbsp;<span class="badge"><?=$statusData['A']['count']?></span></p>
			<p class='label label-<?=$statusData['P']['cor']?> statuses'><i class="fa <?=$statusData['P']['icon']?>"></i>&nbsp;&nbsp;Pendência&nbsp;&nbsp;<span class="badge"><?=$statusData['P']['count']?></span></p>
			<p class='label label-<?=$statusData['N']['cor']?> statuses'><i class="fa <?=$statusData['N']['icon']?>"></i>&nbsp;&nbsp;Cancelada&nbsp;&nbsp;<span class="badge"><?=$statusData['N']['count']?></span></p>
			<p class='label label-<?=$statusData['C']['cor']?> statuses'><i class="fa <?=$statusData['C']['icon']?>"></i>&nbsp;&nbsp;Confirmada&nbsp;&nbsp;<span class="badge"><?=$statusData['C']['count']?></span></p>
			<p class='label label-<?=$statusData['R']['cor']?> statuses'><i class="fa <?=$statusData['R']['icon']?>"></i>&nbsp;&nbsp;Realizadas&nbsp;&nbsp;<span class="badge"><?=$statusData['R']['count']?></span></p>
    	</div>

	</div>

</div>

<div class='row data'>

	<div class='col-lg-12'>
		<div class="row">
			<?php foreach ($agendamentos as $agendamento){  ?>
			<div class="col-xs-12 col-sm-6">
				<a href="<?php echo $this->Url->Build(['controller'=>'Agendamentos', 'action'=>'ver', $agendamento->ID]);?>" class="list-item round">
					<p class='list-item-icon text-center text-<?= $statusData[$agendamento->STATUS_CHR]['cor'];?>'>
						<i class="fa <?= $statusData[$agendamento->STATUS_CHR]['icon'];?> "></i>
						<span><?php echo $agendamento->AVISO_ID ?? '---';?></span>
					</p>
					<p class="list-item-linha"><?= ucwords(mb_strtolower($agendamento->NM_PACIENTE));?></p>
					<p class="list-item-assets">
						<span class="list-item-asset"><i class="fa fa-clock-o fa-fw"></i> <?= $agendamento->DT_SUG_CIR ?></span>
						<span class="list-item-asset"><i class="fa fa-stethoscope fa-fw"></i> <?= /*$agendamento->DS_PROCEDIMENTO.' - '.*/ucfirst(strtolower($agendamento->DS_CIRURGIA));?></span>
					</p>
				</a>
			</div>
			<?php }?>
			<?php if($agendamentos->isEmpty()){
				echo "<div class='col-lg-12 text-muted text-center'><h3><i class='fa-exclamation-circle fa '></i> Nenhum registro encontrado!</h3</div>";
			}?>
		</div>
	</div>

	<!-- PAGINAÇÃO -->
	<div class='col-lg-12 text-center'>
		<ul class="pagination  pagination" >
			<?= $this->Paginator->first('<i class="fa fa-angle-double-left"></i>',['escape'=>false]);?>
			<?= $this->Paginator->prev('<i class="fa fa-angle-left"></i>',['escape'=>false]);?>
			<?= $this->Paginator->numbers(['modulus'=>6]);?>
			<?= $this->Paginator->next('<i class="fa fa-angle-right"></i>',['escape'=>false]);?>
			<?= $this->Paginator->last('<i class="fa fa-angle-double-right"></i>',['escape'=>false]);?>
		</ul>
		<p class="small"><?= $this->Paginator->counter(' Página {{page}} de {{pages}} &nbsp;&nbsp;-&nbsp;&nbsp; {{current}} de {{count}} registros');?></p>
	</div>

</div>
