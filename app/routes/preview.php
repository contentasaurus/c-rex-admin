<?php

namespace puffin;

$app->controller('preview')
	->any('/preview/{version_id:i}', 'preview')
	->any('/build/{version_id:i}', 'build');
