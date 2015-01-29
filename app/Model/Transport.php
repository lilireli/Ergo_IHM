<?php
App::uses('AppModel', 'Model');
/**
 * Voyage Model
 *
 * @property users_voyages $users_voyages
 */
class Transport extends AppModel {

/**
 * Primary key field
 *
 * @var string
 */
	public $primaryKey = 'transport_id';

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'transport_name';
}
