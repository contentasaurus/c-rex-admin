<?php

namespace puffin;

$app->controller('index')
	->any('/', 'index')
	->any('/about', 'about');
