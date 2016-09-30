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
	->post('/pages/delete/{id:i}', 'do_delete')

	#pages section, create data from on-page form
	->get('/pages/update/{id:i}/data', 'data_index')
	->post('/pages/update/{id:i}/data', 'do_data_create')
	->get('/pages/update/{id:i}/data-update/{data_id:i}', 'data_update')
	->post('/pages/update/{id:i}/data-update/{data_id:i}', 'do_data_update')
	->post('/pages/update/{id:i}/data-delete/{data_id:i}', 'do_data_delete')

	#moar crazy
	->get('/pages/update/{id:i}/version-create', 'do_version_create')
	->get('/pages/update/{id:i}/version-update/{version_id:i}', 'version_update')
	->post('/pages/update/{id:i}/version-update/{version_id:i}', 'do_version_update')
	->get('/pages/update/{id:i}/version-copy/{version_id:i}', 'do_version_copy')
	->get('/pages/update/{id:i}/version-publish/{version_id:i}/state/{state:i}', 'version_set_publish')
	->post('/pages/update/{id:i}/version-delete/{version_id:i}', 'do_version_delete');
