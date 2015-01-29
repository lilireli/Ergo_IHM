<?php 
	$transports = $this->requestAction(
		array('controller'=>'Transports', 'action'=>'view', $etape_id));
?>

<div class="transports">
	<h3><?php echo __('Liste des transports'); ?></h3>
	<table cellpadding="0" cellspacing="0">
		<thead>
			<tr>
					<th><?php echo __("nom du transport"); ?></th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($transports as $transport): ?>
			<tr>
				<td><?php echo h($transport['Transport']['transport_name']); ?>&nbsp;</td>
			</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</div>

<div class="transports form">
<?php echo $this->Form->create('Transport', array('action' => 'add')); ?>
    <fieldset>
        <legend>
            <?php echo __('Vueilsqj'); ?>
        </legend>
        <?php 
        	$user_id = $this->session->read('Auth.User.user_id');

        	echo $this->Form->input('transport_name');
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