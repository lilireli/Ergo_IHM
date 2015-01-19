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
	public function index() {
		$this->Voyage->recursive = 0;
		$this->set('voyages', $this->Paginator->paginate());
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
		$usersVoyages = $this->Voyage->User->find('list');
		$this->set(compact('usersVoyages'));
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
		$usersVoyages = $this->Voyage->UsersVoyage->find('list');
		$this->set(compact('usersVoyages'));
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
