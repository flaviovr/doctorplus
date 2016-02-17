<!-- File: src/Template/Articles/view.ctp -->
<div class="container">
	<div class="row">	
		<h1><?= h($user->username) ?></h1>
		<p><?= h($user->password) ?></p>
		<?=$this->Html->link('Voltar', ['action'=>'index'])?>
	</div>
</div>
