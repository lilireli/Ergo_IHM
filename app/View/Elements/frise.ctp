<div class="frise frise_background">
	<div class="frise_move_right" id="move_right">
		<?php echo __('>'); ?>
	</div>
	<div class="frise_move_left" id="move_left">
		<?php echo __('<'); ?>
	</div>
		
	<div class="frise frise_general" id="frise_voyage">
		<?php 
			$etapes = $this->requestAction(
				array('controller'=>'etapes', 'action'=>'view', $voyage_id));

			if ($etapes != null) {

			$voyage_id = $etapes[0]['Voyage']['voyage_id']; 
			$seconds = strtotime($etapes[0]['Voyage']['date_fin']) - strtotime($etapes[0]['Voyage']['date_debut']);
			$days = floor($seconds/(3600*24));

			$date_debut = $etapes[0]['Voyage']['date_debut'];

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


		<?php echo $this->Html->script('frise', array('inline'=>true)); ?>

		<div class="frise list_etapes phantom_etape" style="left:20px; width:<?php echo __($width_etape); ?>px;">
			<?php echo __("Départ"); ?>
		</div>

		<div class="frise list_etapes phantom_etape" style="left:<?php echo __($left_end); ?>px; width:50px;">
			<?php echo __("Retour"); ?>
		</div>

		<?php 
			$transport_debut = strtotime($date_debut) + 3600*24; 
			$old_etape = 0;
			$etape_name_old = 'Maison';
		?>
			
		<?php foreach ($etapes as $etape): ?>
			<!-- PLACEMENT -->
			<?php 
				$etape_id = $etape['Etape']['etape_id'];

				$seconds = strtotime($etape['Etape']['date_debut']) - strtotime($date_debut);
				$left = floor($seconds/(3600*24))*$width_day + $width_transport/2;

				$seconds = strtotime($etape['Etape']['date_fin']) - strtotime($etape['Etape']['date_debut']);
				$width = floor($seconds/(3600*24))*$width_day - $width_transport;

				// récupérer tous les temps pour placer correctement les div
				$seconds = $transport_debut - strtotime($date_debut);
				$left_t = (floor($seconds/(3600*24)))*$width_day - $width_transport/2;

				$seconds = strtotime($etape['Etape']['date_debut']) - $transport_debut; 
				$width_t = floor($seconds/(3600*24))*$width_day + $width_transport;
			?>

			<!-- TRANSPORT -->
			<div class="frise list_transport" 
				style="left:<?php echo __($left_t); ?>px; width:<?php echo __($width_t); ?>px;">
				<?php echo __("Transport"); ?>

				<?php 
					echo $this->Html->link(__('Voir'), 
						array(
							'controller' => 'transports', 
							'action' => 'view', 
							$old_etape,
							$etape['Etape']['etape_id'].
							'?voyage_id='.$voyage_id.
							'&etape_name='.$etape_name_old.' à '.ucfirst(strtolower($etape['Etape']['etape_name']))
						)); 
				?>
			</div>

			<!-- ETAPES -->
			<div class="frise list_etapes" 
				style="left:<?php echo __($left); ?>px; width:<?php echo __($width); ?>px;"
				id="etape<?php echo __($etape['Etape']['etape_id']); ?>">
				<?php echo h(ucfirst(strtolower($etape['Etape']['etape_name']))); ?> 
				<?php echo $this->Html->link(__('Voir'), 
					array(
						'controller' => 'etapes', 
						'action' => 'index', 
						$etape['Etape']['etape_id'].'?voyage_id='.$voyage_id.'&etape_name='.$etape['Etape']['etape_name']
					)); 
				?>
			</div>
			
			<?php 
				$transport_debut = strtotime($etape['Etape']['date_fin']); 
				$old_etape = $etape['Etape']['etape_id'];
				$etape_name_old = ucfirst(strtolower($etape['Etape']['etape_name'])); 
			?>
		<?php endforeach; ?>

		<!-- PLACEMENT -->
		<?php 
			// récupérer tous les temps pour placer correctement les div
			$seconds = $transport_debut - strtotime($date_debut);
			$left_t = (floor($seconds/(3600*24)))*$width_day - $width_transport/2;
 
			$width_t = $left_end - $left_t;
		?>

		<!-- TRANSPORT -->
		<div class="frise list_transport" 
			style="left:<?php echo __($left_t); ?>px; width:<?php echo __($width_t); ?>px;">
			<?php echo __("Transport"); ?>

			<?php 
				echo $this->Html->link(__('Voir'), 
					array(
						'controller' => 'transports', 
						'action' => 'view', 
						$old_etape,
						0,
						'?voyage_id='.$voyage_id.
						'&etape_name='.$etape_name_old.' à Maison'
					)); 
			?>
		</div>
		<?php } ?>
	</div>
</div>


<script>
	$('#etape<?php echo __($etape_selected); ?>').addClass("etape_selected");
</script>