<div class="form">
	<h3><?php echo __("Ajouter une étape"); ?></h3>

	<?php echo $this->Form->create('Hebergement', array('action' => 'add')); ?>
    <fieldset>
        <?php 
        	$user_id = $this->session->read('Auth.User.user_id');

        	$options = array(
			    'hôtel'=>'hôtel', 
			    'auberge de jeunesse'=>'auberge de jeunesse', 
			    'location'=>'location', 
			    'camping'=>'camping', 
			    'autre'=>'autre'
			);

			$attributes = array(
			    'legend' => false,
			    'value' => 'hôtel'
			);

			echo $this->Form->radio('type', $options, $attributes, array('label'=>'Type'));

        	echo $this->Form->input('hebergement_name', array('label'=>'Nom'));
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
        	echo $this->Form->input('lieu', array('label'=>'Adresse'));
        	echo $this->Form->input('prix', array('label'=>'Prix'));

        	echo $this->Form->input('etape_id',
        		array('type' => 'hidden', 'default' => $etape_id));
        	echo $this->Form->input('createur_id',
        		array('type' => 'hidden', 'default' => $user_id));
    	?>
    </fieldset>
<?php echo $this->Form->end(__('Ajouter')); ?>
</div>