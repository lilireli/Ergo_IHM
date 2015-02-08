<?php
/**
 * GroupTrotteur: Heureux qui comme Ulysse a fait un beau voyage
 *
 * @author   	  A. Chardon, A. El Bachiri, J. Pieyre, A. Suzanne
 */
App::uses('AppController', 'Controller');
/**
 * Transport Controller
 *
 */
class TransportsController extends AppController {
/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Transport->create();
			
			if ($this->Transport->save($this->request->data)) {
				// rediriger vers la page de l'étape
				$this->Session->setFlash(__("Le transport a été sauvé."));

				$etape_debut = $this->request->data['Transport']['etape_debut']; 
				if ($etape_debut == null) { $etape_debut = 0; }
				$etape_fin = $this->request->data['Transport']['etape_fin'];
				if ($etape_fin == null) { $etape_fin = 0; } 

				$this->redirect(array(
					'controller' => 'transports', 
					'action' => 'view', 
					$etape_debut,
					$etape_fin.
						$this->request->data['Transport']['url']
				));
			}
		}
	}

/**
 * edit method
 *
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		// enlever les paramètre pour récupérer le bon id
		$id = strtok(basename($id), '?');
		$id = strtok(basename($id), '%3F');
		
		if (!$this->Transport->exists($id)) {
			throw new NotFoundException(__('Invalid transport'));
		}

		if ($this->request->is(array('post', 'put'))) {
			if ($this->Transport->save($this->request->data)) {
				$this->Session->setFlash(__('Vos modifications ont été sauvées'));

				$params = split('/', $this->request->data['Transport']['url']);

                $this->redirect(array(
                	'controller' => 'transports', 
					'action' => 'view', 
                	$params[0],
                	$params[1]
                ));
			}
		}
		else {
			$options = array('conditions' => array('Transport.' . $this->Transport->primaryKey => $id));
			$this->request->data = $this->Transport->find('first', $options);
		}
	}

/**
 * view method
 *
 * @param string $etape_debut, string $etape_fin
 * @return void
 */
	public function view($etape_debut, $etape_fin) {
		// un transport s'identifie dans la frise grâce a son étape de début et de fin
		$etape_fin = strtok($etape_fin, "?");
		$user_id= AuthComponent::user('user_id');

		// la première et la dernière étape sont nulles
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
	 			),
	 			array(
		 			'table' => 'votes',
		 			'alias' => 'Vote2',
		 			'type' => 'left outer',
		 			'conditions' => array(
		 				'Vote.vote_id = Vote2.vote_id',
		 				'Vote2.user_id' => $user_id
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
	 			'Transport.heure_debut',
	 			'Transport.heure_fin',
	 			'Transport.createur_id',
	 			'Transport.lieu_depart',
	 			'Transport.lieu_arrivee',
	 			'Transport.prix',
	 			'Transport.accepte',
	 			'count(Vote.type_id) AS count_transport',
	 			'count(Vote2.type_id) AS count_user'
	 		),
	 		'order' => array(
				'Transport.accepte DESC', 
				'count_transport DESC'
			)
		);
		
		$this->set('transports', array(
			'res' => $this->Transport->find('all', $options),
			'etape_debut' => $etape_debut,
			'etape_fin' => $etape_fin
		));
	}

/**
 * delete method
 *
 * @param string $id, string $etape_debut, string $etape_fin, string $voyage_id, string $etape_name
 * @return void
 */
	public function delete($id = null, $etape_debut, $etape_fin, $voyage_id, $etape_name) {
		// la plupart des paramètres servent à la redirection
		$this->Transport->id = $id;
		if (!$this->Transport->exists()) {
			throw new NotFoundException(__('Invalid transport'));
		}

		$this->request->allowMethod('post', 'delete');
		if ($this->Transport->delete()) {
			$this->redirect(
            	array(
            		'action' => 'view',
            		$etape_debut,
            		$etape_fin.'?voyage_id='.$voyage_id.'&etape_name='.$etape_name
            	)
            );
		} else {
			$this->Session->setFlash(__('Erreur durant la suppression, veuillez réessayer'));
            $this->redirect(
            	array(
            		'action' => 'view',
            		$etape_debut,
            		$etape_fin.'?voyage_id='.$voyage_id.'&etape_name='.$etape_name
            	)
            );
		}
	}
}