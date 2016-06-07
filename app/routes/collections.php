<?php

namespace puffin;

$app->controller('collections')
	->any('/collections', 'index')
	->get('/collections/create', 'create')
	->post('/collections/create', 'do_create')
	->get('/collections/update/{id:i}', 'update')
	->post('/collections/update/{id:i}', 'do_update')
	->get('/collections/delete/{id:i}', 'delete')
	->post('/collections/delete/{id:i}', 'do_delete');
