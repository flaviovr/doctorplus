<?php
$this->assign('title', 'Detalhes do Agendamento');
$this->Form->templates('agenda_form');

?>



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
					<label>CPF:</label>
					<p class="form-control-static"><?php echo h($agendamento['CPF']);?></p>
				</div>

				<div class="col-sm-8 form-group">
					<label>Nome do Paciente:</label>
					<p class="form-control-static"><?php echo h($agendamento['NM_PACIENTE']);?></p>
				</div>

				<div class="col-md-4 col-sm-6 form-group">
					<label>Sexo:</label>
					<p class="form-control-static"><?php echo h($agendamento['TP_SEXO']);?></p>
				</div>

				<div class="col-md-4 col-sm-6 form-group">
					<label>Fator RH:</label>
					<p class="form-control-static"><?php echo h($agendamento['TP_SANGUINEO']);?></p>
				</div>

				<div class="col-md-4 col-sm-6 form-group ">
					<?= $this->Form->input('DT_NASCIMENTO',['class'=>'form-control dtp_year' , 'label'=>'Data de Nascimento:' ]) ?>
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
					<?= $this->Form->input('CONVENIO_ID', [ 'options' => $convenios, 'type' => 'select', 'label' => 'Convênio:', 'class'=>'form-control cascade', 'data-destino'=>'[name=PLANO_ID]', 'data-url'=>'getPlano/' , 'empty'=>'Selecione'])?>
				</div>

				<div class="col-sm-4 form-group">
					<?= $this->Form->input('PLANO_ID', [ 'options' => $planos, 'type' => 'select', 'label' => 'Plano:', 'class'=>'form-control', 'empty'=>'Selecione'  ]) ?>
				</div>

				<div class="col-sm-4  form-group">
					<?= $this->Form->input('CD_MATRICULA',['class'=>'form-control', 'label'=>'Matrícula' ]) ?>
				</div>

			</fieldset>

			<fieldset class="row">
				<!-- ALERGIAS -->
				<div class="col-xs-12">
					<h3>Alergias</h3>
				</div>

				<div class="col-sm-4 form-group ">
					<?= $this->Form->input('MEDICAMENTOSA',['class'=>'form-control', 'label'=> 'Medicamentosa']) ?>
				</div>
				<div class="col-sm-4 form-group ">
					<?= $this->Form->input('ALIMENTAR',['class'=>'form-control', 'label'=> 'Alimentar']) ?>
				</div>
				<div class="col-sm-4 form-group ">
					<br><label><?= $this->Form->checkbox('LATEX') ?>&nbsp;&nbsp;&nbsp;Latex</label>
				</div>
			</fieldset>

			<!-- DADOS DO PRESTADOR -->
			<fieldset class="row">

				<div class="col-md-12">
					<h3>Dados do Prestador</h3>
				</div>

				<div class="col-sm-6  form-group">
					<?= $this->Form->input('ESPECIALIDADE', ['class'=>'form-control', 'options'=> $esp, 'type'=>'select', 'label'=>'Especialidade:', 'empty'=>'Selecione'])?>
				</div>

				<div class="col-sm-6  form-group">
					<label>Cirurgião:</label>
					<p class="form-control-static"><?=$userAuth['USERNAME']?></p>
					<input type="hidden" name="CD_PRESTADOR" value="<?=$userAuth['ID']?>">
					<input type="hidden" name="USUARIO" value="<?=$userAuth['USERNAME']?>">
				</div>

			</fieldset>


			<fieldset class="row">

				<!-- DADOS DA CIRURGIA -->
				<div class="col-lg-12">
					<h3>Dados da Cirurgia</h3>
				</div>

				<div class="col-sm-6 form-group">
					<label >Cirurgia Principal</label>
					<div class="input-group">
						<input type="text" name='cirurgia1' class="form-control" id='cirurgia1' autocomplete='off' placeholder="Digite o código da cirurgia">
						<div class="input-group-addon"><span class="fa fa-search"></span></div>
					</div>
					<div  id='listaCirurgia1'>
						<?php
						if(!empty($this->request->data('CD_CIRURGIA'))) echo "<div class='alert alert-info' role='alert' style='padding:5px 8px; margin:8px 0 0 0;'>
							<span class='pull-right' style='cursor:pointer;' onclick='this.parentElement.remove();'><i class='fa fa-close'></i> Excluir</span>".
							ucfirst(strtolower($cirurgias[$this->request->data('CD_CIRURGIA')])) . "<input type='hidden' name='CD_CIRURGIA' value='" . $this->request->data('CD_CIRURGIA') . "'></div>";
						?>
					</div>
				</div>


				<div class="col-sm-6 form-group">
					<label >Cirurgias Secundárias</label>
					<div class="input-group">
						<input type="text" name="cirurgia2" class="form-control" id='cirurgia2' autocomplete='off' placeholder="Digite o código da cirurgia">
						<div class="input-group-addon"><span class="fa fa-search"></span></div>
					</div>
					<div id='listaCirurgia2'>
						<?php
						if(!empty($this->request->data('CD_CIRURGIA_EXTRA'))) foreach ($this->request->data('CD_CIRURGIA_EXTRA') as $value)
							echo "<div class='alert alert-warning' role='alert' style='padding:5px 8px; margin:8px 0 0 0;'>
							<span class='pull-right' style='cursor:pointer;' onclick='this.parentElement.remove();'><i class='fa fa-close'></i> Excluir</span>".
							ucfirst(strtolower($cirurgias[$value])) . "<input type='hidden' name='CD_CIRURGIA_EXTRA[]' value='" . $value . "'></div>";
						?>
					</div>
				</div>


				<div class="clearfix"></div>

				<div class="col-sm-4 form-group">
					<?php $options = [ '1'=>'Geral', '2'=>'Local', '3'=>'Regional Peridural ou Raquidiana', '4'=>'Sedação']; ?>
					<?= $this->Form->input('ANESTESIA', [ 'options'=> $options, 'label'=>'Anestesia:', 'type' => 'select', 'class'=>'form-control', 'empty'=>'Selecione' ]) ?>
				</div>

				<div class="col-sm-4 form-group">
					<?php $options = ['1'=>'Direita', '2'=>'Esquerda', '3'=>'Bilateral', '4'=>'Não se aplica']; ?>
					<?= $this->Form->input('LATERALIDADE', ['options'=> $options, 'label'=>'Lateralidade:', 'type' => 'select','class'=>'form-control', 'empty'=>'Selecione' ]) ?>
				</div>

				<div class="col-sm-4 form-group">
					<?php $options = ['Não'=>'Não', 'UTI'=>'UTI', 'Semi-Intensiva'=>'Semi-Intensiva', 'UTO'=>'UTO', 'UTI Neonatal'=>'UTI Neonatal']; ?>
					<?= $this->Form->input('TIPO_UTI', [ 'options'=> $options, 'label'=>'Necessita UTI:', 'type' => 'select', 'class'=>'form-control', 'default'=>'Não' ]) ?>
				</div>

				<div class="col-md-4 col-sm-12 form-group">
					<?= $this->Form->input('DIAGNOSTICO',['class'=>'form-control', 'label'=>'Diagnóstico:', 'type' => 'textarea', 'rows' => '8' ]) ?>
				</div>

				<div class="col-md-4 col-sm-12 form-group">
					<?= $this->Form->input('COMORBIDADES',['class'=>'form-control', 'label'=>'Comorbidades:', 'type' => 'textarea', 'rows' => '8', ]) ?>
				</div>

				<div class="col-md-4 col-sm-12 form-group">
					<?= $this->Form->input('OBSERVACOES',['class'=>'form-control', 'label'=>'Observações:', 'type' => 'textarea', 'rows' => '8' ]) ?>
				</div>

			</fieldset>

			<fieldset class="row">

				<!-- NECESSITA SANGUE -->
				<div class="col-sm-12">
					<h3>Necessita sangue?</h3>
				</div>

				<div class="col-md-3 col-sm-6 form-group ">
					<?= $this->Form->input('HEMACIAS',['class'=>'form-control', 'label'=> 'Concentrado de Hemácias']) ?>
				</div>

				<div class="col-md-3 col-sm-6 form-group ">
					<?= $this->Form->input('PLAQUETAS',['class'=>'form-control', 'label'=> 'Concentrado de Plaquetas']) ?>
				</div>

				<div class="col-md-3 col-sm-6 form-group ">
					<?= $this->Form->input('PLASMA',['class'=>'form-control', 'label'=> 'Plasma']) ?>
				</div>

				<div class="col-md-3 col-sm-6 form-group ">
					<?= $this->Form->input('CRIO',['class'=>'form-control', 'label'=> 'Crioprecipitado']) ?>
				</div>

				<!-- OUTRAS INFORMACOES -->
				<div class="col-sm-12">
					<h3>Outras Informações:</h3>
				</div>
				<div class="col-sm-6 form-group ">
					<?= $this->Form->input('MEDICACAO',['class'=>'form-control', 'label'=> 'Medicação Especial?']) ?>
				</div>
				<div class="col-sm-6 form-group ">
					<br>
					<label><?= $this->Form->checkbox('CONGELACAO') ?>&nbsp;&nbsp;Necessita congelação&nbsp;&nbsp;&nbsp;</label>
					<label><?= $this->Form->checkbox('SEM_OPME') ?>&nbsp;&nbsp;Não necessita OPME&nbsp;&nbsp;&nbsp;</label>
				</div>

				<!-- EQUIPAMENTOS -->
				<div class="col-sm-12 clearfix">
					<h3>Equipamentos:</h3>
				</div>

				<div class="col-sm-4 form-group">
					<?php $options = ['Não'=>'Não', 'Próprio'=>'Próprio', 'Hospital'=>'Hospital', 'Empresa'=>'Empresa']; ?>
					<?= $this->Form->input('VIDEO', [ 'options'=> $options, 'label'=>'Vídeo Cirúrgico:', 'type' => 'select', 'class'=>'form-control', 'default'=>'Não' ]) ?>
				</div>

				<div class="col-sm-4 form-group">
					<?php $options = ['Não'=>'Não', 'Penteiro'=>'Penteiro', 'Zeiss'=>'Zeiss']; ?>
					<?= $this->Form->input('MICROSCOPIO', ['options'=> $options, 'label'=>'Microscópio:' , 'type' => 'select', 'class'=>'form-control', 'default'=>'Não' ]) ?>
				</div>

				<div class="col-sm-4 form-group">
					<?php $options = ['Não'=>'Não', 'DMG'=>'DMG', 'Extracor'=>'Extracor','Terumo'=>'Terumo']; ?>
					<?= $this->Form->input('CEC', ['options'=> $options, 'label'=>'CEC:', 'type' => 'select' , 'class'=>'form-control', 'default'=>'Não' ]) ?>
				</div>

				<div class="col-sm-12 form-group ">
					<label><?= $this->Form->checkbox('EQUIPAMENTOS.Suporte_de_Coluna') ?>&nbsp;&nbsp;Suporte de coluna&nbsp;&nbsp;&nbsp;</label>
					<label><?= $this->Form->checkbox('EQUIPAMENTOS.Fixador_Mayfield') ?>&nbsp;&nbsp;Fixador Mayfield&nbsp;&nbsp;&nbsp;</label>
					<label><?= $this->Form->checkbox('EQUIPAMENTOS.Manguito_Pneumático') ?>&nbsp;&nbsp;Manguito pneumático&nbsp;&nbsp;&nbsp;</label>
					<label><?= $this->Form->checkbox('EQUIPAMENTOS.Mesa_Ortopédica') ?>&nbsp;&nbsp;Mesa ortopédica&nbsp;&nbsp;&nbsp;</label>
					<label><?= $this->Form->checkbox('EQUIPAMENTOSC.Intensificador_de_Imagem') ?>&nbsp;&nbsp;Intensificador de imagem&nbsp;&nbsp;&nbsp;</label>
					<label><?= $this->Form->checkbox('EQUIPAMENTOSC.Eco-transesofágico') ?>&nbsp;&nbsp;Eco-transesofágico&nbsp;&nbsp;&nbsp;</label>
					<label><?= $this->Form->checkbox('EQUIPAMENTOSC.Ligasure') ?>&nbsp;&nbsp;Ligasure&nbsp;&nbsp;&nbsp;</label>
					<label><?= $this->Form->checkbox('EQUIPAMENTOSC.Cell_Saver') ?>&nbsp;&nbsp;Cell Saver&nbsp;&nbsp;&nbsp;</label>
					<label><?= $this->Form->checkbox('EQUIPAMENTOSC.Ultracission') ?>&nbsp;&nbsp;Ultracission&nbsp;&nbsp;&nbsp;</label>
					<label><?= $this->Form->checkbox('EQUIPAMENTOSC.Ultrassom') ?>&nbsp;&nbsp;Ultrassom&nbsp;&nbsp;&nbsp;</label>
				</div>
			</fieldset>

			<!-- DATAS E HORA -->
			<fieldset class="row">

				<div class="col-lg-12">
					<h3>Data & Hora</h3>
				</div>

				<div class="col-md-3 col-sm-6 form-group">
					<?php $options = [];for ($i=1; $i<=30; $i++) $options[$i] = $i>1 ? $i.' horas' : $i.' hora';?>
					<?= $this->Form->input('DT_DURACAO', [ 'options'=> $options, 'label'=>'Horas de Sala Cirúrgica:', 'type' => 'select', 'class'=>'form-control', 'empty'=>'Selecione' ]) ?>
				</div>

				<div class="col-md-3 col-sm-6 form-group">
					<?php $options = ['Day Clinic'=>'Day Clinic'];for ($i=1; $i<=30; $i++) $options[$i] = $i>1 ? $i.' dias' : $i.' dia';?>
					<?= $this->Form->input('DT_INT_HOSP', ['options'=> $options, 'label'=>'Dias de Internação Hospitalar:' , 'type' => 'select', 'class'=>'form-control', 'empty'=>'Selecione' ]) ?>
				</div>

				<div class="col-md-3 col-sm-6 form-group">
					<?php $options = [];for ($i=1; $i<=30; $i++) $options[$i] = $i>1 ? $i.' dias' : $i.' dia';?>
					<?= $this->Form->input('DT_INT_UTI', ['options'=> $options, 'label'=>'Dias de Internação em UTI:', 'type' => 'select' , 'class'=>'form-control', 'empty'=>'Selecione' ]) ?>
				</div>

				<div class="col-md-3 col-sm-6 form-group">
					<?= $this->Form->input('DT_CIRURGIA',['class'=>'form-control dtp_diahora' , 'label'=>'Data/Hora Preferencial' ]) ?>
				</div>


			</fieldset>

			<!-- DOCUMENTOS -->
			<fieldset class="row">

				<div class="col-lg-12">
					<h3>Documentos</h3>
				</div>

				<div class="col-lg-4 col-sm-6 form-group">
				   <label for="LAUDO">Laudos:</label>
				   <div class="input-group">
					   <span class="input-group-btn">

						   <span class="btn btn-primary btn-file">
							   Procurar&hellip; <?= $this->Form->input('LAUDO[]', [ 'label'=> false,'type' => 'file', 'multiple']) ?>
						   </span>
					   </span>
					   <input type="text" class="form-control" readonly>
				   </div>
				   <span class="help-block">Selecione os arquivos de Laudo</span>
				</div>

				<div class="col-lg-4 col-sm-6 form-group">
				   <label>OPME:</label>
				   <div class="input-group">
					   <span class="input-group-btn">

						   <span class="btn btn-primary btn-file">
							   Procurar&hellip; <?= $this->Form->input('OPME[]', [ 'label'=> false,'type' => 'file', 'multiple']) ?>
						   </span>
					   </span>
					   <input type="text" class="form-control" readonly>
				   </div>
				   <span class="help-block">Selecione os arquivos de OPME</span>
				</div>

				<div class="col-lg-4 col-sm-6 form-group">
				   <label>Pedidos:</label>
				   <div class="input-group">
					   <span class="input-group-btn">

						   <span class="btn btn-primary btn-file">
							   Procurar&hellip; <?= $this->Form->input('PEDIDO[]', [ 'label'=> false,'type' => 'file', 'multiple']) ?>
						   </span>
					   </span>
					   <input type="text" class="form-control" readonly>
				   </div>
				   <span class="help-block">Selecione os arquivos de Pedidos</span>
				</div>

				<div class="col-md-12 form-group ">
					<label><?= $this->Form->checkbox('SEM_LAUDO') ?>&nbsp;&nbsp;&nbsp;Procedimento sem laudo</label>
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
