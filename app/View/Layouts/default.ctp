<?php
/**
 * GroupTrotteur: Heureux qui comme Ulysse a fait un beau voyage
 *
 * @author   	  A. Chardon, A. El Bachiri, J. Pieyre, A. Suzanne
 * @package       app.View.Layouts
 */

// version de GroupTrotteur
$GTDescription = __d('gt_dev', 'GroupTrotteur');
$GTVersion = __d('gt_dev', '1.0')
?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $GTDescription ?>:
		<?php echo $this->fetch('title'); ?>
	</title>
	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css('cake.generic');
		echo $this->Html->css('gt.generic');
		echo $this->Html->css('autocomplete');
		// les paramètres de style de GroupTrotteur viennent écraser
		// Les réglages embétants de CakePHP mais certains sont conservés

		echo $this->fetch('meta');
		echo $this->fetch('css');

		echo $this->Html->script('jquery_1.11.0', array('inline'=>false));
		echo $this->Html->script('jquery-ui.min', array('inline'=>false));
		echo $this->Html->script('general',array('inline'=>false));
		echo $this->fetch('script');
	?>
</head>
<body>
	<div id="container">
		<div id="header">
			<?php 
				// réalisation du bandeau de titre

				// informations session
				$user_id = $this->session->read('Auth.User.user_id');
				$username = $this->session->read('Auth.User.user_name');

				//ajout du logo
				echo $this->Html->image('grouptrotteur.icon.png', array('height'=>'40px')); 
			?>

			<div id="links">
				<?php
					// on n'affiche les menus que si la personne est connectée
					if ($username != NULL) {
						// menus du bandeau
						echo $this->Html->link('Accueil', array('controller'=>'pages', 'action'=>'display', 'home'));
						echo ' | ';
						echo $this->Html->link('Voyages', array('controller'=>'voyages', 'action'=>'index'));
						echo '|';
						echo $this->Html->link('Mon Compte', array('controller'=>'users', 'action'=>'index'));
						echo ' | ...';
					}
				?>
			</div>
			<div id="userConnection">
				<?php
					if ($username != NULL) {
						// utilisateur
						echo $username;
						echo __("   ");

						// deconnexion
						echo $this->Html->link('Deconnexion', array('controller'=>'users', 'action'=>'logout'));
					}
				?>
			</div>
		</div>
		<div id="content">

			<?php echo $this->Session->flash(); ?>

			<?php echo $this->fetch('content'); ?>
		</div>
		<div id="footer">
			<?php echo $this->Html->link(
					$this->Html->image('cake.power.gif', array('alt' => $GTDescription, 'border' => '0')),
					'http://www.cakephp.org/',
					array('target' => '_blank', 'escape' => false, 'id' => 'cake-powered')
				);
			?>
			<p>
				<?php echo $GTVersion; ?>
			</p>
		</div>
	</div>
</body>
</html>
