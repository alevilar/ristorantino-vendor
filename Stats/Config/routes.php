<?php

Router::connect('/:tenant/stats', array('plugin' => 'stats', 'controller' => 'stats', 'action' => 'mesas_total'));
Router::connect('/:tenant/stats/:action', array('plugin'=>'stats', 'controller' => 'stats'));
Router::connect('/:tenant/stats/:action/*', array('plugin' => 'stats', 'controller' => 'stats'));

