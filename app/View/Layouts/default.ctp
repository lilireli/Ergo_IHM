<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

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

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
</head>
<body>
	<div id="container">
		<div id="header">
			<?php 
				$user_id = $this->session->read('Auth.User.user_id');
				$username = $this->session->read('Auth.User.user_name');

				echo $this->Html->image('grouptrotteur.icon.png', array('height'=>'40px')); 

				if ($username != NULL) {
					echo $this->Html->link('Accueil', array('controller'=>'pages', 'action'=>'display', 'index'));
					echo ' | ';
					echo $this->Html->link('Voyages', array('controller'=>'pages', 'action'=>'display', 'voyage'));
					echo '|';
					echo $this->Html->link('Mon Compte', array('controller'=>'users', 'action'=>'edit/'.$user_id));
					echo ' | ...';

					echo $username;
					echo $this->Html->link('Deconnexion', array('controller'=>'users', 'action'=>'logout'));
				}

			?>
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
