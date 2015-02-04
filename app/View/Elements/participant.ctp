<?php 
	$participants = $this->requestAction(
		array('controller'=>'Voyages', 'action'=>'participants', $voyage_id)); 
?>



<div class="view participants">
	<table cellpadding="0" cellspacing="0">
		<thead>
			<tr>
				<th><h2><?php echo __('Trotteurs'); ?></h2></th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($participants as $participant): ?>
			<tr>
				<td>
					<?php echo h($participant['User2']['user_name']); ?>&nbsp;
				</td>
				<td class="actions">
					<?php echo $this->Html->link(__('Supprimer'), array('controller' => 'voyages', 'action' => 'delete_participant', $voyage_id, $participant['User2']['user_id']));?>
				</td>
			</tr>
			<?php endforeach; ?>
			<tr>
				<td>
					<div id="small">
				        <?php echo $this->Html->image('add_button_orange.png', array('height'=>'10px'));?>
				        <?php echo h('Ajouter un trotteur'); ?>
				    </div>
				    <div id="normal">
				    	<div class='float'>
					    	<?php echo $this->Html->image('add_button_orange.png', array('height'=>'10px'));?>
					        <?php echo h('Ajouter un trotteur'); ?>
					    </div>
				        <div class='float right' id="reduire">
				        	<?php echo __('Réduire'); ?>
				        </div>

				        <div class="add participant">
				        	<?php 
				        		echo $this->Html->script('jquery_1.11.0', array('inline'=>false));
								echo $this->Html->script('jquery-ui.min', array('inline'=>false));
								echo $this->Html->script('jquery.ui.autocomplete.html', array('inline'=>false));
				        		echo $this->Html->script('autoComplete', array('inline'=>false)); 
				        		echo $this->fetch('script');
				        	?>

							<?php echo $this->Form->create('Voyage', array('action' => 'add_participants')); ?>
						    <fieldset>
						        <?php 
						        	echo $this->Form->input('voyage_id', 
						        		array('type'=>'hidden', 'default'=>$voyage_id, 'id'=>'voyage_id'));
						        ?>

						        <div id='trotteurs'>
						        	<input id="participants" name="participant" type="text">			
						    	</div>
						    </fieldset>
							<?php echo $this->Form->end(__('Ajouter')); ?>
						</div>
				    </div>
				</td>
			</tr>
		</tbody>
	</table>
</div>



