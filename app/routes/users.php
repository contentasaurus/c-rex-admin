<?php

namespace puffin;

$app->controller('users')
	->any('/users/no-access/', 'no_access')
	->get('/users', 'index')
	->get('/users/profile/{id:i}?', 'profile')
	->get('/users/create', 'create')
	->post('/users/create', 'do_create')
	->get('/users/update/{id:i}', 'update')
	->post('/users/update/{id:i}', 'do_update')
	->get('/users/disable/{id:i}', 'disable')
	->post('/users/disable/{id:i}', 'do_disable')
	->get('/users/enable/{id:i}', 'enable')
	->post('/users/enable/{id:i}', 'do_enable');
