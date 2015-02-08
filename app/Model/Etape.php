<?php
/**
 * GroupTrotteur: Heureux qui comme Ulysse a fait un beau voyage
 *
 * @author        A. Chardon, A. El Bachiri, J. Pieyre, A. Suzanne
 * @package       app.Model.Etape
 */
App::uses('AppModel', 'Model');
/**
 * Etape Model
 *
 *
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

/**
 * BelongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
        'Voyage' => array(
            'className' => 'Voyage',
            'foreignKey' => 'voyage_id'
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
		'etape_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
			),
		),
		'etape_name' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Un nom d\'étape est requis.'
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
