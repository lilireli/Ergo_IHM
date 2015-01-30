<?php 
	$hebergements = $this->requestAction(
		array('controller'=>'Hebergements', 'action'=>'view', $etape_id));

	$user_id = $this->session->read('Auth.User.user_id');
?>

<div class="hebergements">
	<h3><?php echo __('Liste des hebergements'); ?></h3>
	<table cellpadding="0" cellspacing="0">
		<thead>
			<tr>
					<th><?php echo __("nom de l'hébergement"); ?></th>
					<th><?php echo __("type"); ?></th>
					<th><?php echo __("date de début"); ?></th>
					<th><?php echo __("date de fin"); ?></th>
					<th><?php echo __("proposé par"); ?></th>
					<th><?php echo __("lieu"); ?></th>
					<th><?php echo __("note"); ?></th>
					<th><?php echo __("prix"); ?></th>
					<th><?php echo __("validé"); ?></th>
					<th><?php echo __("nombre de votes"); ?></th>
					<th><?php echo __("voter pour"); ?></th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($hebergements as $hebergement): ?>
			<tr>
				<td><?php echo h($hebergement['Hebergement']['hebergement_name']); ?>&nbsp;</td>
				<td><?php echo h($hebergement['Hebergement']['type']); ?>&nbsp;</td>
				<td><?php echo h($hebergement['Hebergement']['date_debut']); ?>&nbsp;</td>
				<td><?php echo h($hebergement['Hebergement']['date_fin']); ?>&nbsp;</td>
				<td><?php echo h($hebergement['Hebergement']['createur_id']); ?>&nbsp;</td>
				<td><?php echo h($hebergement['Hebergement']['lieu']); ?>&nbsp;</td>
				<td><?php echo h($hebergement['Hebergement']['note']); ?>&nbsp;</td>
				<td><?php echo h($hebergement['Hebergement']['prix']); ?>&nbsp;</td>
				<td><?php echo h($hebergement['Hebergement']['accepte']); ?>&nbsp;</td>
				<td><?php echo h($hebergement[0]['count_hebergement']); ?>&nbsp;</td>
				<td class="actions">
					<?php echo $this->Form->create('Vote', array('action' => 'add')); ?>
    				<fieldset>
	        			<?php 
				        	echo $this->Form->input('type_name',
				        		array('type' => 'hidden', 'default' => 'hebergement'));
				        	echo $this->Form->input('type_id',
				        		array('type' => 'hidden', 'default' => $hebergement['Hebergement']['hebergement_id']));
				        	echo $this->Form->input('user_id',
				        		array('type' => 'hidden', 'default' => $user_id));
				        	echo $this->Form->input('etape_id',
				        		array('type' => 'hidden', 'default' => $etape_id));
				    	?>
				    </fieldset>
					<?php echo $this->Form->end(__('Voter pour')); ?>
				</td>
			</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</div>

<div class="hebergements form">
<?php echo $this->Form->create('Hebergement', array('action' => 'add')); ?>
    <fieldset>
        <legend>
            <?php echo __('Ajouter un logement'); ?>
        </legend>
        <?php 
        	

        	echo $this->Form->input('hebergement_name');
        	echo $this->Form->input('etape_id',
        		array('type' => 'hidden', 'default' => $etape_id));
        	echo $this->Form->input('date_debut');
        	echo $this->Form->input('date_fin');
        	echo $this->Form->input('type');
        	echo $this->Form->input('lieu');
        	echo $this->Form->input('note');
        	echo $this->Form->input('prix');
        	echo $this->Form->input('createur_id',
        		array('type' => 'hidden', 'default' => $user_id));
    	?>
    </fieldset>
<?php echo $this->Form->end(__('Ajouter')); ?>
</div>