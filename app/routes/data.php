<?php

namespace puffin;

$app->controller('data')
	->any('/data', 'index')
	->get('/data/create', 'create')
	->post('/data/create', 'do_create')
	->get('/data/update/{id:i}', 'update')
	->post('/data/update/{id:i}', 'do_update')
	->get('/data/delete/{id:i}', 'delete')
	->post('/data/delete/{id:i}', 'do_delete');
