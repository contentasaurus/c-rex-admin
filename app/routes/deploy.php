<?php

namespace puffin;

$app->controller('deploy')
	->any('/deploy', 'index')
	->get('/deploy/datasource/create', 'datasource_create')
	->post('/deploy/datasource/create', 'do_datasource_create')
	->get('/deploy/datasource/update/{id:i}', 'datasource_update')
	->post('/deploy/datasource/update/{id:i}', 'do_datasource_update')
	->get('/deploy/datasource/delete/{id:i}', 'datasource_delete')
	->post('/deploy/datasource/delete/{id:i}', 'do_datasource_delete')
	->get('/deploy/datasource/test/{id:i}', 'datasource_test')
	->post('/deploy/datasource/test/{id:i}', 'do_datasource_test')
	->get('/deploy/datasource/build/{id:i}', 'datasource_build');
