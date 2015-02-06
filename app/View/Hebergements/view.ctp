<div class="general_voyage">
	<?php 
		$etape_id = strtok(basename($this->here), '%3F'); 
		$etape_name = $_GET['etape_name'];
	    $voyage_id = $_GET['voyage_id'];
	    $days = $_GET['days'];
	    $date_debut = $_GET['date_debut'];

	    $base_url = $etape_id.
            '?voyage_id='.$voyage_id.
            '&days='.$days.
            '&date_debut='.$date_debut.
            '&etape_name='.$etape_name;

	    $user_id = $this->session->read('Auth.User.user_id');

	    $this->element('date_to_string');

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
	    echo $this->element('menu_etape', array('base_url' => $base_url, 'tab' => 1));
	?>

	<div class="general_voyage">
		<table cellpadding="0" cellspacing="0">
			<thead>
				<tr>
					<th><h2><?php echo __('Propositions d\'hébergements'); ?></h2></th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($hebergements as $hebergement): ?>
				<tr>
					<?php 
						// changer la couleur de la case si l'hébergement est validé
						if ($hebergement['Hebergement']['accepte'] == 1) { 
							$accepte = true;
					?>
						<td class="accepte">
					<?php } else { ?>
						<td>
					<?php } ?>

						<!-- Afficher les données générales -->
						<div class="float">
							<b><?php echo h($hebergement['Hebergement']['hebergement_name']); ?></b>&nbsp;
							<?php echo h($hebergement['Hebergement']['type']); ?>&nbsp;
							<?php echo h(aff_date($hebergement['Hebergement']['date_debut'])); ?>&nbsp;
							<?php echo h($hebergement['Hebergement']['date_fin']); ?>&nbsp;
							<?php echo h($hebergement['Hebergement']['createur_id']); ?>&nbsp;
							<?php echo h($hebergement['Hebergement']['lieu']); ?>&nbsp;
							<?php echo h($hebergement['Hebergement']['prix']); ?>&nbsp;
							<?php echo h($hebergement[0]['count_hebergement']); ?>&nbsp;
						</div>

						<div class="float right buttons_hat hat">
						<!-- Vote -->
						<?php if ($hebergement[0]['count_user'] < 1) { ?>
							<div class="float">
								<?php echo $this->Form->create('Vote', array('action' => 'add')); ?>
			    				<fieldset>
				        			<?php 
							        	echo $this->Form->input('type_name',
							        		array('type' => 'hidden', 'default' => 'hebergement'));
							        	echo $this->Form->input('type_id',
							        		array('type' => 'hidden', 'default' => $hebergement['Hebergement']['hebergement_id']));
							        	echo $this->Form->input('user_id',
							        		array('type' => 'hidden', 'default' => $user_id));
							        	echo $this->Form->input('etape_id',
							        		array('type' => 'hidden', 'default' => $etape_id));
							    	?>
							    </fieldset>
								<?php echo $this->Form->end(__('Voter pour')); ?>
							</div>
						<?php } else { ?>
							<div class='input_like float'>
							<?php echo $this->Form->postLink(__('Enlever vote'), array('action' => 'delete', 'vote')); ?>
							</div>
						<?php } ?>
						

						<!-- Edition -->
						<div class='input_like float'>
							<?php echo $this->Html->link(__('Editer'), array('action' => 'edit', $hebergement['Hebergement']['hebergement_id'])); ?>
						</div>

						<!-- Validation -->
						<div class="float">
							<?php if(!$accepte) { ?>
								<?php echo $this->Form->create('Hebergement', array('action' => 'edit/'.$hebergement['Hebergement']['hebergement_id'])); ?>
			    				<fieldset>
				        			<?php 
							        	echo $this->Form->input('accepte',
							        		array('type' => 'hidden', 'default' => 1));
							        	echo $this->Form->input('hebergement_id',
							        		array('type' => 'hidden', 'default' => $hebergement['Hebergement']['hebergement_id']));
							        	echo $this->Form->input('url', 
							        		array('type' => 'hidden', 'default' => $base_url));
							    	?>
							    </fieldset>
								<?php echo $this->Form->end(__('Valider')); ?>
							<?php } else if ($i==0) { ?>
								<?php echo $this->Form->create('Hebergement', array('action' => 'edit/'.$hebergement['Hebergement']['hebergement_id'])); ?>
			    				<fieldset>
				        			<?php 
							        	echo $this->Form->input('accepte',
							        		array('type' => 'hidden', 'default' => 0));
							        	echo $this->Form->input('hebergement_id',
							        		array('type' => 'hidden', 'default' => $hebergement['Hebergement']['hebergement_id']));
							        	echo $this->Form->input('url', 
							        		array('type' => 'hidden', 'default' => $base_url));
							    	?>
							    </fieldset>
								<?php echo $this->Form->end(__('Dévalider')); ?>
								<?php } ?>
							</div>

							<!-- suppression -->
							<div class='input_like float'>
								<?php echo $this->Form->postLink(__('Supprimer l\'hebergement'), array('action' => 'delete', $hebergement['Hebergement']['hebergement_id']), array(), __('Etes-vous sûr de vouloir supprimer l\'hébergement ?')); ?>
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
					        <?php echo h('Proposer un nouvel hébergement'); ?>
					    </div>
					    <div id="normal">
					    	<div class='float'>
						    	<?php echo $this->Html->image('add_button_orange.png', array('height'=>'10px'));?>
						        <?php echo h('Proposer un nouvel hébergement'); ?>
						    </div>
					        <div class='float right' id="reduire">
					        	<?php echo __('Réduire'); ?>
					        </div>

					        <div class="add">
					        	<?php echo $this->Form->create('Hebergement', array('action' => 'add')); ?>
							    <fieldset>
							        <?php 
							        	$options = array(
										    'hôtel'=>'hôtel', 
										    'auberge de jeunesse'=>'auberge de jeunesse', 
										    'location'=>'location', 
										    'camping'=>'camping', 
										    'autre'=>'autre'
										);

										$attributes = array(
										    'legend' => false,
										    'value' => 'hôtel'
										);

										echo $this->Form->radio('type', $options, $attributes, array('label'=>'Type'));

							        	echo $this->Form->input('hebergement_name', array('label'=>'Nom'));
							        ?>
							        	
						        	<div class='float'>
										<?php 
											echo $this->Form->input('date_debut', array(
												'label'=>'Du',
												'dateFormat' => 'DMY',
							    				'minYear' => date('Y'),
							    				'maxYear' => date('Y') + 10,
						    				)); 
						    			?>
									</div>
									<div class='float'>
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
							        	echo $this->Form->input('lieu', array('label'=>'Adresse'));
							        	echo $this->Form->input('prix', array('label'=>'Prix'));

							        	echo $this->Form->input('etape_id',
							        		array('type' => 'hidden', 'default' => $etape_id));
							        	echo $this->Form->input('createur_id',
							        		array('type' => 'hidden', 'default' => $user_id));
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
        'days' => $days,
        'date_debut' => $date_debut,
        'etape_selected' => $etape_id
    ));
?>