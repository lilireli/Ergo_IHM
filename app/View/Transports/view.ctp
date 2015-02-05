<?php 
	$etape_debut = $transports['etape_debut']; 
	$etape_fin = $transports['etape_fin'];
	$transports = $transports['res'];

    $voyage_id = $_GET['voyage_id'];
    $days = $_GET['days'];
    $date_debut = $_GET['date_debut'];

    $url = str_replace('/transports/view/', '', basename($this->here));
    $url = str_replace('%3F', '?', $url);
    $url = str_replace('%3D', '=', $url);
    $url = str_replace('%26', '&', $url);

    $user_id = $this->session->read('Auth.User.user_id'); 
?>

<div class="general_voyage">
	<table cellpadding="0" cellspacing="0">
		<thead>
			<tr>
				<th><h2><?php echo __('Propositions de transports'); ?></h2></th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($transports as $transport): ?>
			<tr>
				<td>
					<?php echo h($transport['Transport']['type']); ?>&nbsp;
					<?php echo h($transport['Transport']['date_debut']); ?>&nbsp;
					<?php echo h($transport['Transport']['date_fin']); ?>&nbsp;
					<?php echo h($transport['Transport']['createur_id']); ?>&nbsp;
					<?php echo h($transport['Transport']['lieu_depart']); ?>&nbsp;
					<?php echo h($transport['Transport']['lieu_arrivee']); ?>&nbsp;
					<?php echo h($transport['Transport']['prix']); ?>&nbsp;
					<?php echo h($transport[0]['count_transport']); ?>&nbsp;
					<div class="actions">
						<?php echo $this->Form->create('Vote', array('action' => 'add')); ?>
	    				<fieldset>
		        			<?php 
					        	echo $this->Form->input('type_name',
					        		array('type' => 'hidden', 'default' => 'transport'));
					        	echo $this->Form->input('type_id',
					        		array('type' => 'hidden', 'default' => $transport['Transport']['transport_id']));
					        	echo $this->Form->input('user_id',
					        		array('type' => 'hidden', 'default' => $user_id));
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
						<?php echo $this->Form->create('Transport', array('action' => 'add')); ?>
						    <fieldset>
						        <legend>
						            <?php echo __('Ajouter un transport'); ?>
						        </legend>
						        <?php 	
						        	$options = array(
						        		'avion' => 'avion',
									    'bateau' => 'bateau',
									    'bus' => 'bus',
									    'train' => 'train',
									    'voiture' => 'voiture',
									    'autre' => 'autre'
									);

									$attributes = array(
									    'legend' => false,
									    'value' => 'train'
									);

									echo $this->Form->radio('type', $options, $attributes, array('label'=>'Type'));

						        	echo $this->Form->input('date_debut');
						        	echo $this->Form->input('date_fin');
						        	
						        	echo $this->Form->input('lieu_depart');
						        	echo $this->Form->input('lieu_arrivee');

						        	echo $this->Form->input('prix');

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
						        		array('type'=>'text', 'default' => $url))
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
        'days' => $days,
        'date_debut' => $date_debut
    ));
?>