<div class="etapes form">
    <h3><?php echo __("Ajouter une étape"); ?></h3>

    <?php echo $this->Form->create('Etape', array('action' => 'add')); ?>
    <fieldset>
        <?php 
        	$user_id = $this->session->read('Auth.User.user_id');

        	echo $this->Form->input('etape_name');
        	echo $this->Form->input('voyage_id',
        		array('type' => 'hidden', 'default' => $voyage_id));
        	echo $this->Form->input('date_debut');
        	echo $this->Form->input('date_fin');
        	echo $this->Form->input('createur_id',
        		array('type' => 'hidden', 'default' => $user_id));
    	?>
    </fieldset>
<?php echo $this->Form->end(__('Ajouter')); ?>
</div>