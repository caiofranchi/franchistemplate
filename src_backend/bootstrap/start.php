<?php
/**
 * Bootstrap class that initializes everything that the framework needs
 * User: cfranchi
 * Date: 05/08/14
 * Time: 18:59
 */
session_cache_limiter(false);
session_start();

//first load PATH configurations
require __DIR__.'/../config/paths.php';

//load composer
$loader = require VENDOR_PATH.'autoload.php';


/**
 * Initialize ELOQUENT ORM
 */


//eloquent ORM
require APP_PATH.'config/database.php';

// Bootstrap Eloquent
//$connFactory = new \Illuminate\Database\Connectors\ConnectionFactory(new Illuminate\Container\Container());
//$conn = $connFactory->make($databaseSettings);
//$resolver = new \Illuminate\Database\ConnectionResolver();
//$resolver->addConnection('default', $conn);
//$resolver->setDefaultConnection('default');
//\Illuminate\Database\Eloquent\Model::setConnectionResolver($resolver);

use Illuminate\Database\Capsule\Manager as Capsule;
$capsule = new Capsule;
$capsule->addConnection($databaseSettings);

// Set the event dispatcher used by Eloquent models... (optional)
use Illuminate\Events\Dispatcher;
use Illuminate\Container\Container;
$capsule->setEventDispatcher(new Dispatcher(new Container));

// Set the cache manager instance used by connections... (optional)
//    $capsule->setCacheManager(...);

// Make this Capsule instance available globally via static methods... (optional)
$capsule->setAsGlobal();

// Setup the Eloquent ORM
$capsule->bootEloquent();


/**
 * Initialize Slim with external configuration file
 */

$app = require APP_PATH.'config/slim.php'; //start and configure an Slim app application
$app->setName('MainSiteRouting');



/**
 * Initiliaze TWIG/SLIM_VIEW inside SLIM
 */

//set twig as default view render
$app->config('view',new \Slim\Views\Twig());

//configure slim views helper on twig
$app->container->singleton('twig', function ($c) {
    $twig = new \Slim\Views\Twig();

    /* Option */
    $twig->parserOptions = $config['twig'];

    /* Extensions */
    $twig->parserExtensions = array(
        new \Slim\Views\TwigExtension(),
    );

    $templatesPath = $c['settings']['templates.path'];
    $twig->setTemplatesDirectory($templatesPath);

    return $twig;
});

$view = $app->view();

$view->parserExtensions = array(
    new \Slim\Views\TwigExtension(),
);


/**
 * SETUP SLIM ROUTES
 */
require APP_PATH.'routes/generator.php';
require APP_PATH.'routes/site.php';
require APP_PATH.'routes/admin.php';
//require APP_PATH.'routes/rest.php';

return $app;