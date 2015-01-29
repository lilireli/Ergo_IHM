<?php
App::uses('AppController', 'Controller');
/**
 * Etapes Controller
 *
 */
class TransportsController extends AppController {
	public function add() {
		if ($this->request->is('post')) {
			$this->Transport->create();
			
			if ($this->Transport->save($this->request->data)) {
				return $this->flash(__("Le transport a été sauvée."), array('action' => 'index'));
			}
		}
	}

	public function view($id) {
	// parameter: one etape id

		$options = array(
			'conditions' => array(
				'Transport.etape_id' => $id
			));
		
		return $this->Transport->find('all', $options);
	}
}