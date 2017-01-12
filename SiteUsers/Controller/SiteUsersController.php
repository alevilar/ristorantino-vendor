<?php

App::uses('UsersAppController', 'Users.Controller');


class SiteUsersController extends UsersAppController {


	public $uses = 'Users.User';



	public function beforeRender (){
		if ( !MtSites::isTenant() ) {
        	throw new ForbiddenException( __("El Tenant (sitio: $site) no es válido o no fue encontrado en el sistema"));
        }

		parent::beforeRender();
		$this->set('model', $this->modelClass);
	}


/**
 * Admin Index
 *
 * @return void
 */
	public function index() {
		if ($this->{$this->modelClass}->Behaviors->loaded('Searchable')) {
			$this->Prg->commonProcess();
			unset($this->{$this->modelClass}->validate['username']);
			unset($this->{$this->modelClass}->validate['email']);
			$this->{$this->modelClass}->data[$this->modelClass] = $this->passedArgs;
		}

		$this->passedArgs['site_alias'] = MtSites::getSiteName();

		if ($this->{$this->modelClass}->Behaviors->loaded('Searchable')) {
			$parsedConditions = $this->{$this->modelClass}->parseCriteria($this->passedArgs);
		} else {
			$parsedConditions = array();
		}

		$this->Paginator->settings[$this->modelClass] = array(
			'recursive' => 1,
		);


		$this->Paginator->settings[$this->modelClass]['conditions'] = $parsedConditions;
		$this->set('users', $this->Paginator->paginate());		
	}



/**
 * Admin add
 *
 * @return void
 */
	public function add() {		
        
        $site = $this->{$this->modelClass}->Site->findByAlias(MtSites::getSiteName() );
        $this->request->data['Site']['id'] = $site['Site']['id'];
		
		if ( $this->request->is('post') ) {	
            
			$this->request->data[$this->modelClass]['tos'] = true;
			$this->request->data[$this->modelClass]['email_verified'] = true;
			//save new user
			if ($this->{$this->modelClass}->add($this->request->data)) {
				$this->Session->setFlash(__d('users', 'The User has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__d('users', 'The User couldn`t be saved'), 'Risto.flash_error');
			}
		}
		$roles = $this->{$this->modelClass}->Rol->find('list');
		$this->set(compact( 'roles', 'site'));
	}



/**
 * Admin edit
 *
 * @param null $userId
 * @return void
 */
	public function edit($userId = null) {

		if ( $this->request->is('post')) {
			unset ( $this->request->data[$this->modelClass]['last_login'] );

			
			$this->{$this->modelClass}->bindModel(array(
		        'hasMany' => array(
		            'RolUser' => array(
		                'classname' => 'Users.RolUser',
		            ) 
		        ) 
		    ));

			$rolUser = array();
			debug($this->request->data);
			if (!empty($this->request->data['Rol']['Rol'])) {
			    foreach ($this->request->data['Rol']['Rol'] as $rolId )  {
			    	$rolUser[] = array(
			    		'rol_id' => $rolId,
			    		'user_id' => $userId,
			    		);
			    }

			}

			$this->{$this->modelClass}->RolUser->deleteAll(array('RolUser.user_id' => $userId ));

			if ( $this->{$this->modelClass}->RolUser->saveMany( $rolUser ) ) {
				$this->Session->setFlash(__d('users', 'User saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__d('users', 'Error saving'), 'Risto.flash_error');
			}
		}

		if (empty($this->request->data)) {
			$this->{$this->modelClass}->recursive = 1;
			$this->request->data = $this->{$this->modelClass}->read(null, $userId);
			unset($this->request->data[$this->modelClass]['password']);
		}

		$roles = $this->{$this->modelClass}->Rol->find('list');
		$this->set(compact( 'roles'));
		$this->render('admin_form');
	}

	
/**
 * Admin add
 *
 * @return void
 */
	public function delete_from_tenant ( $user_id ) {
		if ( $this->request->is('post') ) {
			$alias = MtSites::getSiteName();			
			if ( $this->{$this->modelClass}->dismissUserFromSite($alias, $user_id) ) {
				$this->Session->setFlash(__d('users','The user has ben dismissed from this site'));
			} else {
				$this->Session->setFlash(__d('users','Error saving user changes'), 'Risto.flash_error');
			}
		}

		$this->redirect(array('action'=>'index'));
	}


	
/**
 * Admin add
 *
 * @return void
 */
	public function add_existing() {		
		$siteAlias = MtSites::getSiteName();

        $site = $this->{$this->modelClass}->Site->findByAlias($siteAlias);
        $this->request->data['Site']['id'] = $site['Site']['id'];

		if ( $this->request->is('post') ) {	

			$wasFound = $this->{$this->modelClass}->find('first', array(
				'conditions' => array(
						$this->modelClass.'.username' => $this->request->data[$this->modelClass]['username'],
						$this->modelClass.'.email' => $this->request->data[$this->modelClass]['email']
					),
				'contain' => array(
						'Site' => array(
							'conditions' => array(
								'Site.id' => $this->request->data['Site']['id'],
								)
							) 
					),
				));
			
			if ( !empty( $wasFound['Site']) ) {
				$this->Session->setFlash(__d('users', 'The User %s is already in this site', $this->request->data[$this->modelClass]['username']), 'Risto.Flash/flash_warning');
			} elseif ( $wasFound ) {
				// assign user Rol & Site

				$user_id = $wasFound['User']['id'];

				if (!empty($this->request->data['Rol']['Rol'][0])) {
					$rol_id = $this->request->data['Rol']['Rol'][0];

					$this->{$this->modelClass}->hasAndBelongsToMany['Rol']['unique'] = false;
					if ( $this->{$this->modelClass}->addRoleIntoSite($rol_id, $user_id) ) {
						$site_id = $this->request->data['Site']['id'];

						if ( $this->{$this->modelClass}->addIntoSite($site_id, $user_id) ) {
							$this->Session->setFlash(__d('users', 'The User %s has been assigned to your site', $wasFound[$this->modelClass]['username']));
							MtSites::loadSessionData();
							$this->redirect(array('action' => 'index'));
						} else {
							$this->Session->setFlash(__d('users', 'Error saving Site to user to %s', $this->request->data[$this->modelClass]['username']), 'Risto.flash_error');
						}

					} else {
						$this->Session->setFlash(__d('users', 'Error saving Role to %s', $this->request->data[$this->modelClass]['username']), 'Risto.flash_error');
					}
				}
				
			} else{
				debug($wasFound);
				$this->Session->setFlash(__d('users', 'The User %s was not found', $this->request->data[$this->modelClass]['username']), 'Risto.flash_error');
			}
		}
		$roles = $this->{$this->modelClass}->Rol->find('list');
		$this->set('site', $site);
		$this->set(compact( 'roles'));
	}




/**
 * Admin admin_edit_assign_other_site
 *
 * @param null $userId
 * @return void
 */
	public function assign_other_site($userId = null) {

		if ( $this->request->is('post') ) {
			$sites = $this->request->data['Site'];
			$this->request->data = $this->{$this->modelClass}->read(null, $userId);
			$this->{$this->modelClass}->hasAndBelongsToMany['Site']['unique'] = true;
			$this->request->data['Site'] = $sites;
			if ( $this->{$this->modelClass}->save( $this->request->data) ) {
				MtSites::loadSessionData();
				$this->Session->setFlash(__d('users', 'User saved'));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__d('users', 'User Couldn´t be Saved'), 'Risto.flash_error');
			}
		}

		$this->{$this->modelClass}->recursive = 1;
		$this->request->data = $this->{$this->modelClass}->read(null, $userId);
		$currLogUser = $this->Auth->user();
		$sites = $currLogUser['Site'];
		$sites = Hash::combine($sites, '{n}.id', '{n}.name');
		$this->set(compact( 'sites'));
	}

	
}