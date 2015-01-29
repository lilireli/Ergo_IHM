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
				return $this->flash(__("L'étape a été sauvée."), array('action' => 'index'));
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