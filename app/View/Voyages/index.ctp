<?php $this->element('date_to_string'); // afficher dates français ?>

<h1><?php echo __('Mes Voyages'); ?></h1>


<?php foreach ($voyages as $voyage): ?>
<div class="list_voyages">
	<h4><?php echo h(ucfirst(strtolower($voyage['Voyage']['voyage_name']))); ?></h4>

	<div class="float">
		<p><b>
			<?php echo __("Destination "); ?>
			<?php echo h(ucfirst(strtolower($voyage['Voyage']['lieu']))); ?>
		</b></p>
		
		<p>
			<?php echo __("Du "); ?>
			<?php echo h(aff_date($voyage['Voyage']['date_debut'])); ?>
			<?php echo __(" au "); ?>
			<?php echo h(aff_date($voyage['Voyage']['date_fin'])); ?>
		</p>
	</div>

	<div class="float right">
		<p>
		<ul class="actions">
			<?php echo $this->Html->link(__('Voir'), array('action' => 'view', $voyage['Voyage']['voyage_id'])); ?>
		</ul>
		</p>

		<ul class="actions">
			<?php echo $this->Form->postLink(__('Supprimer'), array('action' => 'delete', $voyage['Voyage']['voyage_id']), array(), __('Etes vous sûr de vouloir supprimer le voyage %s ?', $voyage['Voyage']['voyage_name'])); ?>
		</ul>
	</div>
</div>
<?php endforeach; ?>

<div class="list_voyages form_voyages" id="wrapper">
    <div id="small">
        <?php echo $this->Html->image('add_button_orange.png', array('height'=>'20px'));?>
        <big><?php echo h('Créer un nouveau voyage'); ?></big>
    </div>
    <div id="normal">
    	<div class='float'>
	    	<?php echo $this->Html->image('add_button_orange.png', array('height'=>'20px'));?>
	        <big><?php echo h('Créer un nouveau voyage'); ?></big>
	    </div>
        <div class='float right' id="reduire">
        	<?php echo __('Réduire'); ?>
        </div>

        <?php echo $this->Form->create('Voyage', array('action' => 'add')); ?>
		<fieldset>
			<?php $user_id = $this->session->read('Auth.User.user_id'); ?>
			<div class='form_fieldset_voyages'>
				<?php echo $this->Form->input('voyage_name', array('label'=>'Nom du voyage')); ?>
			</div>

			<div class='form_fieldset_voyages'>
				<?php echo $this->Form->input('lieu', array('label'=>'Lieu')); ?>
			</div>

			<div class="form_fieldset">
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

			<?php
				echo $this->Form->input('createur_id', 
					array('type' => 'hidden', 'default' => $user_id));
				echo $this->Form->input('User',
					array('type' => 'hidden', 'default' => $user_id));
			?>
		</fieldset>
			<?php echo $this->Form->end(__('Créer')); ?>
    </div>
</div>


