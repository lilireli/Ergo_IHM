<div class="voyages index">
	<h2><?php echo __('Voyages'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('voyage_id'); ?></th>
			<th><?php echo $this->Paginator->sort('voyage_name'); ?></th>
			<th><?php echo $this->Paginator->sort('date_debut'); ?></th>
			<th><?php echo $this->Paginator->sort('date_fin'); ?></th>
			<th><?php echo $this->Paginator->sort('lieu'); ?></th>
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
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $voyage['Voyage']['voyage_id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $voyage['Voyage']['voyage_id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $voyage['Voyage']['voyage_id']), array(), __('Are you sure you want to delete # %s?', $voyage['Voyage']['voyage_id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</tbody>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Voyage'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Users Voyages'), array('controller' => 'users_voyages', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Users Voyages'), array('controller' => 'users_voyages', 'action' => 'add')); ?> </li>
	</ul>
</div>
