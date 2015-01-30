<?php
App::uses('AppController', 'Controller');
/**
 * Etapes Controller
 *
 */
class EtapesController extends AppController {
	public function index($id) {
		$this->set('etape', $id);
	}

	public function add() {
		if ($this->request->is('post')) {
			$this->Etape->create();
			
			if ($this->Etape->save($this->request->data)) {
				$this->Session->setFlash(__("L'étape a été sauvée."));
				$this->redirect(array(
					'controller' => 'voyages',
                	'action' => 'view', 
                	$this->request->data['Etape']['voyage_id']));
			}
		}
	}

	public function view($id) {
	// parameter: one voyage id

		$options = array(
			'conditions' => array(
				'Etape.voyage_id' => $id
			));
		
		return $this->Etape->find('all', $options);
	}
}