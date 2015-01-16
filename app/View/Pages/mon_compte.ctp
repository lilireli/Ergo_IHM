<h1> Modification des données de mon compte </h1>

<?php echo $this->session->read('Auth.User.user_id'); ?>
<?php echo $this->session->read('Auth.User.username'); ?>
<?php echo $this->session->read('Auth.User.id'); ?>
   
<div class="users form">
<?php 
	$user_id = $this->session->read('Auth.User.username');
	echo $this->Form->create('User', array('action' => 'edit/5')); 
?>
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
