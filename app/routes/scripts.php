<?php

namespace puffin;

$app->controller('scripts')
	->get('/scripts/create', 'create')
	->post('/scripts/create', 'do_create')
	->get('/scripts/update/{id:i}', 'update')
	->post('/scripts/update/{id:i}', 'do_update')
	->get('/scripts/delete/{id:i}', 'delete')
	->post('/scripts/delete/{id:i}', 'do_delete');
