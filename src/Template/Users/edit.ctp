<!-- src/Template/Users/edit.ctp -->
<div class="container">
	<div class="row">	
		<div class="users form">
		<?= $this->Form->create($user) ?>
		    <fieldset>
		        <legend><?= __('Add User') ?></legend>
		        <?= $this->Form->input('username') ?>
		        <?= $this->Form->password('password') ?>
		        <?= $this->Form->input('role', [
		            'options' => ['admin' => 'Admin', 'author' => 'Author']
		        ]) ?>
		   </fieldset>
		<?= $this->Form->button(__('Submit')); ?>
		<?= $this->Form->end() ?>
		</div>
	</div>
</div>
