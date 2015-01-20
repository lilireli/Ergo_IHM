<h1>Voyages</h1>

<div class="voyages form">
<?php echo $this->Form->create('Voyage', array('action' => 'add')); ?>
	<fieldset>
		<legend><?php echo __('Add Voyage'); ?></legend>
	<?php
		echo $this->Form->input('voyage_name');
		echo $this->Form->input('date_debut');
		echo $this->Form->input('date_fin');
		echo $this->Form->input('lieu');

		echo __('<div class=hidden>');
		echo $this->Form->input('createur_id', array(
                'type' => 'text',
                'label' => 'createur_id',
                'default' => $this->session->read('Auth.User.user_id')
            ));
		echo __('</div>')
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Voyages'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Users Voyages'), array('controller' => 'users_voyages', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Users Voyages'), array('controller' => 'users_voyages', 'action' => 'add')); ?> </li>
	</ul>
</div>
