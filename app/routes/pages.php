<?php

namespace puffin;

$app->controller('pages')
	->any('/pages', 'index')
	->get('/pages/create', 'create')
	->post('/pages/create', 'do_create')
	->get('/pages/update/{id:i}', 'update')
	->post('/pages/update/{id:i}', 'do_update')
	->get('/pages/publish/{id:i}/state/{state:i}', 'set_publish')
	->get('/pages/delete/{id:i}', 'delete')
	->post('/pages/delete/{id:i}', 'do_delete');

$app->controller('page_data')
	->get('/pages/update/{id:i}/data-create', 'create')
	->post('/pages/update/{id:i}/data-create', 'do_create')
	->get('/pages/update/{id:i}/data-update/{data_id:i}', 'update')
	->post('/pages/update/{id:i}/data-update/{data_id:i}', 'do_update')
	->post('/pages/update/{id:i}/data-delete/{data_id:i}', 'do_delete');

$app->controller('page_versions')
	->get('/pages/update/{id:i}/version-create', 'do_create')
	->get('/pages/update/{id:i}/version-update/{version_id:i}', 'update')
	->post('/pages/update/{id:i}/version-update/{version_id:i}', 'do_update')
	->post('/pages/update/{id:i}/version-split-update', 'do_split_update')
	->get('/pages/update/{id:i}/version-copy/{version_id:i}', 'do_copy')
	->get('/pages/update/{id:i}/version-publish/{version_id:i}/state/{state:i}', 'set_publish')
	->post('/pages/update/{id:i}/version-delete/{version_id:i}', 'do_delete');
