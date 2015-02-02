<h1><?php echo __('Mes Voyages'); ?></h1>


<?php foreach ($voyages as $voyage): ?>
<div class="voyages">
	<h4 class="voyages"><?php echo h($voyage['Voyage']['voyage_name']); ?></h4>

	<div class="float">
		<p>
			<?php echo __("Destination "); ?>
			<?php echo h($voyage['Voyage']['lieu']); ?>
		</p>
		
		<p>
			<?php echo __("Du "); ?>
			<?php echo h($voyage['Voyage']['date_debut']); ?>
			<?php echo __(" au "); ?>
			<?php echo h($voyage['Voyage']['date_fin']); ?>
		</p>
	</div>

	<div class="float right">
		<?php echo $this->Html->link(__('Voir'), array('action' => 'view', $voyage['Voyage']['voyage_id'])); ?>
		<?php echo $this->Form->postLink(__('Supprimer'), array('action' => 'delete', $voyage['Voyage']['voyage_id']), array(), __('Etes vous sûr de vouloir supprimer le voyage %s ?', $voyage['Voyage']['voyage_name'])); ?>
	</div>
</div>
<?php endforeach; ?>

<div class="voyages form form_voyages">
<?php echo $this->Form->create('Voyage', array('action' => 'add')); ?>
	<h3><?php echo h('Ajouter un voyage'); ?></h3>
	<fieldset>
	<?php
		$user_id = $this->session->read('Auth.User.user_id');

		echo $this->Form->input('voyage_name');
		echo $this->Form->input('date_debut');
		echo $this->Form->input('date_fin');
		echo $this->Form->input('lieu');

		echo $this->Form->input('createur_id', 
			array('type' => 'hidden', 'default' => $user_id));
		echo $this->Form->input('User',
			array('type' => 'hidden', 'default' => $user_id));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>


