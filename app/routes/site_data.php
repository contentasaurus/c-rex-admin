<?php

namespace puffin;

$app->controller('site_data')
	->get('/datatypes/site-data/create', 'create')
	->post('/datatypes/site-data/create', 'do_create')
	->get('/datatypes/site-data/update/{id:i}', 'update')
	->post('/datatypes/site-data/update/{id:i}', 'do_update')
	->get('/datatypes/site-data/delete/{id:i}', 'delete')
	->post('/datatypes/site-data/delete/{id:i}', 'do_delete');
