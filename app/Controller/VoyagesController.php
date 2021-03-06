<?php
/**
 * GroupTrotteur: Heureux qui comme Ulysse a fait un beau voyage
 *
 * @author   	  A. Chardon, A. El Bachiri, J. Pieyre, A. Suzanne
 */
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
		// lister uniquement les voyages d'une personne
		$id = AuthComponent::user('user_id');
		$this->Voyage->recursive = 0;

 		// equivalent SQL simple
 		// SELECT *
 		// FROM voyages AS v
 		//      LEFT OUTER JOIN users ...
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
	 				'UserVoyage.user_id = '.$id
	 			),
	 			'order' => array(
					'Voyage.date_debut DESC'
				)
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
				$this->Session->setFlash(__('Le voyage a été sauvé'));
                $this->redirect(array('action' => 'index'));
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
				$this->Session->setFlash(__('Le voyage a été sauvé'));
                $this->redirect(array('action' => 'view', $id));
			}
		} else {
			$options = array('conditions' => array('Voyage.' . $this->Voyage->primaryKey => $id));
			$this->request->data = $this->Voyage->find('first', $options);
		}
		$users = $this->Voyage->User->find('list');
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
			$this->Session->setFlash(__('Le voyage a été supprimé'));
                $this->redirect(array('action' => 'index'));
		} else {
			$this->Session->setFlash(__('Le voyage n\'a pas pu être supprimé'));
            $this->redirect(array('action' => 'index'));
		}
	}

/**
 * participants method
 *
 * @param string $id
 * @return array
 */
	public function participants($id = null) {
		// Lister les participants d'un voyage

		$options = array(
			'joins' => array(
				array(
		 			'table' => 'users_voyages',
		 			'alias' => 'UserVoyage',
		 			'type' => 'inner',
		 			'foreignKey' => false,
		 			'conditions' => array(
		 				'UserVoyage.voyage_id = Voyage.voyage_id',
		 				'UserVoyage.voyage_id = '.$id
	 				)
	 			),
		 		array(
		 			'table' => 'users',
		 			'alias' => 'User2',
		 			'type' => 'inner',
		 			'foreignKey' => false,
		 			'conditions' => array(
		 				'UserVoyage.user_id = User2.user_id'
		 			)
		 		)
	 		),
	 		'fields'=> array(
	 			'User2.user_name',
	 			'User2.user_id'
	 		));

	 	return $this->Voyage->find('all', $options);
	}

/**
 * add_participant method
 *
 * @return void
 */
	public function add_participants() {
		if ($this->request->is('post')) {
			$this->Voyage->create();

			if ($this->Voyage->save($this->request->data)) {
				$this->Session->setFlash(__('Les participants ont été ajoutés'));
                $this->redirect(array(
                	'action' => 'view', 
                	$this->request->data['Voyage']['voyage_id']));
			}
		}

		$users = $this->Voyage->find('list');
		$this->set(compact('users'));
	}

/**
 * delete_participant method
 *
 * @throws NotFoundException
 * @param string $voyage_id, $user_id
 * @return void
 */
	public function delete_participant($voyage_id, $user_id) {
		if(empty($voyage_id) || empty($user_id)){
			throw new NotFoundException(__('Invalid voyage and user'));
		} 

	    $delete = $this->Voyage->UsersVoyage->deleteAll(array(
	        'UsersVoyage.voyage_id' => $voyage_id, 
	        'UsersVoyage.user_id' => $user_id
	    ));

	    if ($delete) {
    		$this->Session->setFlash(__('Le participant a été supprimé'));
            $this->redirect(array('action' => 'view', $voyage_id));
		} else {
			$this->Session->setFlash(__('le participant n\'a pas pu être supprimé'));
            $this->redirect(array('action' => 'index', $voyage_id));
		}
	}

}
