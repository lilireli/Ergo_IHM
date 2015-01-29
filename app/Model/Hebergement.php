<?php
App::uses('AppModel', 'Model');
/**
 * Voyage Model
 *
 * @property users_voyages $users_voyages
 */
class Hebergement extends AppModel {

/**
 * Primary key field
 *
 * @var string
 */
	public $primaryKey = 'hebergement_id';

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'hebergement_name';
}
