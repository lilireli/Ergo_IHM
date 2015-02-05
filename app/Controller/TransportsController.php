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
					'controller' => 'transports', 
					'action' => 'view', 
					$this->request->data['Transport']['etape_debut'],
					$this->request->data['Trasnport']['etape_fin'],
					$this->request->data['Transport']['url']
				));
			}
		}
	}

	public function view($etape_debut, $etape_fin) {
		$condition = array();

		if($etape_debut == 0){ $etape_debut = null;}
		if($etape_fin == 0){ $etape_fin = null; }

		$options = array(
			'conditions' => array(
				'Transport.etape_debut' => $etape_debut,
				'Transport.etape_fin' => $etape_fin
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
		
		$this->set('transports', array(
			'res' => $this->Transport->find('all', $options),
			'etape_debut' => $etape_debut,
			'etape_fin' => $etape_fin
		));
	}
}