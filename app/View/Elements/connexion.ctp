<div class="login form">
	<h3><?php echo __("Connexion"); ?></h3>
	
	<?php echo $this->Session->flash('auth'); ?>
	<?php echo $this->Form->create('User', array('action' => 'login')); ?>
    <fieldset>
        <legend>
            <?php echo __('Veuillez entrer vos données'); ?>
        </legend>
        <?php 
        	echo $this->Form->input('user_name');
        	echo $this->Form->input('password');
    	?>
    </fieldset>
<?php echo $this->Form->end(__('Login')); ?>
</div>