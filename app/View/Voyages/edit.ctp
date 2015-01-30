<div class="voyages form">
<?php echo $this->Form->create('Voyage'); ?>
	<fieldset>
		<legend><?php echo __('Edit Voyage'); ?></legend>
	<?php
		echo $this->Form->input('voyage_id');
		echo $this->Form->input('voyage_name');
		echo $this->Form->input('date_debut');
		echo $this->Form->input('date_fin');
		echo $this->Form->input('lieu');
		echo $this->Form->input('User');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Voyage.voyage_id')), array(), __('Are you sure you want to delete # %s?', $this->Form->value('Voyage.voyage_id'))); ?></li>
	</ul>
</div>
