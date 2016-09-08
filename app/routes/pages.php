<?php

namespace puffin;

$app->controller('pages')
	->any('/pages', 'index')
	->get('/pages/create', 'create')
	->post('/pages/create', 'do_create')
	->get('/pages/update/{id:i}', 'update')
	->post('/pages/update/{id:i}', 'do_update')
	->get('/pages/update/{id:i}/status', 'update_status')
	->post('/pages/update/{id:i}/status', 'do_update_status')

	->get('/pages/publish/{id:i}', 'publish')
	->get('/pages/unpublish/{id:i}', 'unpublish')

	#pages section, create data from on-page form
	->get('/pages/update/{id:i}/data', 'update_data')
	->post('/pages/update/{id:i}/data', 'do_update_data')

	#pages section, update data from data update page
	->get('/pages/update/{id:i}/data/update/{data_id:i}', 'update_data_update')
	->post('/pages/update/{id:i}/data/update/{data_id:i}', 'do_update_data_update')

	#pages section, delete data from data update page
	->get('/pages/update/{id:i}/data/delete/{data_id:i}', 'update_data_delete')
	->post('/pages/update/{id:i}/data/delete/{data_id:i}', 'do_update_data_delete')

	#moar crazy
	->get('/pages/update/{id:i}/versions', 'update_version')
	->post('/pages/update/{id:i}/versions', 'do_update_version')

	->get('/pages/update/{id:i}/versions/update/{version_id:i}', 'update_version_update')
	->post('/pages/update/{id:i}/versions/update/{version_id:i}', 'do_update_version_update')

	->get('/pages/update/{id:i}/versions/promote/{version_id:i}', 'update_version_promote')
	->post('/pages/update/{id:i}/versions/promote/{version_id:i}', 'do_update_version_promote')

	->get('/pages/update/{id:i}/versions/delete/{version_id:i}', 'update_version_delete')
	->post('/pages/update/{id:i}/versions/delete/{version_id:i}', 'do_update_version_delete')

	#resume sanity
	->get('/pages/update/{id:i}/history', 'update_history')
	->post('/pages/update/{id:i}/history', 'do_update_history')
	->get('/pages/delete/{id:i}', 'delete')
	->post('/pages/delete/{id:i}', 'do_delete');
