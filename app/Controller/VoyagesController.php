<?php
App::uses('AppController', 'Controller');
/**
 * Voyages Controller
 *
 * @property Voyage $Voyage
 * @property PaginatorComponent $Paginator
 */
class VoyagesController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

/**
 * index method
 *
 * @return void
 */
	public function index($id) {
		// lister uniquement les voyages d'une personne
		$this->Voyage->recursive = 0;

 		// equivalent SQL simple
 		// SELECT *
 		// FROM voyages AS v
 		//		INNER JOIN users_voyages AS uv ON v.voyage_id = uv.voyage_id
		// WHERE users_voyages.user_id = $user_id;

	 	$options = array('joins' => array(
	 		array(
	 			'table' => 'users_voyages',
	 			'alias' => 'UserVoyage',
	 			'type' => 'inner',
	 			'foreignKey' => false,
	 			'conditions' => array(
	 				'UserVoyage.voyage_id = Voyage.voyage_id',
	 				'UserVoyage.user_id = '.$id)
	 		)));

	 	$this->set('voyages', $this->Voyage->find('all', $options));
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Voyage->exists($id)) {
			throw new NotFoundException(__('Invalid voyage'));
		}
		$options = array('conditions' => array('Voyage.' . $this->Voyage->primaryKey => $id));
		$this->set('voyage', $this->Voyage->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Voyage->create();
			
			if ($this->Voyage->save($this->request->data)) {
				return $this->flash(__('The voyage has been saved.'), array('action' => 'index'));
			}
		}

		$users = $this->Voyage->User->find('list');
		$this->set(compact('users'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Voyage->exists($id)) {
			throw new NotFoundException(__('Invalid voyage'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Voyage->save($this->request->data)) {
				return $this->flash(__('The voyage has been saved.'), array('action' => 'index'));
			}
		} else {
			$options = array('conditions' => array('Voyage.' . $this->Voyage->primaryKey => $id));
			$this->request->data = $this->Voyage->find('first', $options);
		}
		$users = $this->Voyage->UsersVoyage->find('list');
		$this->set(compact('users'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Voyage->id = $id;
		if (!$this->Voyage->exists()) {
			throw new NotFoundException(__('Invalid voyage'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Voyage->delete()) {
			return $this->flash(__('The voyage has been deleted.'), array('action' => 'index'));
		} else {
			return $this->flash(__('The voyage could not be deleted. Please, try again.'), array('action' => 'index'));
		}
	}

}
