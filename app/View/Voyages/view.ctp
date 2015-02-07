<?php $this->element('date_to_string'); // afficher dates français ?>

<?php 
	$voyage_id = $voyage['Voyage']['voyage_id']; 
	$seconds = strtotime($voyage['Voyage']['date_fin']) - strtotime($voyage['Voyage']['date_debut']);
	$days = floor($seconds/(3600*24));
?>

<div class="general_voyage">
	<div class="general_voyage view_voyages float">
		<h1><?php echo h(ucfirst(strtolower($voyage['Voyage']['voyage_name']))); ?></h1>

		<dl>
			<dt><?php echo __('Du '); ?></dt>
			<dd><?php echo h(aff_date($voyage['Voyage']['date_debut'])); ?></dd>
			<dt><?php echo __(' Au '); ?></dt>
			<dd><?php echo h(aff_date($voyage['Voyage']['date_fin'])); ?></dd>
			<dt><?php echo __('Destination'); ?></dt>
			<dd><?php echo h(ucfirst(strtolower($voyage['Voyage']['lieu']))); ?></dd>
		</dl>

		<div class="actions">
			<h3><?php echo __('Actions'); ?></h3>
			<ul>
				<li><?php echo $this->Html->link(__('Modifier'), array('action' => 'edit', $voyage['Voyage']['voyage_id'])); ?> </li>
				<li><?php 
					echo $this->Html->link(__('Ajouter une étape'), 
						array(
							'controller' => 'etapes',
							'action' => 'add', 
							$voyage['Voyage']['voyage_id'].'?voyage_id='.$voyage_id
						)); 
				?></li>
				<li><?php echo $this->Html->link(__('Retour à mes voyages'), array('action' => 'index')); ?> </li>
			</ul>
		</div>
	</div>

	<div class="general_voyage view_voyages right">
		<?php echo $this->element('participant',  array('voyage_id' => $voyage_id)); ?>
	</div>
</div>


<?php 
	echo $this->element('frise', array('voyage_id' => $voyage_id)); 
?>



