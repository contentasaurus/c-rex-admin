<?php

namespace puffin;

$app->controller('blog')
	->any('/blog', 'index')
	->get('/blog/create', 'create')
	->post('/blog/create', 'do_create')
	->get('/blog/update/{id:i}', 'update')
	->post('/blog/update/{id:i}', 'do_update')
	->get('/blog/delete/{id:i}', 'delete')
	->post('/blog/delete/{id:i}', 'do_delete')
	->get('/blog/publish/{id:i}/state/{state:i}', 'set_publish');
