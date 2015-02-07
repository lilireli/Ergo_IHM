<?php
App::uses('AppController', 'Controller');
/**
 * Etapes Controller
 *
 */
class VotesController extends AppController {
	public function to_url($url_static){
		$url = str_replace('%3F', '?', $url_static);
		$url = str_replace('%3D', '=', $url);
		$url = str_replace('%26', '&', $url);

		$url_parts = split('/', $url);
		$i = 0;
		$options = array();

		// couper l'url pour la renvoyer correctement
		foreach ($url_parts as $url_part):
			if ($i == 0){
				$options['controller'] = $url_part;
			}
			else if ($i == 1){
				$options['action'] = $url_part;
			}
			else {
				array_push($options, $url_part);
			}
			
			$i += 1;
		endforeach; 

		return $options;
	}

	public function url_decode($url_static){
		$url = str_replace('_1_', '/', $url_static);
		$url = str_replace('_2_', '?', $url);
		$url = str_replace('_3_', '=', $url);
		$url = str_replace('_4_', '&', $url);

		return $url;
	}

	public function add() {
		if ($this->request->is('post')) {
			$this->Vote->create();
			
			if ($this->Vote->save($this->request->data)) {
				// rediriger vers la page de l'étape
				$this->Session->setFlash(__("Le vote a été sauvé."));

				$options = $this->to_url($this->request->data['Vote']['url']);
				$this->redirect($options);
			}
		}
	}

	public function delete($user_id, $type_name, $type_id, $url) {
		debug($url);
		$url = $this->url_decode($url);

		$options = array(
			'conditions' => array(
				'Vote.user_id' => $user_id,
				'Vote.type_name'=> $type_name,
				'Vote.type_id' => $type_id
			)
		);

	 	$vote = $this->Vote->find('first', $options);

		$this->Vote->id = $vote['Vote']['vote_id'];

		
		if ($this->Vote->delete()) {
			$options = $this->to_url($url);
			$this->redirect($options);
		} else {
			$this->Session->setFlash(__('Erreur durant la suppression, veuillez réessayer'));
            $options = $this->to_url($url);
			$this->redirect($options);
		}
	}
}