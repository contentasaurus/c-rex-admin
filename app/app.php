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


environment::init(SERVER_ROOT . '/dsn.json');
environment::load();

#Plugins
plugin::register('bower');
plugin::register('theme');
plugin::register('forceauth');
plugin::register('fonts');
plugin::register('layout');

#Routes
include_once 'routes.php';
