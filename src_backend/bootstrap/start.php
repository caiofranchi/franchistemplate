<?php
/**
 * Created by PhpStorm.
 * User: cfranchi
 * Date: 05/08/14
 * Time: 18:59
 */
session_cache_limiter(false);
session_start();

//first load PATH configurations
require __DIR__.'/../config/paths.php';


//now load composer
$loader = require VENDOR_PATH.'autoload.php';


/**
 * Initialize ELOQUENT ORM
 */

//eloquent ORM
require APP_PATH.'config/database.php';

// Bootstrap Eloquent ORM
$connFactory = new \Illuminate\Database\Connectors\ConnectionFactory(new Illuminate\Container\Container());
$conn = $connFactory->make($databaseSettings);
$resolver = new \Illuminate\Database\ConnectionResolver();
$resolver->addConnection('default', $conn);
$resolver->setDefaultConnection('default');
\Illuminate\Database\Eloquent\Model::setConnectionResolver($resolver);


/**
 * Initiliaze TWIG
 */

/**
 * Initialize Slim with external configuration file
 */

$app = require APP_PATH.'config/slim.php'; //start and configure an Slim app application
$app->setName('MainSiteRouting');

//SETUP SLIM ROUTES
require APP_PATH.'routes/site.php';
require APP_PATH.'routes/admin.php';
require APP_PATH.'routes/rest.php';

return $app;