<?php
App::uses('AppModel', 'Model');
/**
 * Voyage Model
 *
 * @property users_voyages $users_voyages
 */
class Activite extends AppModel {

/**
 * Primary key field
 *
 * @var string
 */
	public $primaryKey = 'activite_id';

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'activite_name';
}
