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
				return $this->flash(__("Le transport a été sauvée."), array('action' => 'index'));
			}
		}
	}

	public function view($id) {
	// parameter: one etape id

		$options = array(
			'conditions' => array(
				'Activite.etape_id' => $id
			));
		
		return $this->Activite->find('all', $options);
	}
}