<?php
App::uses('AppModel', 'Model');
/**
 * Voyage Model
 *
 * @property users_voyages $users_voyages
 */
class Voyage extends AppModel {

/**
 * Primary key field
 *
 * @var string
 */
	public $primaryKey = 'voyage_id';

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'voyage_name';

	public $foreignKey = 'createur_id';


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasAndBelongsToMany associations
 *
 * @var array
 */
	public $hasAndBelongsToMany = array(
		'User' => array(
			'className' => 'User',
			'joinTable' => 'users_voyages',
			'foreignKey' => 'voyage_id',
			'associationForeignKey' => 'user_id',
			'unique' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
		)
	);


	public $belongsTo = array(
        'User' => array(
            'className' => 'User',
            'foreignKey' => 'createur_id'
        )
    );
}
