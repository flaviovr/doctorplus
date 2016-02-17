<!-- File: src/Template/Articles/view.ctp -->
<div class="container">
	<div class="row">	
		<h1><?= h($article->title) ?></h1>
		<p><?= h($article->body) ?></p>
		<p><small>Created: <?= $article->created->format(DATE_RFC850) ?></small></p>
		<?=$this->Html->link('Voltar', ['action'=>'index']);
	</div>
</div>
