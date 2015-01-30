<?php 
	$activites = $this->requestAction(
		array('controller'=>'Activites', 'action'=>'view', $etape_id));
	$user_id = $this->session->read('Auth.User.user_id');
?>

<div class="activites">
	<h3><?php echo __('Liste des activités'); ?></h3>
	<table cellpadding="0" cellspacing="0">
		<thead>
			<tr>
					<th><?php echo __("nom de l'activite"); ?></th>
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
			<?php foreach ($activites as $activite): ?>
			<tr>
				<td><?php echo h($activite['Activite']['activite_name']); ?>&nbsp;</td>
				<td><?php echo h($activite['Activite']['type']); ?>&nbsp;</td>
				<td><?php echo h($activite['Activite']['date_debut']); ?>&nbsp;</td>
				<td><?php echo h($activite['Activite']['date_fin']); ?>&nbsp;</td>
				<td><?php echo h($activite['Activite']['createur_id']); ?>&nbsp;</td>
				<td><?php echo h($activite['Activite']['lieu']); ?>&nbsp;</td>
				<td><?php echo h($activite['Activite']['note']); ?>&nbsp;</td>
				<td><?php echo h($activite['Activite']['prix']); ?>&nbsp;</td>
				<td><?php echo h($activite['Activite']['accepte']); ?>&nbsp;</td>
				<td><?php echo h($activite[0]['count_activite']); ?>&nbsp;</td>
				<td class="actions">
					<?php echo $this->Form->create('Vote', array('action' => 'add')); ?>
    				<fieldset>
	        			<?php 
				        	echo $this->Form->input('type_name',
				        		array('type' => 'hidden', 'default' => 'activite'));
				        	echo $this->Form->input('type_id',
				        		array('type' => 'hidden', 'default' => $activite['Activite']['activite_id']));
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

<div class="activites form">
<?php echo $this->Form->create('Activite', array('action' => 'add')); ?>
    <fieldset>
        <legend>
            <?php echo __('Ajouter une activité'); ?>
        </legend>
        <?php 
        	$user_id = $this->session->read('Auth.User.user_id');

        	echo $this->Form->input('activite_name');
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