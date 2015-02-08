<?php
/**
 * GroupTrotteur: Heureux qui comme Ulysse a fait un beau voyage
 *
 * @author        A. Chardon, A. El Bachiri, J. Pieyre, A. Suzanne
 * @package       app.Model.Transport
 */
App::uses('AppModel', 'Model');
/**
 * Transport Model
 *
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

/**
 * BelongsTo associations
 *
 * @var array
 */
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

/**
 * Validation rules
 *
 * @var array
 */
    public $validate = array(
        'transport_id' => array(
            'numeric' => array(
                'rule' => array('numeric'),
            ),
        ),
        'lieu_depart' => array(
            'notEmpty' => array(
                'rule' => array('notEmpty'),
                'message' => 'Un lieu de départ est requis.'
            ),
        ),
        'lieu_arrivee' => array(
            'notEmpty' => array(
                'rule' => array('notEmpty'),
                'message' => 'Un lieu d\'arrivée est requis.'
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

    // fonctions de validation
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
