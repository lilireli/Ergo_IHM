<div class="voyages form">
<?php echo $this->Form->create('Voyage'); ?>
	<fieldset>
		<legend><?php echo __('Edit Voyage'); ?></legend>
		<?php $user_id = $this->session->read('Auth.User.user_id'); ?>
		<div class='form_fieldset_voyages'>
			<?php echo $this->Form->input('voyage_name', array('label'=>'Nom du voyage')); ?>
		</div>

		<div class='form_fieldset_voyages'>
			<?php echo $this->Form->input('lieu', array('label'=>'Lieu')); ?>
		</div>

		<div class='float form_fieldset_voyages'>
			<?php echo $this->Form->input('date_debut', array('label'=>'Du')); ?>
		</div>
		<div class='float form_fieldset_voyages'>
			<?php echo $this->Form->input('date_fin', array('label'=>'Au')); ?>
		</div>

		<?php echo $this->Form->input('voyage_id'); ?>
	</fieldset>
<?php echo $this->Form->end(__('Modifier mon voyage')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li>
			<?php 
				echo $this->Form->postLink(__('Retour au voyage'), array('action' => 'view', basename($this->request->here)));
				// basename nous permet de récupérer le voyage_id
			?>
		</li>
	</ul>
</div>
