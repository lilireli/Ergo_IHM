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

			$left_end = $days*$width_day + $width_transport/2 + $width_etape/2;
		?>

		<div class="hidden" id="nombre_days">
			<?php echo __($days); ?>
		</div>

		<div class="hidden" id="date_debut">
			<?php echo __(strtotime($date_debut)); ?>
		</div>


		<?php echo $this->Html->script('frise', array('inline'=>true)); ?>

		<div class="frise list_etapes phantom_etape" style="left:0px; height:<?php echo __($width_etape/2); ?>px;">
			<?php echo __("Départ"); ?>
		</div>

		<div class="frise list_etapes phantom_etape" style="left:<?php echo __($left_end); ?>px; height:<?php echo __($width_etape/2); ?>px;">
			<?php echo __("Retour"); ?>
		</div>

		<?php 
			$transport_debut = $width_etape/2; 
			$old_etape = 0;
			$etape_name_old = 'Maison';
			$idx = 0;
			$len_et = sizeof($etapes)
		?>
			
		<?php foreach ($etapes as $etape): ?>
			<!-- PLACEMENT -->
			<?php 
				$etape_id = $etape['Etape']['etape_id'];
				$beginning = strtotime($etape['Etape']['date_debut']) - strtotime($date_debut);
				$length = strtotime($etape['Etape']['date_fin']) - strtotime($etape['Etape']['date_debut']);
				$left = floor($beginning/(3600*24))*$width_day + $width_transport/2; 
				$width = (floor($length/(3600*24))+1)*$width_day - $width_transport;
				$days_et = floor(($length + $beginning)/(3600*24));

				// récuperer le début (cad left)
				// on vérifie si les deux étapes sont le même jour (pas le même positionnement)
				if ($idx != 0) {
					if ($etape['Etape']['date_debut'] == $etapes[$idx-1]['Etape']['date_fin']){
						$left += $width_day/2;
						$width -= $width_day/2;
					}
				} else if ($etape['Etape']['date_debut'] == $date_debut) {
					$left += $width_day/2;
					$width -= $width_day/2;
				}

				// regarder l'étape suivante pour savoir si elle est sur le même jour
				if ($idx < $len_et - 1) {
					if ($etape['Etape']['date_fin'] == $etapes[$idx+1]['Etape']['date_debut']){
						$width -= $width_day/2;
					}
				} else if ($days_et == $days) {
					$width -= $width_day/2;
				}

				$left_t = $transport_debut -5;
				$width_t = $left - $transport_debut +5;

				$transport_debut += $width + $width_transport;

				$idx += 1;
			?>

			<!-- TRANSPORT -->
			<div class="frise list_transport" 
				style="left:<?php echo __($left_t); ?>px; width:<?php echo __($width_t); ?>px;"
				id="transport<?php echo __($old_etape); ?>">
				<div class='float button_keeper'>
					<div class="behind">
						<?php echo $this->element('pictograms', array('name' => 'autre')) ?>
					</div>

					<div class="front">
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
				</div>				
			</div>

			<!-- ETAPES -->
			<div class="frise list_etapes" 
				style="left:<?php echo __($left); ?>px; width:<?php echo __($width); ?>px;"
				id="etape<?php echo __($etape['Etape']['etape_id']); ?>">
				<?php echo h(ucfirst(strtolower($etape['Etape']['etape_name']))); ?> 

				<div class='float button_keeper'>
					<div class="behind">
						<?php echo $this->element('pictograms', array('name' => 'loupe')) ?>
					</div>

					<div class="front">
						<?php echo $this->Html->link(__('Voir'), 
								array(
									'controller' => 'etapes', 
									'action' => 'index', 
									$etape['Etape']['etape_id'].'?voyage_id='.$voyage_id.'&etape_name='.$etape['Etape']['etape_name']
								)); 
							?>
								</div>
							</div>
						</div>
						
						<?php  
							$old_etape = $etape['Etape']['etape_id'];
							$etape_name_old = ucfirst(strtolower($etape['Etape']['etape_name'])); 
						?>
		<?php endforeach; ?>

		<!-- PLACEMENT -->
		<?php 
			$left_t = $transport_debut - 5;
			$width_t = $left_end - $left_t + 8;
		?>

		<!-- TRANSPORT -->
		<div class="frise list_transport" 
			style="left:<?php echo __($left_t); ?>px; width:<?php echo __($width_t); ?>px;">
			<div class='float button_keeper'>
				<div class="behind">
					<?php echo $this->element('pictograms', array('name' => 'autre')) ?>
				</div>

				<div class="front">
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
			</div>					
		</div>
		<?php } ?>
	</div>
</div>