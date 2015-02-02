<?php
App::uses('AppController', 'Controller');
App::uses('AuthComponent', 'Controller/Component');
/**
 * Users Controller
 *
 * @property User $User
 * @property PaginatorComponent $Paginator
 */
class UsersController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array(
		'Paginator', 
		'Auth' => array(
			'authenticate' => array(
				'Form' => array(
					'fields' => array('username' => 'user_name', 'password'),
					'passwordHasher' => array(
						'className' => 'Simple',
						'hashType' => 'sha256'
					)
				)
			)
		)
	);

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$id = AuthComponent::user('user_id');
		$this->User->recursive = 0;

		$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
	 	$this->set('user', $this->User->find('first', $options));
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
		$this->set('user', $this->User->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->User->create();
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('Vous êtes maintenant enregistré, veuillez vous connecter pour continuer'));
                $this->redirect(array('controller' => 'pages', 'action' => 'display', 'home'));
			}
		}
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('Vos modifications ont été sauvées'));
                $this->redirect(array('action' => 'index'));
			}
		} else {
			$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
			$this->request->data = $this->User->find('first', $options);
		}
	}

/**
 * edit password method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit_pw($id = null) {
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('Votre nouveau mot de passe a été sauvé'));
                $this->redirect(array('action' => 'index'));
			}
		} else {
			$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
			$this->request->data = $this->User->find('first', $options);
		}
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}

		$this->request->allowMethod('post', 'delete');
		if ($this->User->delete()) {
			$this->logout();
		} else {
			$this->Session->setFlash(__('Erreur durant la suppression, veuillez réessayer'));
            $this->redirect(array('action' => 'index'));
		}
	}

/**
 * login method
 *
 * @return void
 */
	public function login() {
	   
	   //if already logged-in, redirect
        if($this->Session->check('Auth.User')){
            $this->redirect(array('action' => 'index'));      
        }
         
        // if we get the post information, try to authenticate
        if ($this->request->is('post')) {

            if ($this->Auth->login()) {
                $this->Session->setFlash(__('Bienvenue, '. $this->Auth->user('user_name')));
                $this->redirect(array('controller' => 'pages', 'action' => 'display', 'index'));
            } else {
                $this->Session->setFlash(__('Invalid username or password'));
            }
        }
    }

/**
 * logout method
 *
 * @return confirmation
 */
	public function logout() {
    	return $this->redirect($this->Auth->logout());
	}

/**
 * beforeFilter
 */
	public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('add', 'logout'); 
    }


    public function get_users($id) {
    // id est l'id du voyage
    	$options = array('conditions' => array(
	 		'User.user_id NOT IN (SELECT user_id FROM users_voyages WHERE voyage_id = '.$id.')'));

	 	return $this->User->find('all', $options);
	}

}