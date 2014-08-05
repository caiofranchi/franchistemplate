<?php
/**
 * Created by PhpStorm.
 * User: cfranchi
 * Date: 05/08/14
 * Time: 19:17
 */

$_ENV['SLIM_MODE'] = 'development';

//    //View
//    'view'          => new \Slim\Views\Twig(),
//    'templates.path'=> APP_PATH.'views',
$app = new \Slim\Slim(array(
    'mode' => $_ENV['SLIM_MODE']
));

// Only invoked if mode is "production"
$app->configureMode('production', function () use ($app) {
    $app->config(array(
        'log.enabled' => true,
        'debug' => false,
        'templates.path' => './',
        'cookies.httponly' => true,
        'cookies.secret_key' => 'SPECIAL_SECRET',
        'cookies.encrypt' => true,
    ));
});

// Only invoked if mode is "development"
$app->configureMode('development', function () use ($app) {
    $app->config(array(
        'log.enabled' => false,
        'debug' => true,
        'templates.path' => './',
        'cookies.httponly' => false,
        'cookies.secret_key' => 'secret',
        'cookies.encrypt' => true,
    ));
});

//common config
$app->config('routes.case_sensitive' , true);
$app->config('http.version' , '1.1');

//cookie session store configuration
$app->config('cookies.lifetime' , '20 minutes');
$app->config('cookies.cipher', MCRYPT_RIJNDAEL_256);
$app->config('cookies.cipher_mode', MCRYPT_MODE_CBC);

return $app;