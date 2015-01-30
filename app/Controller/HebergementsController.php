<?php
App::uses('AppController', 'Controller');
/**
 * Hebergement Controller
 *
 */
class HebergementsController extends AppController {
	public function add() {
		if ($this->request->is('post')) {
			$this->Hebergement->create();
			
			if ($this->Hebergement->save($this->request->data)) {
				// rediriger vers la page de l'étape
				$this->Session->setFlash(__("L'hébergement a été sauvé."));
				$this->redirect(array(
					'controller' => 'etapes', 
					'action' => 'index', 
					$this->request->data['Hebergement']['etape_id']
				));
			}
		}
	}

	public function view($id) {
	// parameter: one voyage id

		$options = array(
			'conditions' => array(
				'Hebergement.etape_id' => $id
			),
			'joins' => array(
	 			array(
		 			'table' => 'votes',
		 			'alias' => 'Vote',
		 			'type' => 'left outer',
		 			'conditions' => array(
		 				'Hebergement.hebergement_id = Vote.type_id',
		 				'Vote.type_name = "hebergement"'
		 			)
	 			)
	 		),
	 		'group' => array(
	 			'Hebergement.hebergement_id'
	 		),
	 		'fields' => array(
	 			'Hebergement.hebergement_id',
	 			'Hebergement.hebergement_name',
	 			'Hebergement.type',
	 			'Hebergement.date_debut',
	 			'Hebergement.date_fin',
	 			'Hebergement.createur_id',
	 			'Hebergement.lieu',
	 			'Hebergement.note',
	 			'Hebergement.prix',
	 			'Hebergement.accepte',
	 			'count(Vote.type_id) AS count_hebergement'
			));
		
		return $this->Hebergement->find('all', $options);
	}
}