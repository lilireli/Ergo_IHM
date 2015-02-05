<?php
App::uses('AppModel', 'Model');
/**
 * Hebergement Model
 *
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

	public $belongsTo = array(
        'Etape' => array(
            'className' => 'Etape',
            'foreignKey' => 'etape_id'
        ),
        'User' => array(
            'className' => 'User',
            'foreignKey' => 'createur_id'
        )
    );

    public $validate = array(
		'hebergement_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
			),
		),
		'hebergement_name' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Un nom d\'hébergement est requis.'
			),
		),
        'date_fin' => array(
            'compare' => array(
                'rule'	     => array('validate_date'),
                'message'    => 'La date de fin doit être après la date de début.',
                'allowEmpty' => true
            )
        ),
        'prix' => array(
        	'compare' => array(
                'rule'	     => array('valid_price'),
                'message'    => 'Le prix ne peut être négatif.',
                'allowEmpty' => true
            )
        )
	);

	public function validate_date() {
    	return $this->data[$this->alias]['date_fin'] > $this->data[$this->alias]['date_debut'];
	}	

	public function valid_price() {
		return $this->data[$this->alias]['prix'] > 0;
	}
}
