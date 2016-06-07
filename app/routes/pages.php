<?php

namespace puffin;

$app->controller('pages')
	->any('/pages', 'index')
	->get('/pages/create', 'create')
	->post('/pages/create', 'do_create')
	->get('/pages/update/{id:i}', 'update')
	->post('/pages/update/{id:i}', 'do_update')
	->get('/pages/delete/{id:i}', 'delete')
	->post('/pages/delete/{id:i}', 'do_delete');
