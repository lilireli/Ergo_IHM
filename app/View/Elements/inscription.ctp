<div class="users form">
<?php echo $this->Form->create('User', array('action' => 'add')); ?>
	<fieldset>
		<legend><?php echo __("S'inscrire"); ?></legend>
	<?php
		echo $this->Form->input('user_name');
		echo $this->Form->input('mail');
		echo $this->Form->input('password');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>