<?php 
	$etapes = $this->requestAction(
		array('controller'=>'Etapes', 'action'=>'view', $voyage_id));
?>

<h2><?php echo __('Liste des étapes'); ?></h2>

<div class="view etapes">	
	<table cellpadding="0" cellspacing="0">
		<thead>
			<tr>
					<th><?php echo __("nom de l'étape"); ?></th>
					<th><?php echo __('Actions'); ?></th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($etapes as $etape): ?>
			<tr>
				<td><?php echo h($etape['Etape']['etape_name']); ?>&nbsp;</td>
				<td class="actions">
					<?php echo $this->Html->link(__('Edit'), array('controller' => 'etapes', 'action' => 'index', $etape['Etape']['etape_id']));?>
				</td>
			</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</div>

<div class="etapes form">
<?php echo $this->Form->create('Etape', array('action' => 'add')); ?>
    <fieldset>
        <legend>
            <?php echo __('Vueilsqj'); ?>
        </legend>
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