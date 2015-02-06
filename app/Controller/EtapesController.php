<?php
App::uses('AppController', 'Controller');
/**
 * Etapes Controller
 *
 */
class EtapesController extends AppController {
	public function index($id) {
		$options = array('conditions' => array('Etape.' . $this->Etape->primaryKey => $id));
	 	$this->set('etape', $this->Etape->find('first', $options));
	}

	public function add() {
		if ($this->request->is('post')) {
			$this->Etape->create();
			
			if ($this->Etape->save($this->request->data)) {
				$this->Session->setFlash(__("L'étape a été sauvée."));
				$this->redirect(array(
					'action' => 'index', 
                	$this->request->data['Etape']['etape_id'].
                		$this->request->data['Etape']['url'].
                		'&etape_name='.$this->request->data['Etape']['etape_name']
                ));
			}
		}
	}

	public function edit($id = null) {
		$id = strtok(basename($id), '%3F');
		
		if (!$this->Etape->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Etape->save($this->request->data)) {
				$this->Session->setFlash(__('Vos modifications ont été sauvées'));
                $this->redirect(array(
					'action' => 'index', 
                	$id.$this->request->data['Etape']['url'].
                		'&etape_name='.$this->request->data['Etape']['etape_name']
                ));
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


	public function delete($id, $voyage_id) {
		$this->Etape->id = $id;

		$this->request->allowMethod('post', 'delete');
		if ($this->Etape->delete()) {
			$this->Session->setFlash(__('Etape supprimée'));
            $this->redirect(array(
            	'controller'=>'voyages', 
            	'action' => 'view',
            	$voyage_id));
		} else {
			$this->Session->setFlash(__('Erreur durant la suppression, veuillez réessayer'));
            $this->redirect(array(
            	'controller'=>'voyages', 
            	'action' => 'view',
            	$voyage_id));
		}
	}
}