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
					'controller' => 'hebergements', 
					'action' => 'view', 
					$this->request->data['Hebergement']['url']
				));
			}
		}
	}

	public function edit($id = null) {
		$id = strtok(basename($id), '?');
		$id = strtok(basename($id), '%3F');
		
		if (!$this->Hebergement->exists($id)) {
			throw new NotFoundException(__('Invalid hebergement'));
		}

		if ($this->request->is(array('post', 'put'))) {
			if ($this->Hebergement->save($this->request->data)) {
				$this->Session->setFlash(__('Vos modifications ont été sauvées'));
                $this->redirect(array(
                	'controller' => 'hebergements', 
					'action' => 'view', 
                	$this->request->data['Hebergement']['url']
                ));
			}
		}
		else {
			$options = array('conditions' => array('Hebergement.' . $this->Hebergement->primaryKey => $id));
			$this->request->data = $this->Hebergement->find('first', $options);
		}
	}

	public function view($id) {
	// parameter: one etape id
		$id = strtok($id, "?");
		$user_id= AuthComponent::user('user_id');

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
	 			'Hebergement.prix',
	 			'Hebergement.accepte',
	 			'count(Vote.type_id) AS count_hebergement',
	 			'count(Vote2.type_id) AS count_user'
			),
			'order' => array(
				'Hebergement.accepte DESC', 
				'count_hebergement DESC'
			)
		);
		
		$this->set('hebergements', $this->Hebergement->find('all', $options));
	}

	public function delete($id = null, $etape_id, $voyage_id, $etape_name) {
		$this->Hebergement->id = $id;
		if (!$this->Hebergement->exists()) {
			throw new NotFoundException(__('Invalid hebergement'));
		}

		$this->request->allowMethod('post', 'delete');
		if ($this->Hebergement->delete()) {
			$this->redirect(
            	array(
            		'action' => 'view',
            		$etape_id.'?voyage_id='.$voyage_id.'&etape_name='.$etape_name
            	)
            );
		} else {
			$this->Session->setFlash(__('Erreur durant la suppression, veuillez réessayer'));
            $this->redirect(
            	array(
            		'action' => 'view',
            		$etape_id.'?voyage_id='.$voyage_id.'&etape_name='.$etape_name
            	)
            );
		}
	}
}