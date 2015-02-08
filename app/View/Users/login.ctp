<?php
/**
 * GroupTrotteur: Heureux qui comme Ulysse a fait un beau voyage
 *
 * Connecter un utilisateur
 *
 * @author        A. Chardon, A. El Bachiri, J. Pieyre, A. Suzanne
 */
?>

<div class="form">
	<h3><?php echo __("Connexion"); ?></h3>
	
	<?php echo $this->Session->flash('auth'); ?>
	<?php echo $this->Form->create('User'); ?>
    <fieldset>
        <?php 
        	echo $this->Form->input('user_name', array('label'=>'Nom d\'utilisateur'));
        	echo $this->Form->input('password', array('label'=>'Mot de passe'));
    	?>
    </fieldset>
<?php echo $this->Form->end(__('Me connecter')); ?>
</div>