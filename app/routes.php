<?php

namespace puffin;

use \puffin\directory as directory;


$___routes = new directory();

$___includes = $___routes->rscan( APP_PATH . '/routes' );

foreach($___includes as $include)
{
	include $include['full_path'];
}
