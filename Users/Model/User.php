<?php
App::uses('UsersAppModel', 'Users.Model');
App::uses('MtSites', 'MtSites.Utility');


/**
 * User Model
 *
 * @property Rol $Rol
 * @property Cliente $Cliente
 * @property Egreso $Egreso
 * @property Mozo $Mozo
 */
class User extends UsersAppModel {
/**
 * Display field
 *
 * @var string
 */
    public $displayField = 'username';



    public $hasAndBelongsToMany = array("MtSites.Site");

 /**
 * Act As Behaviour
 *
 * @var array
 */       
   // public $actsAs = array('Acl' => array('type' => 'requester'));
    


    /**
     * Filter search fields
     *
     * @var array
     * @access public
     */

    public $filterArgs = array(
            'txt_buscar' => array(
                'type' => 'query',
                'method' => '__searchTextGeneric'
                ),
            'site_alias' => array(
                'type' => 'query',
                'method' => '__searchFromSite',
                'field' => 'User.id',
                ),
            );


        
        
/**
 * Validation rules
 *
 * @var array
 */
    public $validate = array(
        'username' => array(
            'notempty' => array(
                'rule' => array(
                    'notempty',
                    ),
                //'message' => 'Your custom message here',
                //'allowEmpty' => false,
                //'required' => false,
                //'last' => false, // Stop validation after this rule
                //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
            'isUnique' => array(
                'rule' => array(
                    'isUnique',
                    ),
                'message' => 'Alguien tiene este nombre de usuario y no se puede repetir',
                //'allowEmpty' => false,
                //'required' => false,
                //'last' => false, // Stop validation after this rule
                //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'password' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                //'message' => 'Your custom message here',
                //'allowEmpty' => false,
                //'required' => false,
                //'last' => false, // Stop validation after this rule
                //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
                        'comparePassword' => array(
                            'rule' => array('comparePassword'),
                            'message' => 'No coinciden las contraseñas',
                        )
        ),
        'rol_id' => array(
            'numeric' => array(
                'rule' => array('numeric'),
                //'message' => 'Your custom message here',
                //'allowEmpty' => false,
                //'required' => false,
                //'last' => false, // Stop validation after this rule
                //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
    );

    //The Associations below have been created with all possible keys, those that are not needed can be removed

    public function __construct($id = false, $table = null, $ds = null) {
        if ( MtSites::getSiteName() ) {
            $this->hasAndBelongsToMany[] = 'Users.Rol';   
        }

        return parent::__construct($id, $table, $ds);
    }

               
        
        public function comparePassword($coso) {          
            if ( !empty($this->data['User']['password']) && !empty( $this->data['User']['password_check'] )  ) {
                $pass1 = AuthComponent::password($this->data['User']['password']);
                $pass2 = AuthComponent::password( $this->data['User']['password_check'] );
                
                if ($pass1 != $pass2){
                    return false;
                }
            }
            return true;
        }

        public function beforeSave($options = array()) {

            if ( !empty($this->data['User']['password']) ) {
                $this->data['User']['password'] = AuthComponent::password($this->data['User']['password']);
            }

            return parent::beforeSave($options);
        }
        
     
        
        
        function parentNode() {
            if (!$this->id && empty($this->data)) {
                return null;
            }
            $data = $this->data;
            if (empty($this->data)) {
                $data = $this->read();
            }
            if (!$data['User']['rol_id']) {
                return null;
            } else {
                return array('Rol' => array('id' => $data['User']['rol_id']));
            }
        }




    public function __searchTextGeneric ($data = array() ) {          
            $condition = array(
                'OR' => array(
                    'lower(User.username) LIKE' => '%'. trim(strtolower( $data['txt_buscar'] )) .'%',
                    'lower(User.nombre) LIKE'   => '%'. trim(strtolower( $data['txt_buscar'] )) .'%',
                    'lower(User.apellido) LIKE' => '%'. trim(strtolower( $data['txt_buscar'] )) .'%',
            ));
            return $condition;
    }


    public function __searchFromSite ($data = array() ) {
        $sites = $this->Site->find('all', array('conditions'=>array(
                    'Site.alias' => $data['site_alias']
                    ),
        ));
        $users = Hash::extract($sites, '{n}.User.{n}.id');

        return $users;
    }
    
}