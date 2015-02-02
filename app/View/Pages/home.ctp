<?php
/**
 * GroupTrotteur: Heureux qui comme Ulysse a fait un beau voyage
 *
 * Page d'accueil en mode non connecté 
 * (seule option possible : se connecter)
 *
 * @author   	  A. Chardon, A. El Bachiri, J. Pieyre, A. Suzanne
 * @package       app.View.Pages
 */

if (!Configure::read('debug')):
	throw new NotFoundException();
endif;

App::uses('Debugger', 'Utility');
?>

<h2>Accueil</h2>
<p> Bienvenue sur le site d'organisation de voyages collaboratif </p>

<?php
	$username = $this->session->read('Auth.User.user_name');

	if($username==NULL){
		echo $this->element('connexion');
		echo $this->element('inscription');
	}
	else {
		echo __('youplaboum');
	}
?>

