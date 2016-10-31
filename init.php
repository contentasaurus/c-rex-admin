<?php

use \puffin\app as app;
use \puffin\view as view;
use \puffin\session as session;
use \puffin\autoload as autoload;
use \puffin\controller as controller;
use Whoops\Handler\PrettyPageHandler;
use Whoops\Handler\JsonResponseHandler;

define('SERVER_URL', 'http://localhost:8000');

define('SERVER_ROOT', dirname(__FILE__));

define('APP_PATH', SERVER_ROOT.'/app');
define('NODE_PATH', SERVER_ROOT.'/node');
define('CONTROLLER_PATH', APP_PATH.'/controllers');
define('TRANSFORMER_PATH', APP_PATH.'/transformers');
define('MODEL_PATH', APP_PATH.'/models');
define('PLUGIN_PATH', APP_PATH.'/plugins');
define('TEST_PATH', APP_PATH.'/tests');
define('VIEW_PATH', APP_PATH.'/views');
define('PARTIAL_PATH', VIEW_PATH.'/partials');
define('LAYOUT_PATH', VIEW_PATH.'/layouts');
define('SCRIPT_PATH', VIEW_PATH.'/scripts');
define('BUILD_PATH', SERVER_ROOT.'/builds');
define('PUBLIC_PATH', SERVER_ROOT.'/public');
define('UPLOAD_PATH', PUBLIC_PATH.'/uploads');
define('VENDOR_PATH', SERVER_ROOT.'/vendor');
define('SYSTEM_PATH', VENDOR_PATH.'/puffin');

define('DAM_UPLOADS_URI', '/uploads/dam');
define('DAM_THUMBNAIL_URI', '/uploads/dam/thumbnails');

define('MUSTACHE_EXT', '.html');

//define('ERROR_REPORTING', true);

############################################

require VENDOR_PATH . '/autoload.php';

############################################

session::start();
autoload::init();
view::init('php');

$app = new app();
$app->router();
require 'app/app.php';
$app->route();

############################################
$run     = new Whoops\Run;
$handler = new PrettyPageHandler;

$handler->addDataTable('Contentasaurus Details', array(
	"Controller" => controller::$controller,
	"Action" => controller::$action
));

// Set the title of the error page:
$handler->setPageTitle("Whoops! There was a problem.");
$run->pushHandler($handler);

if (Whoops\Util\Misc::isAjaxRequest()) {
	$run->pushHandler(new JsonResponseHandler);
}

$run->register();
############################################

echo $app->render();

exit;
