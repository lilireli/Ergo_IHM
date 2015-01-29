<?php 
	$hebergements = $this->requestAction(
		array('controller'=>'Hebergements', 'action'=>'view', $etape_id));
?>

<div class="hebergements">
	<h3><?php echo __('Liste des hebergements'); ?></h3>
	<table cellpadding="0" cellspacing="0">
		<thead>
			<tr>
					<th><?php echo __("nom du hebergement"); ?></th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($hebergements as $hebergement): ?>
			<tr>
				<td><?php echo h($hebergement['Hebergement']['hebergement_name']); ?>&nbsp;</td>
			</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</div>

<div class="hebergements form">
<?php echo $this->Form->create('Hebergement', array('action' => 'add')); ?>
    <fieldset>
        <legend>
            <?php echo __('Vueilsqj'); ?>
        </legend>
        <?php 
        	$user_id = $this->session->read('Auth.User.user_id');

        	echo $this->Form->input('hebergement_name');
        	echo $this->Form->input('etape_id',
        		array('type' => 'hidden', 'default' => $etape_id));
        	echo $this->Form->input('date_debut');
        	echo $this->Form->input('date_fin');
        	echo $this->Form->input('createur_id',
        		array('type' => 'hidden', 'default' => $user_id));
    	?>
    </fieldset>
<?php echo $this->Form->end(__('Ajouter')); ?>
</div>