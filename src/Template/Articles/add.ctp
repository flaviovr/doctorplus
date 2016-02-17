<!-- File: src/Template/Articles/add.ctp -->
<div class="container">
	<div class="row">	
		<h1>Add Article</h1>
		<?php
		    echo $this->Form->create($article);
		    echo $this->Form->input('title');
		    echo $this->Form->input('body', ['rows' => '3']);
		    echo $this->Form->button(__('Save Article'));
		    echo $this->Form->end();
		?>
	</div>
</div>

