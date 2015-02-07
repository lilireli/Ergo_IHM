<?php $this->element('date_to_string'); // afficher dates français ?>

<?php 
	$etape_debut = $transports['etape_debut']; 
	if ($etape_debut == null) { $etape_debut = 0; }
	$etape_fin = $transports['etape_fin'];
	if ($etape_fin == null) { $etape_fin = 0; }
	$transports = $transports['res'];

    $voyage_id = $_GET['voyage_id'];
    $etape_name = $_GET['etape_name'];

    $base_url = '?voyage_id='.$voyage_id.'&etape_name='.$etape_name;;

    $user_id = $this->session->read('Auth.User.user_id'); 

    $accepte = false;
	$i = 0;
?>

<div class="general_voyage">
	<div>
		<div>
        	<h2><?php echo __('Transport de '.$etape_name); ?><h2>
        </div>
        <div class="actions" id="top_left_etape">
			<ul>
				<li>
			<?php
			    echo $this->Html->link(__('Retourner au voyage'), 
			    	array(
			    		'controller' => 'voyages',
			    		'action' => 'view',
			    		$voyage_id
			    	)); 
			?>
				</li>
			</ul>
		</div>
    </div>

    <div id="menu">   
    	<ul class="onglets ">
    		<li class="active">
    			<?php 
    				echo __($this->Html->link(__('Transports'), 
			            array(
			                'controller' => 'transport', 
			                'action' => 'view', 
			                $etape_debut.'/'.$etape_fin.$base_url
			            ))); 
			    ?>
    		</li>
    	</ul>
    </div>

	<table cellpadding="0" cellspacing="0">
		<thead>
			<tr>
				<th><h2><?php echo __('Propositions de transports'); ?></h2></th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($transports as $transport): ?>
			<tr>
				<?php 
					// changer la couleur de la case si le transport est validé
					if ($transport['Transport']['accepte'] == 1) { 
						$accepte = true;
				?>
					<td class="accepte">
				<?php } else { ?>
					<td>
				<?php } ?>

				<div class="float border_right" style="width:60%">
				<!-- Afficher les données générales -->
					<div class="float top">
						<?php echo $this->element('pictograms', array('name' => $transport['Transport']['type'])); ?>
					</div>

					<div class="float">
						<?php echo __('Départ :  à '); ?>
						<?php echo h($transport['Transport']['lieu_depart']); ?>
						<?php echo __(' le '); ?>
						<?php echo h(aff_date($transport['Transport']['date_debut'])); ?>
						<?php echo __(' à '); ?>
						<?php echo h($transport['Transport']['heure_debut']); ?>

						<br>
						<?php echo __('Retour :  à '); ?>
						<?php echo h($transport['Transport']['lieu_arrivee']); ?>
						<?php echo __(' le '); ?>
						<?php echo h(aff_date($transport['Transport']['date_fin'])); ?>
						<?php echo __(' à '); ?>
						<?php echo h($transport['Transport']['heure_fin']); ?>

						<br>
						<?php echo __('Prix :'); ?>
						&nbsp;&nbsp;&nbsp;&nbsp;
						<?php 
							if($transport['Transport']['prix'] != 0){
								echo h($transport['Transport']['prix']); 
							} else { echo __('-'); }
							echo __('€');
						?>
						
					</div>

					<!-- Edition -->
					<div class='float button_keeper right'>
						<div class="behind">
							<?php echo $this->element('pictograms', array('name' => 'edition')) ?>
						</div>

						<div class="front">
							<?php echo $this->Html->link(__('Editer'), 
							array(
								'action' => 'edit', 
								$transport['Transport']['transport_id'].
									$base_url.'&etape_debut='.$etape_debut.'&etape_fin='.$etape_fin)); ?>
						</div>
					</div>
				</div>

					
				<div class="float border_right top" style="width:10%">
					<div class="float">
						<big>
							<br>
							<?php 
								$votes = $transport[0]['count_transport'];
								echo h($votes);
								if($votes<2) echo __(' Vote'); 
								else echo __(' Votes');
							?>
						</big>
					</div>

					<!-- Vote -->
					<?php if ($transport[0]['count_user'] < 1) { ?>
						<div class="float button_keeper">
							<div class="behind">
								<?php echo $this->element('pictograms', array('name' => 'unvote')) ?>
							</div>

							<div class="front">
								<?php echo $this->Form->create('Vote', array('action' => 'add')); ?>
			    				<fieldset>
				        			<?php 
							        	echo $this->Form->input('type_name',
							        		array('type' => 'hidden', 'default' => 'transport'));
							        	echo $this->Form->input('type_id',
							        		array('type' => 'hidden', 'default' => $transport['Transport']['transport_id']));
							        	echo $this->Form->input('user_id',
							        		array('type' => 'hidden', 'default' => $user_id));
							        	echo $this->Form->input('url',
								        		array('type'=>'hidden', 'default'=> $this->here));
							    	?>
							    </fieldset>
								<?php echo $this->Form->end(__('Voter pour')); ?>
							</div>
						</div>
					<?php } else { ?>
						<div class="float button_keeper">
							<div class="behind">
								<?php echo $this->element('pictograms', array('name' => 'vote')) ?>
							</div>

							<div class="front">
								<?php 
										$del_url = str_replace('/', '_1_', $this->here);
										$del_url = str_replace('?', '_2_', $del_url);
										$del_url = str_replace('=', '_3_', $del_url);
										$del_url = str_replace('&', '_4_', $del_url);

										echo $this->Form->postLink(__('Enlever vote'), 
											array(
												'controller' => 'votes',
												'action' => 'delete', 
												$user_id,
												'transport',
												$transport['Transport']['transport_id'],
												$del_url
											)); 
									?>
							</div>
						</div>
					<?php } ?>
				</div>
						

					

					<!-- Validation -->
					<div class="float button_keeper">
						<?php if(!$accepte) { ?>
							<div class="behind">
								<?php echo $this->element('pictograms', array('name' => 'check')) ?>
							</div>

							<div class="front">
								<?php echo $this->Form->create('Transport', array('action' => 'edit/'.$transport['Transport']['transport_id'])); ?>
			    				<fieldset>
				        			<?php 
							        	echo $this->Form->input('accepte',
							        		array('type' => 'hidden', 'default' => 1));
							        	echo $this->Form->input('transport_id',
							        		array('type' => 'hidden', 'default' => $transport['Transport']['transport_id']));
							        	echo $this->Form->input('url', 
							        		array('type' => 'hidden', 'default' => $etape_debut.'/'.$etape_fin.$base_url));
							    	?>
							    </fieldset>
								<?php echo $this->Form->end(__('Valider')); ?>
							</div>
						<?php } else if ($i==0) { ?>
							<div class="behind">
								<?php echo $this->element('pictograms', array('name' => 'uncheck')) ?>
							</div>

							<div class="front">
								<?php echo $this->Form->create('Transport', array('action' => 'edit/'.$transport['Transport']['transport_id'])); ?>
			    				<fieldset>
				        			<?php 
							        	echo $this->Form->input('accepte',
							        		array('type' => 'hidden', 'default' => 0));
							        	echo $this->Form->input('transport_id',
							        		array('type' => 'hidden', 'default' => $transport['Transport']['transport_id']));
							        	echo $this->Form->input('url', 
							        		array('type' => 'hidden', 'default' => $etape_debut.'/'.$etape_fin.$base_url));
							    	?>
							    </fieldset>
								<?php echo $this->Form->end(__('Dévalider')); ?>
							</div>
							<?php } ?>
						</div>

						<!-- suppression -->
						<div class='input_like float button_keeper right'>
							<div class="behind">
								<?php echo $this->element('pictograms', array('name' => 'delete')) ?>
							</div>

							<div class="front">
							<?php echo $this->Form->postLink(__('Supprimer le transport'), 
								array(
									'action' => 'delete', 
									$transport['Transport']['transport_id'],
									$etape_debut,
									$etape_fin,
									$voyage_id,
									$etape_name
								), 
								array(), 
								__('Etes-vous sûr de vouloir supprimer le transport ?')); ?>
							</div>
						</div>

						<?php $i += 1; ?>
					</div>
				</td>
			</tr>
			<?php endforeach; ?>

			<tr>
				<td>
					<div id="small">
				        <?php echo $this->Html->image('add_button_orange.png', array('height'=>'10px'));?>
				        <?php echo h('Proposer un nouveau transport'); ?>
				    </div>
				    <div id="normal">
				    	<div class='float'>
					    	<?php echo $this->Html->image('add_button_orange.png', array('height'=>'10px'));?>
					        <?php echo h('Proposer un nouveau transport'); ?>
					    </div>
				        <div class='float right' id="reduire">
				        	<?php echo __('Réduire'); ?>
				        </div>
				        <div class="transports form">
						<?php echo $this->Form->create('Transport', array('action' => 'add/'.$base_url.'&etape_debut='.$etape_debut.'&etape_fin='.$etape_fin)); ?>
						    <fieldset>
						        <?php 	
						        	$options = array(
						        		'avion' => 
						        			'<div class="float">'.
									    		$this->element('pictograms', array('name' => 'avion')).
									    	'avion</div>',
									    'bateau' => 
									    	'<div class="float">'.
									    		$this->element('pictograms', array('name' => 'bateau')).
									    	'bateau</div>',
									    'bus' => 
									    	'<div class="float">'.
									    		$this->element('pictograms', array('name' => 'bus')).
									    	'bus</div>',
									    'train' => 
									    	'<div class="float">'.
									    		$this->element('pictograms', array('name' => 'train')).
									    	'train</div>',
									    'voiture' => 
									    	'<div class="float">'.
									    		$this->element('pictograms', array('name' => 'voiture')).
									    	'voiture</div>',
									    'autre' =>
									    	'<div class="float">'.
									    		$this->element('pictograms', array('name' => 'autre')).
									    	'autre</div>'
									);

									$attributes = array(
									    'legend' => false,
									    'value' => 'train'
									);

									echo $this->Form->radio('type', $options, $attributes, array('label'=>'Type'));

									echo $this->Form->input('lieu_depart', array('label'=>'Lieu de départ'));
					                echo $this->Form->input('lieu_arrivee', array('label'=>'Lieu d\'arrivée'));
								?>

						        	<div>
						                <div class='float'>
						                    <h5>Du</h5>
						                    <?php echo $this->datePicker->flat('Transport][date_debut');?>
						                    <?php echo $this->Form->input('heure_debut', array('label'=>'Heure de départ')); ?>
						                </div>
						                <div class='float'>
						                    <h5>Au</h5>
						                    <?php echo $this->datePicker->flat('Transport][date_fin');?>
						                    <?php echo $this->Form->input('heure_fin', array('label'=>'Heure d\'arrivée')); ?>
						                </div>
						                <p><i><?php echo __('(Les dates doivent être supérieures à aujourd\'hui, avec la date de fin postérieure à la date de début.)'); ?></p></i>
						            </div>
					                
					            <?php
						        	echo $this->Form->input('prix', array('label'=>'Prix'));

						        	if($etape_debut != 0) {
							        	echo $this->Form->input('etape_debut',
							        		array('type' => 'hidden', 'default' => $etape_debut));
							        }

							        if($etape_fin != 0) {
							        	echo $this->Form->input('etape_fin',
							        		array('type' => 'hidden', 'default' => $etape_fin));
							        }

						        	echo $this->Form->input('createur_id',
						        		array('type' => 'hidden', 'default' => $user_id));

						        	echo $this->Form->input('url', 
						        		array('type'=>'hidden', 'default' => $base_url))
						    	?>
						    </fieldset>
						<?php echo $this->Form->end(__('Ajouter')); ?>
						</div>
					</div>
				</td>
			</tr>
		</tbody>
	</table>
</div>

<?php
	echo $this->element('frise', array(
        'voyage_id' => $voyage_id,
        'transport_selected' => $transport_id 
    ));
?>