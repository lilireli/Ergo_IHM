<?php
App::uses('AppController', 'Controller');
/**
 * Etapes Controller
 *
 */
class ActivitesController extends AppController {
	public function add() {
		if ($this->request->is('post')) {
			$this->Activite->create();
			
			if ($this->Activite->save($this->request->data)) {
				// rediriger vers la page de l'étape
				$this->Session->setFlash(__("L'activité a été sauvée."));
				$this->redirect(array(
					'controller' => 'etapes', 
					'action' => 'index', 
					$this->request->data['Activite']['etape_id']
				));
			}
		}
	}

	public function view($id) {
	// parameter: one etape id
		$id = strtok($id, "?");
		$user_id= AuthComponent::user('user_id');

		$options = array(
			'conditions' => array(
				'Activite.etape_id' => $id
			),
			'joins' => array(
	 			array(
		 			'table' => 'votes',
		 			'alias' => 'Vote',
		 			'type' => 'left outer',
		 			'conditions' => array(
		 				'Activite.activite_id = Vote.type_id',
		 				'Vote.type_name = "activite"'
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
	 			'Activite.activite_id'
	 		),
	 		'fields' => array(
	 			'Activite.activite_id',
	 			'Activite.activite_name',
	 			'Activite.type',
	 			'Activite.date_debut',
	 			'Activite.date_fin',
	 			'Activite.createur_id',
	 			'Activite.lieu',
	 			'Activite.prix',
	 			'Activite.accepte',
	 			'count(Vote.type_id) AS count_activite',
	 			'count(Vote2.type_id) AS count_user'
			));
		
		$this->set('activites', $this->Activite->find('all', $options));
	}
}