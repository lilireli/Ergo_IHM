<div class="view float">
	<h2><?php echo __('Mon Voyage en quelques mots'); ?></h2>
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
	<div class="actions">
	<ul>
		<li><?php echo $this->Html->link(__('Edit Voyage'), array('action' => 'edit', $voyage['Voyage']['voyage_id'])); ?> </li>
	</ul>
</div>
</div>

<div class="participants float">
	<?php $voyage_id = $voyage['Voyage']['voyage_id']; ?>

	<?php echo $this->element('participant',  array('voyage_id' => $voyage_id)); ?>
</div>

<div class="etapes">
	<?php echo $this->element('etape', array('voyage_id' => $voyage_id)); ?>
</div>

<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Retour'), array('action' => 'index')); ?> </li>
	</ul>
</div>
