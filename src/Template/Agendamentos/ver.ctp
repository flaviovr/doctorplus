<?php
$this->assign('title', 'Detalhes do Agendamento');
//$this->Form->templates('agenda_form');
//debug($agendamento);
?>

<ol class="breadcrumb bg-info">
	<li><a href="<?=$this->Url->build(["controller" => "Pages","action" => "display","home"]);?>"><span class='fa fa-home'></span> Início</a></li>
	<li class="active">Agendamentos</li>
</ol>

<h1 class="roundTop">
	<i class='fa fa-calendar-o'></i>
	Agendamentos
	<a href="<?=$this->Url->build(["controller"=> "agendamentos", "action" => "index"]);?>" class='btn btn-default pull-right'> <i class='fa fa-arrow-circle-left'></i> Voltar</a>
</h1>

<div class="row">
	<div class='col-lg-12'>
		<div class="well-busca clearfix">
			<h2 class="pull-left" style='margin:0px;'>Detalhes do Agendamento</h2>
		</div>
	</div>
</div>

<div class='row data'>

	<div class="col-lg-6">
		<div class="panel panel-info">
			<div class="panel-heading">Resumo do Agendamento</div>
			<ul class="list-group">
				<li class="list-group-item">
					<b>Status:</b>
					<span class='text-<?= $statusData[$agendamento->STATUS_CHR]['cor'];?>'><i class="fa <?= $statusData[$agendamento->STATUS_CHR]['icon'];?> "></i> <?php echo $agendamento->STATUS ;?></span>
				</li>
				<li class="list-group-item"><b>Aviso Cirurgia:</b> <?php echo $agendamento->AVISO_ID ?? '---' ;?></li>
				<li class="list-group-item"><b>Paciente:</b> <?php echo ucwords(mb_strtolower($agendamento->NM_PACIENTE)) ;?></li>

				<li class="list-group-item">
						<?php if(empty($agendamento->DT_CIRURGIA)) {?>
						<b>Sugestão Cirurgia:</b> <?php echo $agendamento->DT_SUG_CIR->format('d/m/Y H:i');?>
						<?php }else{?>
						<b>Data Cirurgia:</b> <?php echo $agendamento->DT_CIRURGIA;?>
						<?php }?>
				</li>

				<li class="list-group-item"><b>Convênio:</b> <?php echo ucwords(mb_strtolower($agendamento->convenio->NOME.' - '.$agendamento->plano->NOME));?></li>
				<li class="list-group-item"><b>Procedimento:</b> <?php echo ucwords(mb_strtolower($agendamento->DS_PROCEDIMENTO.' - '.$agendamento->DS_CIRURGIA));?></li>
				<li class="list-group-item"><b>Telefones:</b> <?php echo $agendamento->NR_TEL_PAC;?></li>
				<li class="list-group-item"><b>Data Solicitação:</b> <?php echo $agendamento->DT_SOLIC->format('d/m/Y H:i') ;?></li>
			</ul>
		</div>
	</div>

	<div class="col-lg-6">
		<div class="panel panel-info">
			<div class="panel-heading">Observações</div>
			<div class="panel-body obs">
					<p><?php echo nl2br($agendamento->DS_OBS);?></p>
			</div>
		</div>
	</div>


	<?php
	if(count($guias)>0){
	foreach($guias as $nome => $guia){
	?>
	<div class="col-lg-6">
		<div class="panel panel-info">
			<div class="panel-heading"><?=($nome);?><span class="label label-default pull-right ok"><?=$guia['dados']['SITUACAO']?></span></div>
			<div class="panel-body">
				<table class="table table-hover">
					<thead>
						<tr>
							<th>Procedimento</th>
							<th>Sol.</th>
							<th>Aut.</th>
						</tr>
					</thead>
					<?php foreach($guia['items'] as $item){ ?>
					<tbody>
						<tr>
							<td><?=$item['DS_PRO_FAT']?></td>
							<td><?=$item['QT_AUTORIZADO']?></td>
							<td><?=$item['QT_AUTORIZADA_CONVENIO']?></td>
						</tr>
					</tbody>
					<?php }?>
				</table>
			</div>
			<div class="panel-footer">
				Guia n.º <?=$guia['dados']['NR_GUIA']?> <span class="pull-right">Senha: <?=$guia['dados']['CD_SENHA']?></span>
    		</div>
		</div>
	</div>
	<?php }}?>
</div>
