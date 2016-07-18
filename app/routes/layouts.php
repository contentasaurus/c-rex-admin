<?php

namespace puffin;

$app->controller('layouts')
	->any('/layouts', 'index')
	->get('/layouts/create', 'create')
	->post('/layouts/create', 'do_create')
	->get('/layouts/update/{id:i}', 'update')
	->post('/layouts/update/{id:i}', 'do_update')
	->get('/layouts/update/{id:i}/scripts', 'scripts')
	->post('/layouts/update/{id:i}/scripts', 'do_scripts')
	->get('/layouts/delete/{id:i}', 'delete')
	->post('/layouts/delete/{id:i}', 'do_delete');
