<?php
/**
 * GroupTrotteur: Heureux qui comme Ulysse a fait un beau voyage
 *
 * Cette page sert à l'accueil en connecté
 *
 * @author   	  A. Chardon, A. El Bachiri, J. Pieyre, A. Suzanne
 * @package       app.View.Pages
 */

// mode de debug
if (!Configure::read('debug')):
	throw new NotFoundException();
endif;

App::uses('Debugger', 'Utility');
?>

<h2>Accueil</h2>
<p> Bienvenue sur le site d'organisation de voyages collaboratif </p>

youplaboum