<?php
App::uses('AppController', 'Controller');
/**
 * Hebergement Controller
 *
 */
class HebergementsController extends AppController {
	public function add($etape_id) {
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

	public function edit($id = null) {
		if (!$this->Hebergement->exists($id)) {
			throw new NotFoundException(__('Invalid hebergement'));
		}
		if ($this->request->is(array('post', 'put'))) {
			debug($this->data); 
			if ($this->Hebergement->save($this->request->data)) {
				$this->Session->setFlash(__('Vos modifications ont été sauvées'));
                $this->redirect(array('controller' => 'hebergements', 'action' => 'view', $this->request->data['Hebergement']['url']));
			}
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
			'order' => array('Hebergement.accepte DESC', 'count_hebergement DESC'),);
		
		$this->set('hebergements', $this->Hebergement->find('all', $options));
	}
}