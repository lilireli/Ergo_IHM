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

<?php
	$username = $this->session->read('Auth.User.user_name');

	if($username==NULL){
		echo $this->element('inscription');
		echo $this->element('connexion');		
	}
	else {
		?>
		<h1>Accueil</h1>
		<p> Bienvenue sur le site Grouptrotteur </p>
		<?php
	}
?>

