<?php
App::uses('AppModel', 'Model');
/**
 * Voyage Model
 *
 * @property users_voyages $users_voyages
 */
class Etape extends AppModel {

/**
 * Primary key field
 *
 * @var string
 */
	public $primaryKey = 'etape_id';

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'etape_name';
}
