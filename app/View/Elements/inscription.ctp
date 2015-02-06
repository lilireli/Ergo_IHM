<div class="login form" id="inscription">
	<h3><?php echo __("Inscription"); ?></h3>

	<?php echo $this->Form->create('User', array('action' => 'add')); ?>
	<fieldset>
	<?php
		echo $this->Form->input('user_name', array('label' => "Nom d'utilisateur"));
		echo $this->Form->input('mail', array('label' => "E-mail"));
		echo $this->Form->input('date_of_birth', array(
			'label' => 'Date de naissance',
			'dateFormat' => 'DMY',
    		'minYear' => date('Y') - 80,
    		'maxYear' => date('Y')
    	));
		echo $this->Form->input('new_password', array(
			'type'=>'password', 
			'label'=>'Mot de passe', 
			'value'=>'', 
			'autocomplete'=>'off'
		));
		echo $this->Form->input('re_password', array(
			'type'=>'password', 
			'label'=>'Confirmer votre mot de passe', 
			'value'=>'', 
			'autocomplete'=>'off'
		));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Créer mon compte')); ?>
</div>