<?php

namespace puffin;

$app->controller('preview')
	->any('/preview/{version_id:i}', 'preview');
