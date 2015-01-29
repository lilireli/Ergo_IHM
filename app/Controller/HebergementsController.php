<?php
App::uses('AppController', 'Controller');
/**
 * Etapes Controller
 *
 */
class HebergementsController extends AppController {
	public function add() {
		if ($this->request->is('post')) {
			$this->Hebergement->create();
			
			if ($this->Hebergement->save($this->request->data)) {
				return $this->flash(__("Le transport a été sauvée."), array('action' => 'index'));
			}
		}
	}

	public function view($id) {
	// parameter: one voyage id

		$options = array(
			'conditions' => array(
				'Hebergement.etape_id' => $id
			));
		
		return $this->Hebergement->find('all', $options);
	}
}