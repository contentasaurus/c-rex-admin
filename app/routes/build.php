<?php

namespace puffin;

$app->controller('build')
	->any('/build', 'index')
	->get('/build/datasource/create', 'datasource_create')
	->post('/build/datasource/create', 'do_datasource_create')
	->get('/build/datasource/update/{id:i}', 'datasource_update')
	->post('/build/datasource/update/{id:i}', 'do_datasource_update')
	->get('/build/datasource/delete/{id:i}', 'datasource_delete')
	->post('/build/datasource/delete/{id:i}', 'do_datasource_delete')
	->get('/build/datasource/test/{id:i}', 'datasource_test')
	->post('/build/datasource/test/{id:i}', 'do_datasource_test');
