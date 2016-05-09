<?php

use \puffin\plugin as plugin;
use \puffin\view as view;
use \puffin\debug as debug;
use \puffin\url as url;
use \puffin\dsn as dsn;

# Handy Shortcut functions
function debug( $input ){ echo debug::printr($input); }
function clog( $input ){ echo debug::clog($input); }
function redirect( $location = false ){ url::redirect($location); }

dsn::set('default', [
	'type' => 'mysql',
	'name' => DB_NAME,
	'user' => DB_USER,
	'pass' => DB_PASSWORD,
	'addr' => DB_ADDRESS
]);

#Plugins
plugin::register('forceauth');
plugin::register('layout');

#Routes
include_once 'routes.php';
