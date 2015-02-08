<?php
/**
 * GroupTrotteur: Heureux qui comme Ulysse a fait un beau voyage
 *
 * Renvoyer une div contenant notre pictogramme
 *
 * @author        A. Chardon, A. El Bachiri, J. Pieyre, A. Suzanne
 */
?>

<div class="picto">

<?php
	switch ($name) {
	    case 'avion':
	        echo $this->Html->image('avion.png', array('width'=>'30px'));
	        break;
	    case 'bateau':
	        echo $this->Html->image('bateau.png', array('width'=>'30px'));
	        break;
	    case 'bus':
	        echo $this->Html->image('bus.png', array('width'=>'30px'));
	        break;
	    case 'train':
	        echo $this->Html->image('train.png', array('height'=>'25px'));
	        break;
	    case 'voiture':
	        echo $this->Html->image('voiture.png', array('width'=>'30px'));
	        break;
	    case 'hôtel':
	        echo $this->Html->image('hotel.png', array('width'=>'30px'));
	        break;
	    case 'chambre d\'hôte':
	        echo $this->Html->image('chambrehote.png', array('width'=>'30px'));
	        break;
	    case 'camping':
	        echo $this->Html->image('camping.png', array('width'=>'30px'));
	        break;
	    case 'restaurant & bar':
	        echo $this->Html->image('resto.png', array('width'=>'30px'));
	        break;
	    case 'culture':
	        echo $this->Html->image('culture.png', array('width'=>'30px'));
	        break;
	    case 'nature':
	        echo $this->Html->image('nature.png', array('width'=>'30px'));
	        break;
	    case 'attraction':
	        echo $this->Html->image('attraction.png', array('width'=>'30px'));
	        break;
	    case 'sport':
	        echo $this->Html->image('sport.png', array('width'=>'30px'));
	        break;
	    case 'autre':
	        echo $this->Html->image('autre.png', array('height'=>'25px'));
	        break;
	    case 'vote':
	        echo $this->Html->image('vote.png', array('height'=>'25px'));
	        break;
	    case 'unvote':
	        echo $this->Html->image('unvote.png', array('height'=>'25px'));
	        break;
	    case 'edition':
	    	echo $this->Html->image('edition.png', array('height'=>'25px'));
	    	break;
	    case 'check':
	    	echo $this->Html->image('check.png', array('height'=>'25px'));
	    	break;
	    case 'uncheck':
	    	echo $this->Html->image('uncheck.png', array('height'=>'25px'));
	    	break;
	    case 'delete':
	    	echo $this->Html->image('delete.png', array('height'=>'25px'));
	    	break;
	    case 'loupe':
	    	echo $this->Html->image('loupe.png', array('height'=>'25px'));
	    	break;
	}
?>

</div>