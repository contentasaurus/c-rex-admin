<?php

namespace puffin;

$app->controller('components')
	->any('/components', 'index')
	->get('/components/create', 'create')
	->post('/components/create', 'do_create')
	->get('/components/update/{id:i}', 'update')
	->post('/components/update/{id:i}', 'do_update')
	->get('/components/update/{id:i}/css', 'update_css')
	->post('/components/update/{id:i}/css', 'do_update_css')
	->get('/components/update/{id:i}/javascript', 'update_javascript')
	->post('/components/update/{id:i}/javascript', 'do_update_javascript')
	->get('/components/update/{id:i}/nonblocking-javascript', 'update_nonblocking_javascript')
	->post('/components/update/{id:i}/nonblocking-javascript', 'do_update_nonblocking_javascript')
	->get('/components/delete/{id:i}', 'delete')
	->post('/components/delete/{id:i}', 'do_delete');
