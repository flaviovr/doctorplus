<?php
$this->assign('title', 'Enviar Feedback sobre o sistema');
?>

<div class="container">


	<ol class="breadcrumb bg-info">
	  <li><a href="<?=$this->Url->build(["controller" => "Pages","action" => "display","home"]);?>"><span class='fa fa-home'></span> Início</a></li>
	  <li class="active">Feedback</li>
	</ol>

	<h1 class='roundTop'><i class='fa fa-cog'></i> Enviar Feedback</h1>

	<div class="well-busca roundBottom">
		<div class="row">
			<div class='col-lg-6 coluna'>
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
			</div>
			<div class='col-lg-6 coluna'>
				<?= $this->Form->create(false,['class'=>'form clearfix']);?>
					<div class="form-group">
						<?= $this->Form->textarea('mensagem',['rows' => '10','class'=>'form-control', 'placeholder'=> 'Digite sua sugestão', 'value'=>$mensagem , 'label'=>false]) ?>
					</div>
					<div class="form-group">
						<?= $this->Form->button(
								'Enviar Feedback',
								['type'=>'submit', 'name'=>'submit', 'class'=>'btn btn-primary pull-right']
						)?>
					</div>
				<?= $this->Form->end();?>
			</div>
		</div>
	</div>

</div>
