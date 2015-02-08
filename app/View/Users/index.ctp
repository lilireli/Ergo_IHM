<?php
/**
 * GroupTrotteur: Heureux qui comme Ulysse a fait un beau voyage
 *
 * Afficher un utilisateur
 *
 * @author        A. Chardon, A. El Bachiri, J. Pieyre, A. Suzanne
 */
?>

<?php $this->element('date_to_string'); // afficher dates français ?>

<div>
<h1><?php echo __('Mon compte'); ?></h1>
	<dl>
		<dt><?php echo __('Nom d\'utilisateur'); ?></dt>
		<dd>
			<?php echo h($user['User']['user_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('E-mail'); ?></dt>
		<dd>
			<?php echo h($user['User']['mail']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Date de naissance'); ?></dt>
		<dd>
			<?php echo h(aff_date($user['User']['date_of_birth'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Mes actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Modifier mon profil'), array('action' => 'edit', $user['User']['user_id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Modifier mon mot de passe'), array('action' => 'edit_pw', $user['User']['user_id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Supprimer mon compte'), array('action' => 'delete', $user['User']['user_id']), array(), __('Etes-vous sûr de vouloir supprimer votre compte ?')); ?> </li>
	</ul>
</div>
