<?php 
	$etapes = $this->requestAction(
		array('controller'=>'etapes', 'action'=>'view', $voyage_id));

	$width_etape = 70;
	$width_transport = 40;
	$width_day = 110;

	$left_end = $days*$width_day + $width_transport/2;
?>

<div class="hidden" id="nombre_days">
	<?php echo __($days); ?>
</div>

<div class="hidden" id="date_debut">
	<?php echo __(strtotime($date_debut)); ?>
</div>


<?php echo $this->Html->script('frise',array('inline'=>false)); ?>

<div class="list_etapes phantom_etape" style="left:20px; width:<?php echo __($width_etape); ?>px;">
	<?php echo __("Départ"); ?>
</div>

<div class="list_etapes phantom_etape" style="left:<?php echo __($left_end); ?>px; width:50px;">
	<?php echo __("Arrivée"); ?>
</div>

<?php $transport_debut = $date_debut ?>
	
<?php foreach ($etapes as $etape): ?>
	<?php 
		$seconds = strtotime($etape['Etape']['date_debut']) - strtotime($date_debut);
		$left = floor($seconds/(3600*24))*$width_day + $width_transport/2;

		$seconds = strtotime($etape['Etape']['date_fin']) - strtotime($etape['Etape']['date_debut']);
		$width = floor($seconds/(3600*24))*$width_day - $width_transport;

		$seconds = strtotime($transport_debut) - strtotime($date_debut);
		$left_t = (floor($seconds/(3600*24)))*$width_day - $width_transport/2;

		$seconds = strtotime($etape['Etape']['date_debut']) - strtotime($transport_debut); 
		$width_t = floor($seconds/(3600*24))*$width_day + $width_transport;
	?>

	<div class="list_transport" style="left:<?php echo __($left_t); ?>px; width:<?php echo __($width_t); ?>px;">
		<?php echo __("Transport"); ?>
	</div>

	<div class="list_etapes" style="left:<?php echo __($left); ?>px; width:<?php echo __($width); ?>px;">
		<?php echo h($etape['Etape']['etape_name']); ?>
		<div class="actions">
			<?php echo $this->Html->link(__('Edit'), array('controller' => 'etapes', 'action' => 'index', $etape['Etape']['etape_id']));?>
		</div>
	</div>
	<?php $transport_debut = $etape['Etape']['date_fin']; ?>
<?php endforeach; ?>


<div class="hidden form_voyages" id="wrapper">
    <div id="small2">
        <?php echo $this->Html->image('add_button_orange.png', array('height'=>'20px'));?>
        <big><?php echo h('Créer une nouvelle étape'); ?></big>
    </div>
    <div id="normal2">
    	<div class='float'>
	    	<?php echo $this->Html->image('add_button_orange.png', array('height'=>'20px'));?>
	        <big><?php echo h('Créer une nouvelle étape'); ?></big>
	    </div>
        <div class='float right' id="reduire2">
        	<?php echo __('Réduire'); ?>
        </div>

		<?php echo $this->Form->create('Etape', array('action' => 'add')); ?>
	    <fieldset>
	        <?php $user_id = $this->session->read('Auth.User.user_id'); ?>

	        <?php echo $this->Form->input('etape_name', array('label'=>'Lieu')); ?>

	    	<div class='float form_fieldset_voyages'>
				<?php 
					echo $this->Form->input('date_debut', array(
						'label'=>'Du',
						'dateFormat' => 'DMY',
	    				'minYear' => date('Y'),
	    				'maxYear' => date('Y') + 10,
					)); 
				?>
			</div>
			<div class='float form_fieldset_voyages'>
				<?php 
					echo $this->Form->input('date_fin', array(
						'label'=>'Au',
						'dateFormat' => 'DMY',
	    				'minYear' => date('Y'),
	    				'maxYear' => date('Y') + 10,
					)); 
				?>
			</div>

			<?php
				echo $this->Form->input('voyage_id',
	        		array('type' => 'hidden', 'default' => $voyage_id));

	        	echo $this->Form->input('createur_id',
	        		array('type' => 'hidden', 'default' => $user_id));
	    	?>
	    </fieldset>
		<?php echo $this->Form->end(__('Créer')); ?>
	</div>  
</div>
