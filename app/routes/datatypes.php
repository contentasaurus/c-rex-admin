<?php

namespace puffin;

$app->controller('datatypes')
	->any('/datatypes', 'index')
	->get('/datatypes/create', 'create')
	->post('/datatypes/create', 'do_create')
	->get('/datatypes/update/{id:i}', 'update')
	->post('/datatypes/update/{id:i}', 'do_update')
	->get('/datatypes/delete/{id:i}', 'delete')
	->post('/datatypes/delete/{id:i}', 'do_delete');
