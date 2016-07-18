<?php

namespace puffin;

$app->controller('components')
	->any('/components', 'index')
	->get('/components/create', 'create')
	->post('/components/create', 'do_create')
	->get('/components/update/{id:i}', 'update')
	->post('/components/update/{id:i}', 'do_update')
	->get('/components/delete/{id:i}', 'delete')
	->post('/components/delete/{id:i}', 'do_delete');
