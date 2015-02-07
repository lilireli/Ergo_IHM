<div>
	<div class="form">
		<h3><?php echo __('Editer mon voyage'); ?></h3>

		<?php echo $this->Form->create('Voyage'); ?>
		<fieldset>
			<?php $user_id = $this->session->read('Auth.User.user_id'); ?>
			
			<?php echo $this->Form->input('voyage_name', array('label'=>'Nom du voyage')); ?>
			<?php echo $this->Form->input('lieu', array('label'=>'Lieu')); ?>

			<div>
				<div class='float'>
					<h5>Du</h5>
					<?php echo $this->datePicker->flat('Voyage][date_debut');?>
				</div>
				<div class='float'>
					<h5>Au</h5>
					<?php echo $this->datePicker->flat('Voyage][date_fin');?>
				</div>
				<p><i><?php echo __('(Les dates doivent être supérieures à aujourd\'hui, avec la date de fin postérieure à la date de début.)'); ?></p></i>
			</div>

			<?php echo $this->Form->input('voyage_id'); ?>
		</fieldset>
	<?php echo $this->Form->end(__('Modifier')); ?>
	</div>
	<div class="actions">
		<h3><?php echo __('Actions'); ?></h3>
		<ul>

			<li>
				<?php 
					echo $this->Form->postLink(__('Retour au voyage'), array('action' => 'view', basename($this->request->here)));
					// basename nous permet de récupérer le voyage_id
				?>
			</li>
		</ul>
	</div>
</div>
