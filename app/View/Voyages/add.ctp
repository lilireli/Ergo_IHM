<div class="voyages">
	<h3><?php echo __("Créer un nouveau voyage"); ?></h3>

    <?php echo $this->Form->create('Voyage', array('action' => 'add')); ?>
	<fieldset>
		<?php 
			$user_id = $this->session->read('Auth.User.user_id'); 

			echo $this->Form->input('voyage_name', array('label'=>'Nom du voyage'));
			echo $this->Form->input('lieu', array('label'=>'Lieu'));
		?>

		<div class='float'>
			<?php 
				echo $this->Form->input('date_debut', array(
					'label'=>'Du',
					'dateFormat' => 'DMY',
    				'minYear' => date('Y'),
    				'maxYear' => date('Y') + 10,
				)); 
			?>
		</div>
		<div class='float'>
			<?php 
				echo $this->Form->input('date_fin', array(
					'label'=>'Au',
					'dateFormat' => 'DMY',
    				'minYear' => date('Y'),
    				'maxYear' => date('Y') + 10,
				)); 
			?>
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
