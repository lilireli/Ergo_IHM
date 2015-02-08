<?php
/**
 * GroupTrotteur: Heureux qui comme Ulysse a fait un beau voyage
 *
 * @author   	  A. Chardon, A. El Bachiri, J. Pieyre, A. Suzanne
 * @package       app.Model.User
 */

App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');

/**
 * User Model
 *
 */
class User extends AppModel {

/**
 * Primary key field
 *
 * @var string
 */
	public $primaryKey = 'user_id';

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'user_name';

/**
 * Validation rules
 *
 * @var array
 */
	// règles de validation afin de pouvoir ajouter/modifier les données
	// la plupart des champs n'ont pas le droit d'être vides
	public $validate = array(
		'user_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
			),
		),
		'user_name' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Un nom d\'utilisateur est requis.'
			),
            'between' => array( // l'username doit avoir plus de 2 caractères
                'rule'    => array('lengthBetween', 3, 20),
                'message' => 'Le nom d\'utilisateur doit comprendre entre 3 et 20 caractères.'
            )
		),
        'mail' => array(
        	'notEmpty' => array(
        		'rule' => array('notEmpty'),
        		'message' => 'Un e-mail est requis.'
        	), 
        	'email' => array( // l'email doit être de la forme xxx@xx.xx
        		'rule' => '/^[A-Za-z0-9._%+-]+@([A-Za-z0-9-]+\.)+([A-Za-z0-9]{2,4}|museum)$/',
        		'message' => 'L\'adresse e-mail n\'est pas valide.'
        	)
        ),
        'new_password' => array(
            'notEmpty' => array(
                'rule' => array('notEmpty'),
                'message' => 'Un mot de passe est requis.'
            ),
            'alphaNumeric' => array( // le mot de passe ne peu comporter que des lettres et des chiffres
                'rule' => 'alphaNumeric',
                'message' => 'Veuillez ne rentrer que des lettres et des chiffres.'
            ),
            'between' => array( // le mot de passe ne doit être ni trop long ni trop court
                'rule'    => array('lengthBetween', 5, 15),
                'message' => 'Le mot de passe doit comprendre entre 5 et 15 caractères.'
            )
        ),
        're_password' => array(
            'notEmpty' => array(
                'rule' => array('notEmpty'),
                'message' => 'Un mot de passe est requis.'
            ),
            'compare'    => array(
                'rule'      => array('validate_passwords'),
                'message'   => 'Les mots de passe doivent être les mêmes.',
                'allowEmpty' => true
            )
        ),
        'old_password' => array(
            'notEmpty' => array(
                'rule' => array('notEmpty'),
                'message' => 'Un mot de passe est requis.'
            ),
            'compare'    => array(
                'rule'      => array('check_old_password'),
                'message'   => 'Ancien mot de passe incorrect.',
                'allowEmpty' => true
            )
        )
	);

    // fonctions de validation
	public function validate_passwords() {
    	return $this->data[$this->alias]['new_password'] == $this->data[$this->alias]['re_password'];
	}	

    public function check_old_password() {
        $db_pw = $this->data[$this->alias]['password'];

        $passwordHasher = new SimplePasswordHasher(array('hashType' => 'sha256'));            
        $old_pw = $passwordHasher->hash($this->data[$this->alias]['old_password']);

        return $old_pw == $db_pw;
    }

/**
 * Before Save
 * @param array $options
 * @return boolean
 */
	// avant de sauvegarder encrypter le mot de passe par mesure de sécurité
    public function beforeSave($options = array()) {
        // le champ new password existe, on le hash avant de le sauver (on veut le changer)
        if (!empty($this->data[$this->alias]['new_password'])) {
            $passwordHasher = new SimplePasswordHasher(array('hashType' => 'sha256'));
            $this->data[$this->alias]['password'] = $passwordHasher->hash(
                $this->data[$this->alias]['new_password']
            );
        }
        return true;
    }
}
