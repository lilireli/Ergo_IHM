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

	public $belongsTo = array(
        'Etape' => array(
            'className' => 'Etape',
            'foreignKey' => 'etape_debut'
        ),
        'Etape' => array(
            'className' => 'Etape',
            'foreignKey' => 'etape_fin'
        ),
        'User' => array(
            'className' => 'User',
            'foreignKey' => 'createur_id'
        )
    );
}
