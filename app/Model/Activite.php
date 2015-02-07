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
        'activite_id' => array(
            'numeric' => array(
                'rule' => array('numeric'),
            ),
        ),
        'activite_name' => array(
            'notEmpty' => array(
                'rule' => array('notEmpty'),
                'message' => 'Un nom d\'activité est requis.'
            ),
        ),
        'date_debut' => array(
            'compare' => array(
                'rule'       => array('after_today'),
                'message'    => 'La date de début ne doit pas être passée.',
                'allowEmpty' => false
            )
        ),
        'date_fin' => array(
            'compare' => array(
                'rule'       => array('validate_date'),
                'message'    => 'La date de fin doit être après la date de début.',
                'allowEmpty' => false
            )
        ),
        'prix' => array(
            'compare' => array(
                'rule'       => array('valid_price'),
                'message'    => 'Le prix ne peut être négatif.',
                'allowEmpty' => true
            )
        )
    );

    public function after_today() {
        $today = date('Y-m-d H:i:s');
        return $this->data[$this->alias]['date_debut'] > $today;
    }

    public function validate_date() {
        return $this->data[$this->alias]['date_fin'] >= $this->data[$this->alias]['date_debut'];
    }   

    public function valid_price() {
        return $this->data[$this->alias]['prix'] > 0;
    }
}
