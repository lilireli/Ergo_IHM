<?php
/**
 * GroupTrotteur: Heureux qui comme Ulysse a fait un beau voyage
 *
 * Ajouter un voyage
 *
 * @author        A. Chardon, A. El Bachiri, J. Pieyre, A. Suzanne
 */
?>

<div class="voyages">
	<h3><?php echo __("Créer un nouveau voyage"); ?></h3>

    <?php echo $this->Form->create('Voyage', array('action' => 'add')); ?>
	<fieldset>
		<?php 
			$user_id = $this->session->read('Auth.User.user_id'); 

			echo $this->Form->input('voyage_name', array('label'=>'Nom du voyage'));
			echo $this->Form->input('lieu', array('label'=>'Lieu'));
		?>

		<div>
			<div class='float'>
				<h5>Du</h5>
				<?php echo $this->datePicker->flat('Voyage][date_debut');?>
			</div>
			<div class='float'>
				<h5>Au</h5>
				<?php echo $this->datePicker->flat('Voyage][date_fin');?>
			</div>
			<p><i><?php echo __('(Les dates doivent être supérieures à aujourd\'hui, avec la date de fin postérieure à la date de début.)'); ?></p></i>
		</div>

		<?php
			echo $this->Form->input('createur_id', 
				array('type' => 'hidden', 'default' => $user_id));
			echo $this->Form->input('User',
				array('type' => 'hidden', 'default' => $user_id));
		?>
	</fieldset>
	<?php echo $this->Form->end(__('Créer')); ?>
</div>

<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Revenir à mes voyages'), array('action' => 'index')); ?></li>
	</ul>
</div>
