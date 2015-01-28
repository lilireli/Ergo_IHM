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

<?php echo $this->element('participant',  array('id' => $voyage['Voyage']['voyage_id'])); ?>

<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Voyage'), array('action' => 'edit', $voyage['Voyage']['voyage_id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Voyage'), array('action' => 'delete', $voyage['Voyage']['voyage_id']), array(), __('Are you sure you want to delete # %s?', $voyage['Voyage']['voyage_id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Voyages'), array('action' => 'index')); ?> </li>
	</ul>
</div>
