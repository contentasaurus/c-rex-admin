<?php

use \puffin\environment as environment;
use \puffin\plugin as plugin;
use \puffin\view as view;
use \puffin\debug as debug;
use \puffin\url as url;
use \puffin\dsn as dsn;

# Handy Shortcut functions
function debug( $input ){ echo debug::printr($input); }
function clog( $input ){ echo debug::clog($input); }
function redirect( $location = false ){ url::redirect($location); }
function vd ( $input ){
	ob_start();
	var_dump($input);
	$output = ob_get_clean();
	$output = htmlentities($output);
	echo '<pre>'.$output.'</pre>';
}


environment::init(SERVER_ROOT . '/dsn.json');
environment::load();

#Plugins
plugin::register('compiled_assets');
plugin::register('forceauth');
plugin::register('fonts');
plugin::register('layout');

#Routes
include_once 'routes.php';
