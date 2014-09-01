<?php

App::uses('ComandasEventListener', 'Printers.Event');
App::uses('ClassRegistry', 'Utility');


ClassRegistry::init('Comanda.Comanda')->getEventManager()->attach( new ComandasEventListener );
