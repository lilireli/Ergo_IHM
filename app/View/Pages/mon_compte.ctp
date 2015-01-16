<h1> Louée
</h1>
   
<div class="users form">
<?php echo $this->Form->create('User', array('action' => 'edit')); ?>
	<fieldset>
		<legend><?php echo __('mes donnees'); ?></legend>
	<?php
		echo $this->Form->input('user_id');
		echo $this->Form->input('user_name');
		echo $this->Form->input('mail');
		echo $this->Form->input('password');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
