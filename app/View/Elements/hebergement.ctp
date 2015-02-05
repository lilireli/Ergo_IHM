<?php 
	$hebergements = $this->requestAction(
		array('controller'=>'hebergements', 'action'=>'view', $etape_id));

	$user_id = $this->session->read('Auth.User.user_id');
?>

<div class="hebergements">
	<table cellpadding="0" cellspacing="0">
		<thead>
			<tr>
				<th><h2><?php echo __('Propositions d\'hébergements'); ?></h2></th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($hebergements as $hebergement): ?>
			<tr>
				<td>
					<?php echo h($hebergement['Hebergement']['hebergement_name']); ?>&nbsp;
					<?php echo h($hebergement['Hebergement']['type']); ?>&nbsp;
					<?php echo h($hebergement['Hebergement']['date_debut']); ?>&nbsp;
					<?php echo h($hebergement['Hebergement']['date_fin']); ?>&nbsp;
					<?php echo h($hebergement['Hebergement']['createur_id']); ?>&nbsp;
					<?php echo h($hebergement['Hebergement']['lieu']); ?>&nbsp;
					<?php echo h($hebergement['Hebergement']['prix']); ?>&nbsp;
					<?php echo h($hebergement[0]['count_hebergement']); ?>&nbsp;
					<div class="actions">
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