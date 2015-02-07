<?php $this->element('date_to_string'); // afficher dates français ?>

<div class="general_voyage">
	<?php 
		$etape_id = strtok(basename($this->here), '%3F'); 
		$etape_name = $_GET['etape_name'];
	    $voyage_id = $_GET['voyage_id'];

	    $base_url = '?voyage_id='.$voyage_id.
            '&etape_name='.$etape_name;

	    $user_id = $this->session->read('Auth.User.user_id');

	    $accepte = false;
	    $i = 0;
	?>

	<div>
		<div>
        	<h2><?php echo __('Etape '.ucfirst(strtolower($etape_name))); ?><h2>
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

	

	<?php    
	    echo $this->element('menu_etape', array('base_url' => $etape_id.$base_url, 'tab' => 2));
	?>

	<div class="general_voyage">
		<table cellpadding="0" cellspacing="0">
			<thead>
				<tr>
					<th><h2><?php echo __('Propositions d\'activités'); ?></h2></th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($activites as $activite): ?>
				<tr>
					<?php 
						// changer la couleur de la case si l'hébergement est validé
						if ($activite['Activite']['accepte'] == 1) { 
							$accepte = true;
					?>
						<td class="accepte">
					<?php } else { ?>
						<td>
					<?php } ?>

						
						<div class="float border_right" style="width:60%">
							<!-- Afficher les données générales -->
							<div class="float top" style="width:40%">
								<?php echo $this->element('pictograms', array('name' => $activite['Activite']['type'])); ?>&nbsp;
								<big><b><?php echo h(ucfirst(strtolower($activite['Activite']['activite_name']))); ?></b></big>&nbsp;
							</div>

							<div class="float">
								<?php echo __("Dates : du "); ?>
								<?php echo h(aff_date($activite['Activite']['date_debut'])); ?>
								<?php echo __(" au "); ?>
								<?php echo h(aff_date($activite['Activite']['date_fin'])); ?>
								<br>
								<?php echo __("Lieu : "); ?>&nbsp;&nbsp;
								<?php echo h($activite['Activite']['lieu']); ?>
								<br>
								<?php echo __("Prix : "); ?>&nbsp;&nbsp;
								<?php
									if($activite['Activite']['prix'] != 0){
										echo h($activite['Activite']['prix']); 
									} else { echo __('-'); }
									echo __('€');
								?>
							</div>			
							
							<!-- Edition -->
							<div class="float button_keeper right">
									<div class="behind">
									<?php echo $this->element('pictograms', array('name' => 'edition')) ?>
									</div>

									<div class="front">
								<?php echo $this->Html->link(__('Editer'), array('action' => 'edit', $activite['Activite']['activite_id'].$base_url.'&etape_id='.$etape_id)); ?>
									</div>
							</div>

						</div>

						<div class="float border_right top" style="width:10%">
							<div class="float">
								<big>
									<br>
									<?php 
										$votes = $activite[0]['count_activite'];
										echo h($votes);
										if($votes<2) echo __(' Vote'); 
										else echo __(' Votes');
									?>
								</big>
							</div>
						
							<!-- Vote -->
							<?php if ($activite[0]['count_user'] < 1) { ?>
								<div class="float button_keeper">
									<div class="behind">
										<?php echo $this->element('pictograms', array('name' => 'unvote')) ?>
									</div>

									<div class="front">
										<?php echo $this->Form->create('Vote', array('action' => 'add')); ?>
					    				<fieldset>
						        			<?php 
									        	echo $this->Form->input('type_name',
									        		array('type' => 'hidden', 'default' => 'activite'));
									        	echo $this->Form->input('type_id',
									        		array('type' => 'hidden', 'default' => $activite['Activite']['activite_id']));
									        	echo $this->Form->input('user_id',
									        		array('type' => 'hidden', 'default' => $user_id));
									        	echo $this->Form->input('etape_id',
									        		array('type' => 'hidden', 'default' => $etape_id));
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
													'activite',
													$activite['Activite']['activite_id'],
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
								<?php echo $this->Form->create('Activite', array('action' => 'edit/'.$activite['Activite']['activite_id'])); ?>
			    				<fieldset>
				        			<?php 
							        	echo $this->Form->input('accepte',
							        		array('type' => 'hidden', 'default' => 1));
							        	echo $this->Form->input('activite_id',
							        		array('type' => 'hidden', 'default' => $activite['Activite']['activite_id']));
							        	echo $this->Form->input('url', 
							        		array('type' => 'hidden', 'default' => $etape_id.$base_url));
							    	?>
							    </fieldset>
								<?php echo $this->Form->end(__('Valider')); ?>
								</div>

							<?php } else if ($i==0) { ?>
								<div class="behind">
								<?php echo $this->element('pictograms', array('name' => 'uncheck')) ?>
								</div>

								<div class="front">
								<?php echo $this->Form->create('Activite', array('action' => 'edit/'.$activite['Activite']['activite_id'])); ?>
			    				<fieldset>
				        			<?php 
							        	echo $this->Form->input('accepte',
							        		array('type' => 'hidden', 'default' => 0));
							        	echo $this->Form->input('activite_id',
							        		array('type' => 'hidden', 'default' => $activite['Activite']['activite_id']));
							        	echo $this->Form->input('url', 
							        		array('type' => 'hidden', 'default' => $etape_id.$base_url));
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
								<?php echo $this->Form->postLink(__('Supprimer l\'activité'), 
									array(
										'action' => 'delete', 
										$activite['Activite']['activite_id'],
										$etape_id,
										$voyage_id,
										$etape_name
									),
									array(),
									__('Etes-vous sûr de vouloir supprimer l\'activité ?')); ?>
								</div>
							</div>

								<?php $i += 1; ?>
						</div>
						</div>
					</td>
				</tr>
				<?php endforeach; ?>

				<tr>
					<td>
						<div id="small">
					        <?php echo $this->Html->image('add_button_orange.png', array('height'=>'10px'));?>
					        <?php echo h('Proposer une nouvelle activité'); ?>
					    </div>
					    <div id="normal">
					    	<div class='float'>
						    	<?php echo $this->Html->image('add_button_orange.png', array('height'=>'10px'));?>
						        <?php echo h('Proposer une nouvelle activité'); ?>
						    </div>
					        <div class='float right' id="reduire">
					        	<?php echo __('Réduire'); ?>
					        </div>

					        <div class="add">
					        	<?php echo $this->Form->create('Activite', array('action' => 'add/'.$base_url.'&etape_id='.$etape_id)); ?>
							    <fieldset>
							        <?php 
							        	$options = array(
										    'restaurant & bar'=>
										    	'<div class="float">'.
										    		$this->element('pictograms', array('name' => 'restaurant & bar')).
										    	'restaurant & bar</div>',
										    'culture'=> 
										    	'<div class="float">'.
										    		$this->element('pictograms', array('name' => 'culture')).
										    	'culture</div>',
										    'nature'=> 
										    	'<div class="float">'.
										    		$this->element('pictograms', array('name' => 'nature')).
										    	'nature</div>',
										    'attraction'=>
										    	'<div class="float">'.
										    		$this->element('pictograms', array('name' => 'attraction')).
										    	'attraction</div>',
										    'sport'=> 
										    		'<div class="float">'.
										    		$this->element('pictograms', array('name' => 'sport')).
										    	'sport</div>',
										    'autre'=>
										    	'<div class="float">'.
										    		$this->element('pictograms', array('name' => 'autre')).
										    	'autre</div>'
										);

										$attributes = array(
										    'legend' => false,
										    'value' => 'restaurant & bar'
										);

										echo $this->Form->radio('type', $options, $attributes, array('label'=>'Type'));

							        	echo $this->Form->input('activite_name', array('label'=>'Nom'));
							        ?>
							        	
						        	<div>
						                <div class='float'>
						                    <h5>Du</h5>
						                    <?php echo $this->datePicker->flat('Activite][date_debut');?>
						                </div>
						                <div class='float'>
						                    <h5>Au</h5>
						                    <?php echo $this->datePicker->flat('Activite][date_fin');?>
						                </div>
						                <p><i><?php echo __('(Les dates doivent être supérieures à aujourd\'hui, avec la date de fin postérieure à la date de début.)'); ?></p></i>
						            </div>
							        	
							        <?php
							        	echo $this->Form->input('lieu', array('label'=>'Adresse'));
							        	echo $this->Form->input('prix', array('label'=>'Prix'));

							        	echo $this->Form->input('etape_id',
							        		array('type' => 'hidden', 'default' => $etape_id));
							        	echo $this->Form->input('createur_id',
							        		array('type' => 'hidden', 'default' => $user_id));
							        	echo $this->Form->input('url',
                    						array('type'=>'hidden', 'default'=> $etape_id.$base_url));
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
</div>

<?php
    echo $this->element('frise', array(
        'voyage_id' => $voyage_id,
        'etape_selected' => $etape_id
    ));
?>