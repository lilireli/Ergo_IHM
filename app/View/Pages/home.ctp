<?php
/**
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Pages
 * @since         CakePHP(tm) v 0.10.0.1076
 */

if (!Configure::read('debug')):
	throw new NotFoundException();
endif;

App::uses('Debugger', 'Utility');
?>

<h2>Accueil</h2>
<p> Bienvenue sur le site d'organisation de voyages collaboratif </p>

<h3>Inscription</h3>
<?php echo $this->fetch('inscription'); ?>

<h3> Connexion </h3>