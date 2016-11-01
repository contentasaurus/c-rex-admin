<?php

namespace puffin;

$app->controller('page_preview')
	->any('/page-preview/{version_id:i}', 'index');
