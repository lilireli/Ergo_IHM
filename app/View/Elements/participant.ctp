<?php 
	$participants = $this->requestAction(
		array('controller'=>'Voyages', 'action'=>'participants', $id)); 
	$users = $this->requestAction(
		array('controller'=>'Users', 'action'=>'get_users'));
?>

<div class="participants">
	<h3><?php echo __('Liste des participants'); ?></h3>
	<table cellpadding="0" cellspacing="0">
		<thead>
			<tr>
					<th><?php echo __('nom du participant'); ?></th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($participants as $participant): ?>
			<tr>
				<td><?php echo h($participant['User']['user_id']); ?>&nbsp;</td>
			</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</div>

<div class="add participant">
	<h3><?php echo __('Ajouter des participants'); ?></h3>
	<?php echo $this->Form->create('Voyage', array('action' => 'add_participants')); ?>
    <fieldset>
        <legend>
            <?php echo __('Please choose the participants you want to add'); ?>
        </legend>
        <?php 
        	
        	echo $this->Form->input('voyage_id', 
        		array('type'=>'hidden', 'default'=>$id));

        	foreach ($users as $user):

        		$name = $user['User']['user_name'];
        		$user_id = $user['User']['user_id'];
        		echo $this->Form->input('User.'.$name, array(
					'type'=>'checkbox', 'value'=>$user_id, 'label'=>$name));
        	endforeach;
    	?>
    </fieldset>
<?php echo $this->Form->end(__('Valider')); ?>
</div>

