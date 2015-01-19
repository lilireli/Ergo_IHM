<div class="voyages view">
<h2><?php echo __('Voyage'); ?></h2>
	<dl>
		<dt><?php echo __('Voyage Id'); ?></dt>
		<dd>
			<?php echo h($voyage['Voyage']['voyage_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Voyage Name'); ?></dt>
		<dd>
			<?php echo h($voyage['Voyage']['voyage_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Date Debut'); ?></dt>
		<dd>
			<?php echo h($voyage['Voyage']['date_debut']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Date Fin'); ?></dt>
		<dd>
			<?php echo h($voyage['Voyage']['date_fin']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Lieu'); ?></dt>
		<dd>
			<?php echo h($voyage['Voyage']['lieu']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Voyage'), array('action' => 'edit', $voyage['Voyage']['voyage_id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Voyage'), array('action' => 'delete', $voyage['Voyage']['voyage_id']), array(), __('Are you sure you want to delete # %s?', $voyage['Voyage']['voyage_id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Voyages'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Voyage'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users Voyages'), array('controller' => 'users_voyages', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Users Voyages'), array('controller' => 'users_voyages', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Users Voyages'); ?></h3>
	<?php if (!empty($voyage['users_voyages'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Assoc Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Voyage Id'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($voyage['users_voyages'] as $usersVoyages): ?>
		<tr>
			<td><?php echo $usersVoyages['assoc_id']; ?></td>
			<td><?php echo $usersVoyages['user_id']; ?></td>
			<td><?php echo $usersVoyages['voyage_id']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'users_voyages', 'action' => 'view', $usersVoyages['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'users_voyages', 'action' => 'edit', $usersVoyages['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'users_voyages', 'action' => 'delete', $usersVoyages['id']), array(), __('Are you sure you want to delete # %s?', $usersVoyages['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Users Voyages'), array('controller' => 'users_voyages', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
