<?php 
	$transports = $this->requestAction(
		array('controller'=>'Transports', 'action'=>'view', $etape_id));
	
	$user_id = $this->session->read('Auth.User.user_id');
?>

<div class="transports">
	<h3><?php echo __('Liste des transports'); ?></h3>
	<table cellpadding="0" cellspacing="0">
		<thead>
			<tr>
					<th><?php echo __("nom du transport"); ?></th>
					<th><?php echo __("type"); ?></th>
					<th><?php echo __("date de début"); ?></th>
					<th><?php echo __("date de fin"); ?></th>
					<th><?php echo __("proposé par"); ?></th>
					<th><?php echo __("de"); ?></th>
					<th><?php echo __("à"); ?></th>
					<th><?php echo __("prix"); ?></th>
					<th><?php echo __("validé"); ?></th>
					<th><?php echo __("nombre de votes"); ?></th>
					<th><?php echo __("voter pour"); ?></th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($transports as $transport): ?>
			<tr>
				<td><?php echo h($transport['Transport']['transport_name']); ?>&nbsp;</td>
				<td><?php echo h($transport['Transport']['type']); ?>&nbsp;</td>
				<td><?php echo h($transport['Transport']['date_debut']); ?>&nbsp;</td>
				<td><?php echo h($transport['Transport']['date_fin']); ?>&nbsp;</td>
				<td><?php echo h($transport['Transport']['createur_id']); ?>&nbsp;</td>
				<td><?php echo h($transport['Transport']['lieu_depart']); ?>&nbsp;</td>
				<td><?php echo h($transport['Transport']['lieu_arrivee']); ?>&nbsp;</td>
				<td><?php echo h($transport['Transport']['prix']); ?>&nbsp;</td>
				<td><?php echo h($transport['Transport']['accepte']); ?>&nbsp;</td>
				<td><?php echo h($transport[0]['count_transport']); ?>&nbsp;</td>
				<td class="actions">
					<?php echo $this->Form->create('Vote', array('action' => 'add')); ?>
    				<fieldset>
	        			<?php 
				        	echo $this->Form->input('type_name',
				        		array('type' => 'hidden', 'default' => 'transport'));
				        	echo $this->Form->input('type_id',
				        		array('type' => 'hidden', 'default' => $transport['Transport']['transport_id']));
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

<div class="transports form">
<?php echo $this->Form->create('Transport', array('action' => 'add')); ?>
    <fieldset>
        <legend>
            <?php echo __('Ajouter un transport'); ?>
        </legend>
        <?php 
        	echo $this->Form->input('transport_name');
        	echo $this->Form->input('etape_id',
        		array('type' => 'hidden', 'default' => $etape_id));
        	echo $this->Form->input('date_debut');
        	echo $this->Form->input('date_fin');
        	echo $this->Form->input('type');
        	echo $this->Form->input('lieu_depart');
        	echo $this->Form->input('lieu_arrivee');
        	echo $this->Form->input('prix');
        	echo $this->Form->input('createur_id',
        		array('type' => 'hidden', 'default' => $user_id));
    	?>
    </fieldset>
<?php echo $this->Form->end(__('Ajouter')); ?>
</div>