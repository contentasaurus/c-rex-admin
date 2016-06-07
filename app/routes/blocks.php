<?php

namespace puffin;

$app->controller('blocks')
	->any('/blocks', 'index')
	->get('/blocks/create', 'create')
	->post('/blocks/create', 'do_create')
	->get('/blocks/update/{id:i}', 'update')
	->post('/blocks/update/{id:i}', 'do_update')
	->get('/blocks/delete/{id:i}', 'delete')
	->post('/blocks/delete/{id:i}', 'do_delete');
