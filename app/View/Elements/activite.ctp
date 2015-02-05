<?php 
	$activites = $this->requestAction(
		array('controller'=>'activites', 'action'=>'view', $etape_id));

	$user_id = $this->session->read('Auth.User.user_id');
?>

<div class="activites">
	<table cellpadding="0" cellspacing="0">
		<thead>
			<tr>
				<th><h2><?php echo __('Propositions d\'activités'); ?></h2></th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($activites as $activite): ?>
			<tr>
				<td>
					<?php echo h($activite['Activite']['activite_name']); ?>&nbsp;
					<?php echo h($activite['Activite']['type']); ?>&nbsp;
					<?php echo h($activite['Activite']['date_debut']); ?>&nbsp;
					<?php echo h($activite['Activite']['date_fin']); ?>&nbsp;
					<?php echo h($activite['Activite']['createur_id']); ?>&nbsp;
					<?php echo h($activite['Activite']['lieu']); ?>&nbsp;
					<?php echo h($activite['Activite']['prix']); ?>&nbsp;
					<?php echo h($activite[0]['count_activite']); ?>&nbsp;
					<div class="actions">
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
				        	<?php echo $this->Form->create('Activite', array('action' => 'add')); ?>
						    <fieldset>
						        <?php 
						        	$options = array(
									    'restaurant & bar'=>'restaurant & bar', 
									    'culture'=>'culture', 
									    'nature'=>'nature', 
									    'attraction'=>'attraction',
									    'sport'=>'sport', 
									    'autre'=>'autre'
									);

									$attributes = array(
									    'legend' => false,
									    'value' => 'restaurant & bar'
									);

									echo $this->Form->radio('type', $options, $attributes, array('label'=>'Type'));

						        	echo $this->Form->input('activite_name', array('label'=>'Nom'));
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