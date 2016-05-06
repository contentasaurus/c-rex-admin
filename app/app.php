<?php

use \puffin\plugin as plugin;
use \puffin\view as view;
use \puffin\debug as debug;
use \puffin\url as url;

# Handy Shortcut functions
function debug( $input ){ echo debug::printr($input); }
function clog( $input ){ echo debug::clog($input); }
function redirect( $location = false ){ url::redirect($location); }

#Plugins
plugin::register('forceauth');
plugin::register('layout');
plugin::register('bootstrap');
plugin::register('jquery');
plugin::register('fontawesome');
plugin::register('googlefont');
plugin::register('freelancer');

#Routes
include_once 'routes.php';
