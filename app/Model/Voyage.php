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

/**
 * BelongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
        'User' => array(
            'className' => 'User',
            'foreignKey' => 'createur_id'
        )
    );

/**
 * Validation rules
 *
 * @var array
 */
    public $validate = array(
		'voyage_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
			),
		),
		'voyage_name' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Un nom de voyage est requis.'
			),
		),
        'date_debut' => array(
        	'compare' => array(
                'rule'	     => array('after_today'),
                'message'    => 'La date de début ne doit pas être passée.',
                'allowEmpty' => false
            )
        ),
        'date_fin' => array(
            'compare' => array(
                'rule'	     => array('validate_date'),
                'message'    => 'La date de fin doit être après la date de début.',
                'allowEmpty' => false
            )
        )
	);

    // fonctions de validation
    public function after_today() {
    	$today = date('Y-m-d H:i:s');
    	return $this->data[$this->alias]['date_debut'] > $today;
    }

	public function validate_date() {
    	return $this->data[$this->alias]['date_fin'] > $this->data[$this->alias]['date_debut'];
	}	
}
