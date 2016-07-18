<?php

namespace puffin;

$app->controller('articles')
	->any('/articles', 'index')
	->get('/articles/create', 'create')
	->post('/articles/create', 'do_create')
	->get('/articles/update/{id:i}', 'update')
	->post('/articles/update/{id:i}', 'do_update')
	->get('/articles/delete/{id:i}', 'delete')
	->post('/articles/delete/{id:i}', 'do_delete');
