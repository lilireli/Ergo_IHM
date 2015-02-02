<div class="users form">
<h2><?php echo __('Gestion de mon compte')?></h2>

<?php echo $this->Form->create('User'); ?>
	<fieldset>
		<legend><?php echo __('Mes données'); ?></legend>
	<?php
		echo $this->Form->input('user_id', array(
			'type' => 'hidden'));
		echo $this->Form->input('user_name', array('label' => "Nom d'utilisateur"));
		echo $this->Form->input('mail', array('label' => "E-mail"));
		echo $this->Form->input('date_of_birth', array(
			'label' => 'Date de naissance',
			'dateFormat' => 'DMY',
    		'minYear' => date('Y') - 80,
    		'maxYear' => date('Y')
    	));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Modifier mes données')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li>
			<?php 
				echo $this->Html->link(__('Retourner à mon profil'), 
					array('action' => 'view', basename($this->request->here))); 
				// basename nous permet de récupérer l'user_id
			?> 
		</li>
	</ul>
</div>
