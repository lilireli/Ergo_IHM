<div class="users form">
<h2><?php echo __('Gestion de mon compte')?></h2>

<?php echo $this->Form->create('User'); ?>
	<fieldset>
		<legend><?php echo __('Mes données'); ?></legend>
	<?php
		echo $this->Form->input('user_id');
		echo $this->Form->input('user_name');
		echo $this->Form->input('mail');
		echo $this->Form->input('date_of_birth');
		echo $this->Form->input('password');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Modifier mes données')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Retourner à mon profil'), array('action' => 'view')); ?> </li>
	</ul>
</div>
