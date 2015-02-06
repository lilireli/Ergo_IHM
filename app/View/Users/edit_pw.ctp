<div class="users form">
<h3><?php echo __('Modifier mon mot de passe')?></h3>

<?php echo $this->Form->create('User'); ?>
	<fieldset>
		<legend><?php echo __('Mot de passe'); ?></legend>
	<?php
		echo $this->Form->input('user_id', array(
			'type' => 'hidden'));
		echo $this->Form->input('password', array(
			'type' => 'hidden'));
		echo $this->Form->input('old_password', array(
			'type'=>'password', 
			'label' => 'Ancien mot de passe',
			'value'=>'', 
			'autocomplete'=>'off'
		));
		echo $this->Form->input('new_password', array(
			'type'=>'password', 
			'label' => 'Nouveau mot de passe',
			'value'=>'', 
			'autocomplete'=>'off'
		));
		echo $this->Form->input('re_password', array(
			'type'=>'password', 
			'label'=>'Confirmer votre nouveau mot de passe', 
			'value'=>'', 
			'autocomplete'=>'off'
		));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Modifier mon mot de passe')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li>
			<?php 
				echo $this->Html->link(__('Retourner à mon profil'), 
					array('action' => 'index'));
			?> 
		</li>
	</ul>
</div>
