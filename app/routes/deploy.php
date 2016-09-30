<?php

namespace puffin;

$app->controller('deploy')
	->any('/deploy', 'index')
	->get('/deploy/create', 'create')
	->post('/deploy/create', 'do_create')
	->get('/deploy/update/{id:i}', 'update')
	->post('/deploy/update/{id:i}', 'do_update')
	->get('/deploy/delete/{id:i}', 'delete')
	->post('/deploy/delete/{id:i}', 'do_delete')
	->get('/deploy/test/{id:i}', 'test')
	->post('/deploy/test/{id:i}', 'do_test')
	->get('/deploy/build/{id:i}', 'build')
	->post('/deploy/build/{id:i}', 'do_build')
	->post('/deploy/rollback/{id:i}', 'do_build');
