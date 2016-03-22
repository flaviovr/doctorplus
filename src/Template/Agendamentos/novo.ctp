<?php
$this->assign('title', 'Novo Agendamento');

?>
<div class="container">


	<ol class="breadcrumb bg-info">
		<li><a href="<?=$this->Url->build(["controller" => "Pages","action" => "display","home"]);?>"><span class='fa fa-home'></span> Início</a></li>
		<li class="active">Agendamentos</li>
	</ol>

	<h1 class="roundTop">
		<i class='fa fa-calendar-o'></i>
		Agendamentos
		<a href="<?=$this->Url->build(["action" => "index"]);?>" class='btn btn-default pull-right'> <i class='fa fa-arrow-circle-left'></i> Voltar</a>
	</h1>

	<div class="row">
		<div class='col-lg-12'>
			<div class="well-busca clearfix">
				<h2 class="pull-left" style='margin:0px;'>Marcar Agendamento</h2>
				<a href="javascript:document.forms[0].submit.click();void(0);" class='btn btn-sm btn-success pull-right' style='margin-left:10px;'> <i class='fa fa-floppy-o'></i> Salvar</a>&nbsp;&nbsp;
				<a href="<?=$this->Url->build(["action" => "index"]);?>" class='btn btn-sm btn-danger pull-right'> <i class='fa fa-ban'></i> Cancelar</a>
			</div>
		</div>
	</div>

	<div class='row data'>

		<div class='col-lg-12'>

			<?= $this->Form->create($agendamento, [ 'type' => 'file' ]); ?>

				<!-- DADOS DO USUARIO -->
				<fieldset class="row">

					<div class="col-lg-12">
						<h3>Dados do Usuário</h3>
					</div>

					<div class="col-sm-4 form-group">
						<?= $this->Form->input('cpf',['class'=>'form-control getCPF', 'label'=>'CPF :' ]) ?>
					</div>

					<div class="col-sm-8 form-group">
						<?= $this->Form->input('NM_PACIENTE',['class'=>'form-control', 'label'=>'Nome do Paciente :' ]) ?>
					</div>

					<div class="col-md-4 col-sm-6 form-group">
						<label>Sexo:</label>
						<?php $options = ['M' => 'Masculino', 'F' => 'Feminino']; ?>
						<?= $this->Form->select('TP_SEXO', $options, ['class'=>'form-control', 'label'=>'Sexo:' , 'empty'=>'Selecione']) ?>
					</div>

					<div class="col-md-4 col-sm-6 form-group">
						<?php $options = ['A+' => 'A+', 'A-' => 'A-', 'AB+' => 'AB+', 'AB-' => 'AB-', 'B+' => 'B+', 'B-' => 'B-', 'O+' => 'O+','O-' => 'O-']; ?>
						<label>Fator RH:</label>
						<?= $this->Form->select('TP_SANGUINEO', $options, ['class'=>'form-control', 'empty'=>'Selecione' ]) ?>
					</div>

					<div class="col-md-4 col-sm-6 form-group">
						<?= $this->Form->input('DT_NASCIMENTO',['class'=>'form-control',  'label'=>'Data de Nascimento:' ]) ?>
					</div>

					<div class="col-md-4 col-sm-6 form-group">
						<?= $this->Form->input('FONE',['class'=>'form-control', 'label'=>'Telefone:' ]) ?>
					</div>

					<div class="col-md-4 col-sm-6 form-group">
						<?= $this->Form->input('CELULAR',['class'=>'form-control', 'label'=>'Celular:' ]) ?>
					</div>

					<div class="col-md-4 col-sm-6 form-group">
						<?= $this->Form->input('EMAIL',['class'=>'form-control', 'label'=>'E-mail:', 'type'=>'email' ]) ?>
					</div>

				</fieldset>

				<!-- DADOS DO PLANO -->
				<fieldset class="row">

					<div class="col-lg-12">
						<h3>Dados do Plano</h3>
					</div>

					<div class="col-sm-4  form-group">
						<?php $options = ['M' => 'Male', 'F' => 'Female']; ?>
						<label for="ds-email-paciente">Convênio:</label>
						<?= $this->Form->select('convenio_id', $convenios, [
							'class'=>'form-control cascade',
							'data-destino'=>'[name=plano_id]',
							'data-url'=>'getPlano/' ,
							'empty'=>'Selecione'
							])
							?>
					</div>

					<div class="col-sm-4 form-group">
						<label for="ds-email-paciente">Plano:</label>
						<?= $this->Form->select('plano_id', null , ['class'=>'form-control', 'disabled'=>'disabled' , 'empty'=>'Selecione o Convênio' ]) ?>
					</div>

					<div class="col-sm-4  form-group">
						<?= $this->Form->input('cd_matricula',['class'=>'form-control', 'label'=>'Matrícula' ]) ?>
					</div>

				</fieldset>

				<fieldset class="row">
					<!-- ALERGIAS -->
					<div class="col-xs-12">
						<h3>Alergias</h3>
					</div>

					<div class="col-md-4 sol-sm-form-group ">
						<label><?= $this->Form->checkbox('medicamentosa') ?>&nbsp;&nbsp;&nbsp;Medicamentosa</label>
						<?= $this->Form->input('outras',['class'=>'form-control', 'label'=> false]) ?>
					</div>
					<div class="col-md-4 form-group ">
						<label><?= $this->Form->checkbox('alimentar') ?>&nbsp;&nbsp;&nbsp;Alimentar</label>
						<?= $this->Form->input('outras',['class'=>'form-control', 'label'=> false]) ?>
					</div>
					<div class="col-md-4 form-group ">
						<br><label><?= $this->Form->checkbox('alimentar') ?>&nbsp;&nbsp;&nbsp;Latex</label>
					</div>
				</fieldset>

				<!-- DADOS DO PRESTADOR -->
				<fieldset class="row">

					<div class="col-md-12">
						<h3>Dados do Prestador</h3>
					</div>

					<div class="col-sm-6  form-group">
						<label>Especialidade:</label>
						<?php
						echo $this->Form->select('cd_plano', $esp, ['class'=>'form-control', 'empty'=>'Selecione'])
						?>
					</div>

					<div class="col-sm-6  form-group">
						<label>Cirurgião:</label>
						<p class="form-control-static"><?=$userAuth['USERNAME']?></p>
					</div>

				</fieldset>

				<!-- DADOS DA CIRURGIA -->
				<fieldset class="row">

					<div class="col-lg-12">
						<h3>Dados da Cirurgia</h3>
					</div>

					<div class="col-sm-6 form-group">
						<label >Cirurgia Principal</label>
						<div class="input-group">
							<input type="text" name='cirurgia1' class="form-control" id='cirurgia1' autocomplete='off' placeholder="Digite o código da cirurgia">
							<div class="input-group-addon"><span class="fa fa-search"></span></div>
						</div>
						<div  id='listaCirurgia1'></div>
					</div>


					<div class="col-sm-6 form-group">
						<label >Cirurgias Secundárias</label>
						<div class="input-group">
							<input type="text" name="cirurgia2" class="form-control" id='cirurgia2' autocomplete='off' placeholder="Digite o código da cirurgia">
							<div class="input-group-addon"><span class="fa fa-search"></span></div>
						</div>
						<div id='listaCirurgia2'></div>
					</div>


					<div class="clearfix"></div>

					<div class="col-sm-4 form-group">
						<?php $options = ['Geral', 'Local', 'Regional Peridural ou Raquidiana', 'Sedação']; ?>
						<label>Anestesia:</label>
						<?= $this->Form->select('anestesia', $options, ['class'=>'form-control', 'empty'=>'Selecione' ]) ?>
					</div>

					<div class="col-sm-4 form-group">
						<?php $options = ['Direita', 'Esquerda', 'Bilateral', 'Não se aplica']; ?>
						<label>Lateralidade:</label>
						<?= $this->Form->select('lateralidade', $options, ['class'=>'form-control', 'empty'=>'Selecione' ]) ?>
					</div>

					<div class="col-sm-4 form-group">
						<?php $options = ['Não', 'UTI', 'Semi-Intensiva', 'UTO', 'UTI Neonatal']; ?>
						<label>Necessita UTI:</label>
						<?= $this->Form->select('anestesia', $options, ['class'=>'form-control', 'default'=>'Não' ]) ?>
					</div>

					<div class="col-md-4 col-sm-12 form-group">
						<?= $this->Form->input('diagnostico',['class'=>'form-control', 'label'=>'Diagnóstico:', 'type' => 'textarea', 'rows' => '8' ]) ?>
					</div>
					<div class="col-md-4 col-sm-12 form-group">
						<?= $this->Form->input('comorbidades',['class'=>'form-control', 'label'=>'Comorbidades:', 'type' => 'textarea', 'rows' => '8', ]) ?>
					</div>

					<div class="col-md-4 col-sm-12 form-group">
						<?= $this->Form->input('observacoes',['class'=>'form-control', 'label'=>'Observações:', 'type' => 'textarea', 'rows' => '8' ]) ?>
					</div>

					<!-- NECESSITA SANGUE -->
					<div class="col-sm-12">
						<h3>Necessita sangue?</h3>
					</div>

					<div class="col-md-3 col-sm-6 form-group ">
						<?= $this->Form->input('outras',['class'=>'form-control', 'label'=> 'Concentrado de Hemácias']) ?>
					</div>

					<div class="col-md-3 col-sm-6 form-group ">
						<?= $this->Form->input('outras',['class'=>'form-control', 'label'=> 'Concentrado de Plaquetas']) ?>
					</div>

					<div class="col-md-3 col-sm-6 form-group ">
						<?= $this->Form->input('outras',['class'=>'form-control', 'label'=> 'Plasma']) ?>
					</div>

					<div class="col-md-3 col-sm-6 form-group ">
						<?= $this->Form->input('outras',['class'=>'form-control', 'label'=> 'Crioprecipitado']) ?>
					</div>

					<!-- OUTRAS INFORMACOES -->
					<div class="col-sm-12">
						<h3>Outras Informações:</h3>
					</div>
					<div class="col-sm-6 form-group ">
						<?= $this->Form->input('medicacao_especial',['class'=>'form-control', 'label'=> 'Medicação Especial?']) ?>
					</div>
					<div class="col-sm-6 form-group ">
						<br>
						<label><?= $this->Form->checkbox('alimentar') ?>&nbsp;&nbsp;Necessita congelação&nbsp;&nbsp;&nbsp;</label>
						<label><?= $this->Form->checkbox('fixador_mayfield') ?>&nbsp;&nbsp;Não necessita OPME&nbsp;&nbsp;&nbsp;</label>
					</div>

					<!-- EQUIPAMENTOS -->
					<div class="col-sm-12 clearfix">
						<h3>Equipamentos:</h3>
					</div>

					<div class="col-sm-4 form-group">
						<?php $options = ['Não', 'Próprio', 'Hospital', 'Empresa',]; ?>
						<label>Vídeo cirúrgico:</label>
						<?= $this->Form->select('video_cirurgico', $options, ['class'=>'form-control', 'default'=>'Não' ]) ?>
					</div>
					<div class="col-sm-4 form-group">
						<?php $options = ['Não', 'Penteiro', 'Zeiss']; ?>
						<label>Microscópio:</label>
						<?= $this->Form->select('microscopio', $options, ['class'=>'form-control', 'default'=>'Não' ]) ?>
					</div>
					<div class="col-sm-4 form-group">
						<?php $options = ['Não', 'DMG', 'Extracor','Terumo']; ?>
						<label>CEC:</label>
						<?= $this->Form->select('cec', $options, ['class'=>'form-control', 'default'=>'Não' ]) ?>
					</div>

					<div class="col-sm-12 form-group ">
						<label><?= $this->Form->checkbox('alimentar') ?>&nbsp;&nbsp;Suporte de coluna&nbsp;&nbsp;&nbsp;</label>
						<label><?= $this->Form->checkbox('fixador_mayfield') ?>&nbsp;&nbsp;Fixador Mayfield&nbsp;&nbsp;&nbsp;</label>
						<label><?= $this->Form->checkbox('manguito_pneumático') ?>&nbsp;&nbsp;Manguito pneumático&nbsp;&nbsp;&nbsp;</label>
						<label><?= $this->Form->checkbox('mesa_ortopedica') ?>&nbsp;&nbsp;Mesa ortopédica&nbsp;&nbsp;&nbsp;</label>
						<label><?= $this->Form->checkbox('intensificador_imagem') ?>&nbsp;&nbsp;Intensificador de imagem&nbsp;&nbsp;&nbsp;</label>
						<label><?= $this->Form->checkbox('eco_transesofágico') ?>&nbsp;&nbsp;Eco-transesofágico&nbsp;&nbsp;&nbsp;</label>
						<label><?= $this->Form->checkbox('ligasure') ?>&nbsp;&nbsp;Ligasure&nbsp;&nbsp;&nbsp;</label>
						<label><?= $this->Form->checkbox('cell_saver') ?>&nbsp;&nbsp;Cell Saver&nbsp;&nbsp;&nbsp;</label>
						<label><?= $this->Form->checkbox('ultracission') ?>&nbsp;&nbsp;Ultracission&nbsp;&nbsp;&nbsp;</label>
						<label><?= $this->Form->checkbox('ultrassom') ?>&nbsp;&nbsp;Ultrassom&nbsp;&nbsp;&nbsp;</label>
					</div>

				</fieldset>

				<!-- DOCUMENTOS -->
				<fieldset class="row">

					<div class="col-lg-12">
						<h3>Documentos</h3>
					</div>

					<div class="col-lg-4 col-sm-6 form-group">
					   <label for="laudo">Laudos:</label>
					   <div class="input-group">
						   <span class="input-group-btn">

							   <span class="btn btn-primary btn-file">
								   Procurar&hellip; <?= $this->Form->input('laudo', [ 'label'=> false,'type' => 'file', 'multiple']) ?>
							   </span>
						   </span>
						   <input type="text" class="form-control" readonly>
					   </div>
					   <span class="help-block">Selecione os arquivos de Laudo</span>
					</div>

					<div class="col-lg-4 col-sm-6 form-group">
					   <label for="laudo">OPME:</label>
					   <div class="input-group">
						   <span class="input-group-btn">

							   <span class="btn btn-primary btn-file">
								   Procurar&hellip; <?= $this->Form->input('opme[]', [ 'label'=> false,'type' => 'file', 'multiple']) ?>
							   </span>
						   </span>
						   <input type="text" class="form-control" readonly>
					   </div>
					   <span class="help-block">Selecione os arquivos de OPME</span>
					</div>

					<div class="col-lg-4 col-sm-6 form-group">
					   <label for="laudo">Pedidos:</label>
					   <div class="input-group">
						   <span class="input-group-btn">

							   <span class="btn btn-primary btn-file">
								   Procurar&hellip; <?= $this->Form->input('pedido', [ 'label'=> false,'type' => 'file', 'multiple']) ?>
							   </span>
						   </span>
						   <input type="text" class="form-control" readonly>
					   </div>
					   <span class="help-block">Selecione os arquivos de Pedidos</span>
					</div>
					<div class="col-md-12 form-group ">
						<label><?= $this->Form->checkbox('alimentar') ?>&nbsp;&nbsp;&nbsp;Procedimento sem laudo</label>
					</div>
				</fieldset>


					<?= $this->Form->button(
							'Salvar',
							['type'=>'submit', 'name'=>'submit', 'class'=>'sr-only btn btn-primary center-block']
					)?>


				<?= $this->Form->end(); ?>

		</div>

	</div>

	<div class="row">
		<div class='col-lg-12'>
			<div class="well-busca clearfix">
				<a href="javascript:document.forms[0].submit.click();void(0);" class='btn btn-sm btn-success pull-right' style='margin-left:10px;'> <i class='fa fa-floppy-o'></i> Salvar</a>&nbsp;&nbsp;
				<a href="<?=$this->Url->build(["action" => "index"]);?>" class='btn btn-sm btn-danger pull-right'> <i class='fa fa-ban'></i> Cancelar</a>
			</div>
		</div>
	</div>

</div>
