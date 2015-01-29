<?php
App::uses('AppController', 'Controller');
/**
 * Transport Controller
 *
 */
class TransportsController extends AppController {
	public function add() {
		if ($this->request->is('post')) {
			$this->Transport->create();
			
			if ($this->Transport->save($this->request->data)) {
				// rediriger vers la page de l'étape
				$this->Session->setFlash(__("Le transport a été sauvé."));
				$this->redirect(array(
					'controller' => 'etapes', 
					'action' => 'index', 
					$this->request->data['Transport']['etape_id']
				));
			}
		}
	}

	public function view($id) {
	// parameter: one etape id

		$options = array(
			'conditions' => array(
				'Transport.etape_id' => $id
			),
			'joins' => array(
	 			array(
		 			'table' => 'votes',
		 			'alias' => 'Vote',
		 			'type' => 'left outer',
		 			'conditions' => array(
		 				'Transport.transport_id = Vote.type_id',
		 				'Vote.type_name = "transport"'
		 			)
	 			)
	 		),
	 		'group' => array(
	 			'Transport.transport_id'
	 		),
	 		'fields' => array(
	 			'Transport.transport_id',
	 			'Transport.transport_name',
	 			'Transport.type',
	 			'Transport.date_debut',
	 			'Transport.date_fin',
	 			'Transport.createur_id',
	 			'Transport.lieu_depart',
	 			'Transport.lieu_arrivee',
	 			'Transport.prix',
	 			'Transport.accepte',
	 			'count(Vote.type_id) AS count_transport'
	 		));
		
		return $this->Transport->find('all', $options);
	}
}