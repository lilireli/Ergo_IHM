<?php
/**
 * GroupTrotteur: Heureux qui comme Ulysse a fait un beau voyage
 *
 * Formulaire de connexion 
 *
 * @author        A. Chardon, A. El Bachiri, J. Pieyre, A. Suzanne
 */
?>

<div class="login form">
	<h3><?php echo __("Connexion"); ?></h3>
	
	<?php echo $this->Session->flash('auth'); ?>
	<?php echo $this->Form->create('User', array('action' => 'login')); ?>
    <fieldset>
        <?php 
        	echo $this->Form->input('user_name', array('label'=>'Nom d\'utilisateur'));
        	echo $this->Form->input('password', array('label'=>'Mot de passe'));
    	?>
    </fieldset>
<?php echo $this->Form->end(__('Me connecter')); ?>
</div>