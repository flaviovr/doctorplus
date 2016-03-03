<?php
//$this->assign('title', 'Agendamentos');
//pr($query);
?>
<div class="container">


	<ol class="breadcrumb bg-info">
		<li><a href="<?=$this->Url->build(["controller" => "Pages","action" => "display","home"]);?>"><span class='fa fa-home'></span> Início</a></li>
		<li class="active">Agendamentos</li>
	</ol>

	<h1><i class='fa fa-calendar-o'></i> Agendamentos</h1>

	<div class="row">
		<div class="legenda col-lg-12" style='display:table-cell, vertical-aligne:middle;'>
			<a href="" class='btn btn-info pull-right'>Novo Agendamento</a>
			<p class='label label-<?=$statusData['S']['cor']?> statuses'><i class="fa <?=$statusData['S']['icon']?>"></i>&nbsp;&nbsp;Solicitada&nbsp;&nbsp;<span class="badge"><?=$statusData['S']['count']?></span></p>

			<p class='label label-<?=$statusData['A']['cor']?> statuses'><i class="fa <?=$statusData['A']['icon']?>"></i>&nbsp;&nbsp;Pré-agendada&nbsp;&nbsp;<span class="badge"><?=$statusData['A']['count']?></span></p>

			<p class='label label-<?=$statusData['P']['cor']?> statuses'><i class="fa <?=$statusData['P']['icon']?>"></i>&nbsp;&nbsp;Pendência&nbsp;&nbsp;<span class="badge"><?=$statusData['P']['count']?></span></p>

			<p class='label label-<?=$statusData['E']['cor']?> statuses'><i class="fa <?=$statusData['E']['icon']?>"></i>&nbsp;&nbsp;Cancelada&nbsp;&nbsp;<span class="badge"><?=$statusData['E']['count']?></span></p>

			<p class='label label-<?=$statusData['C']['cor']?> statuses'><i class="fa <?=$statusData['C']['icon']?>"></i>&nbsp;&nbsp;Confirmada&nbsp;&nbsp;<span class="badge"><?=$statusData['C']['count']?></span></p>
    	</div>

		<div class='col-lg-12'>

			<div class=" well-busca well">

				<?= $this->Form->create('agendamentos');?>

					<p class='lead title'>Buscar Agendamentos</p>

					<div class="row">

						<div class='coluna col-lg-3 col-sm-6'>

							<select class="form-control" name='statusAgenda' style='border-top-left-radius: 0; border-bottom-left-radius: 0;'>
								<option value='S' <?= $statusAgenda=='S'? 'selected' : '' ;?> >Solicitada</option>
								<option value='A' <?= $statusAgenda=='A'? 'selected' : '' ;?> >Pré-agendada</option>
								<option value='P' <?= $statusAgenda=='P'? 'selected' : '' ;?> >Pendência</option>
								<option value='E' <?= $statusAgenda=='E'? 'selected' : '' ;?> >Cancelada</option>
								<option value='C' <?= $statusAgenda=='C'? 'selected' : '' ;?> >Confirmada</option>
								<option value=''  <?= $statusAgenda=='' ? 'selected' : '' ;?> >Todas</option>
							</select>
						</div>

						<div class='coluna col-lg-3  col-sm-6'>
							<div class="input-group ">
								<div class='input-group-addon'><span class='fa fa-calendar-o'></span></div>
								<input type="text" class="form-control datepicker" name="dataAtual" value='<?= $dataAtual;?>' placeholder="Selecione a data">
							</div>
						</div>

						<div class='coluna col-lg-4 col-sm-10'>
							<div class="input-group">
								<div class='input-group-addon'><span class='fa fa-user'></span></div>
							  	<input type="text" class="form-control" name="nomePaciente" value='<?= $nomePaciente;?>' placeholder="Nome do paciente">
							</div>
						</div>

						<div class='coluna col-lg-2 col-sm-2'>
							<button type="submit" class="btn btn-default btn-block">Buscar <i class='fa fa-flip-horizontal fa-search'></i></button>
						</div>

				    </div>

				<?= $this->Form->end();?>
			</div>

		</div>

	</div>

	<div class='row'>
		<div class='col-lg-12'>
			<div class="row">
				<?php foreach ($agendamentos as $agendamento){ ?>
				<div class="col-xs-6">
					<div class="media marcacao">
						<div class="media-left text-<?= $statusData[$agendamento->STATUS_CHR]['cor'];?> ">
							<i class="fa <?= $statusData[$agendamento->STATUS_CHR]['icon'];?>  fa-4x"></i>
							<p class='text-center'><?= $agendamento->CD_AVISO;?></p>
						</div>
						<div class="media-body">
							<h4 class="media-heading"><?= ucwords(mb_strtolower($agendamento->NM_PACIENTE));?></h4>
							<p class='tituloMsg'>
		                        <i class="fa fa-stethoscope fa-fw"></i> <?= $agendamento->PROCEDIMENTO_PRINCIPAL.' - '.ucfirst(strtolower($agendamento->DS_CIRURGIA));?> <br>
		                        <i class="fa fa-clock-o fa-fw"></i> <?= $agendamento->DT_CIRURGIA ?>, <?= $agendamento->HR_AVISO_CIRURGIA?>
		                    </p>
						</div>
					</div>
				</div>
				<?php }?>
				<?php if($agendamentos->isEmpty()){
					echo "<div class='col-lg-12 text-muted text-center'><h3><i class='fa-exclamation-circle fa '></i> Nenhum registro encontrado!</h3</div>";
				}?>

			</div>
		</div>
		<div class='col-lg-3'>
		</div>
	</div>

</div>
