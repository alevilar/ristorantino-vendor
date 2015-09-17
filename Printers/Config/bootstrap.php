<?php

App::uses('ComandasEventListener', 'Printers.Event');
App::uses('MesasEventListener', 'Printers.Event');

App::uses('ClassRegistry', 'Utility');
App::uses('MtSites', 'MtSites.Utility');
App::uses('CakeEventManager', 'Event');


CakeEventManager::instance()->attach( new ComandasEventListener );
CakeEventManager::instance()->attach( new MesasEventListener );



define("RISTORANTINO_DEFAULT_IVA", 0.21);
define("PRINTERS_AFIP", 'Afip');
