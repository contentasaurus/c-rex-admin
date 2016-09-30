<?php

namespace puffin;

$app->controller('helpers')
	->any('/helpers', 'index')
	->get('/helpers/create', 'create')
	->post('/helpers/create', 'do_create')
	->get('/helpers/update/{id:i}', 'update')
	->post('/helpers/update/{id:i}', 'do_update')
	->get('/helpers/delete/{id:i}', 'delete')
	->post('/helpers/delete/{id:i}', 'do_delete');
