<h1><?php echo __('Voyages'); ?></h1>

<div class="voyages index">
	<h2><?php echo __('La liste de mes voyages'); ?></h2>
	<table cellpadding="0" cellspacing="0">
		<thead>
			<tr>
					<th><?php echo __('voyage_id'); ?></th>
					<th><?php echo __('voyage_name'); ?></th>
					<th><?php echo __('date_debut'); ?></th>
					<th><?php echo __('date_fin'); ?></th>
					<th><?php echo __('lieu'); ?></th>
					<th class="actions"><?php echo __('Actions'); ?></th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($voyages as $voyage): ?>
			<tr>
				<td><?php echo h($voyage['Voyage']['voyage_id']); ?>&nbsp;</td>
				<td><?php echo h($voyage['Voyage']['voyage_name']); ?>&nbsp;</td>
				<td><?php echo h($voyage['Voyage']['date_debut']); ?>&nbsp;</td>
				<td><?php echo h($voyage['Voyage']['date_fin']); ?>&nbsp;</td>
				<td><?php echo h($voyage['Voyage']['lieu']); ?>&nbsp;</td>
				<td class="actions">
					<?php echo $this->Html->link(__('Voir'), array('action' => 'view', $voyage['Voyage']['voyage_id'])); ?>
					<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $voyage['Voyage']['voyage_id']), array(), __('Are you sure you want to delete # %s?', $voyage['Voyage']['voyage_id'])); ?>
				</td>
			</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</div>


<div class="voyages form">
<?php echo $this->Form->create('Voyage', array('action' => 'add')); ?>
	<fieldset>
		<legend><?php echo __('Ajouter un voyage'); ?></legend>
	<?php
		$user_id = $this->session->read('Auth.User.user_id');

		echo $this->Form->input('voyage_name');
		echo $this->Form->input('date_debut');
		echo $this->Form->input('date_fin');
		echo $this->Form->input('lieu');

		echo $this->Form->input('createur_id', 
			array('type' => 'hidden', 'default' => $user_id));
		echo $this->Form->input('User',
			array('type' => 'hidden', 'default' => $user_id));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>


