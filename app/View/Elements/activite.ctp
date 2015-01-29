<?php 
	$activites = $this->requestAction(
		array('controller'=>'Activites', 'action'=>'view', $etape_id));
?>

<div class="activites">
	<h3><?php echo __('Liste des activites'); ?></h3>
	<table cellpadding="0" cellspacing="0">
		<thead>
			<tr>
					<th><?php echo __("nom du activite"); ?></th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($activites as $activite): ?>
			<tr>
				<td><?php echo h($activite['Activite']['activite_name']); ?>&nbsp;</td>
			</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</div>

<div class="activites form">
<?php echo $this->Form->create('Activite', array('action' => 'add')); ?>
    <fieldset>
        <legend>
            <?php echo __('Vueilsqj'); ?>
        </legend>
        <?php 
        	$user_id = $this->session->read('Auth.User.user_id');

        	echo $this->Form->input('activite_name');
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