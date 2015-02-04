<div class="view_voyages float">
	<h2><?php echo h($voyage['Voyage']['voyage_name']); ?></h2>

	<p>
		<?php echo __('Du '); ?>
		<?php echo h($voyage['Voyage']['date_debut']); ?>
		<?php echo __(' au '); ?>
		<?php echo h($voyage['Voyage']['date_fin']); ?>
	</p>

	<p>
		<?php echo __('A '); ?>
		<?php echo h($voyage['Voyage']['lieu']); ?>
	</p>

	<div class="actions">
		<h3><?php echo __('Actions'); ?></h3>
		<ul>
			<li><?php echo $this->Html->link(__('Modifier'), array('action' => 'edit', $voyage['Voyage']['voyage_id'])); ?> </li>
			<li><?php echo $this->Html->link(__('Retour à mes voyages'), array('action' => 'index')); ?> </li>
		</ul>
	</div>
</div>

<div class="view_voyages float right">
	<?php $voyage_id = $voyage['Voyage']['voyage_id']; ?>

	<?php echo $this->element('participant',  array('voyage_id' => $voyage_id)); ?>
</div>

<div class="view_etapes" id="frise_voyage">
	<?php 
		$seconds = strtotime($voyage['Voyage']['date_fin']) - strtotime($voyage['Voyage']['date_debut']);
		$days = floor($seconds/(3600*24));

		echo $this->element('etape', array(
			'voyage_id' => $voyage_id,
			'days' => $days,
			'date_debut' => $voyage['Voyage']['date_debut']
		)); 
	?>
</div>


