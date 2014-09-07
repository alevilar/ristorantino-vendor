<?php

Router::connect('/:tenant/account', array('plugin'=>'account', 'controller' => 'gastos', 'action'=>'index'));


