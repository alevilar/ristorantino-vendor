<?php



Router::connect('/:tenant/mesas', array('plugin'=>'mesa', 'action' => 'index', 'controller' => 'mesas'));
Router::connect('/:tenant/mesas/:action/*', array('plugin'=>'mesa', 'controller' => 'mesas'));

Router::connect('/:tenant/mozos', array('plugin'=>'mesa', 'action' => 'index', 'controller' => 'mozos'));
Router::connect('/:tenant/mozos/:action/*', array('plugin'=>'mesa', 'controller' => 'mozos'));

Router::connect('/:tenant/pagos', array('plugin'=>'mesa', 'action' => 'index', 'controller' => 'pagos'));
Router::connect('/:tenant/pagos/:action/*', array('plugin'=>'mesa', 'controller' => 'pagos'));
