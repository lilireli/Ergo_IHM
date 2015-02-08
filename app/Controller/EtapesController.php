<?php
/**
 * GroupTrotteur: Heureux qui comme Ulysse a fait un beau voyage
 *
 * @author   	  A. Chardon, A. El Bachiri, J. Pieyre, A. Suzanne
 */
App::uses('AppController', 'Controller');
/**
 * Etapes Controller
 *
 * @property Etape $Etape
 */
class EtapesController extends AppController {
/**
 * index method
 *
 * @param string $id
 * @return void
 */
	public function index($id) {
		$options = array('conditions' => array('Etape.' . $this->Etape->primaryKey => $id));
	 	$this->set('etape', $this->Etape->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Etape->create();
			
			if ($this->Etape->save($this->request->data)) {
				$this->Session->setFlash(__("L'étape a été sauvée."));
				$this->redirect(array(
					'controller' => 'voyages',
					'action' => 'view', 
                	$this->request->data['Etape']['voyage_id']
                ));
			}
		}
	}

/**
 * view method
 *
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		// l'id est une url, on cherche à retrouver le bon id en enlevant les paramètres
		$id = strtok(basename($id), '?');
		$id = strtok(basename($id), '%3F');
		
		if (!$this->Etape->exists($id)) {
			throw new NotFoundException(__('Invalid etape'));
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
		else {
			$options = array('conditions' => array('Etape.' . $this->Etape->primaryKey => $id));
			$this->request->data = $this->Etape->find('first', $options);
		}
	}

/**
 * view method
 *
 * @param string $id
 * @return array
 */
	public function view($id) {
	// parameter: one voyage id

		$options = array(
			'conditions' => array(
				'Etape.voyage_id' => $id
			),
			'order' => array(
				'Etape.date_debut ASC'
			));
		
		return $this->Etape->find('all', $options);
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id, string voyage_id
 * @return void
 */
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