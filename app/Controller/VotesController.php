<?php
App::uses('AppController', 'Controller');
/**
 * Etapes Controller
 *
 */
class VotesController extends AppController {
	public function add() {
		if ($this->request->is('post')) {
			$this->Vote->create();
			
			if ($this->Vote->save($this->request->data)) {
				// rediriger vers la page de l'étape
				$this->Session->setFlash(__("Le vote a été sauvé."));
				$this->redirect(array(
					'controller' => 'etapes', 
					'action' => 'index', 
					$this->request->data['Vote']['etape_id']
				));
			}
		}
	}
}