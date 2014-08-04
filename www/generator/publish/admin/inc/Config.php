<?php
/**
 * Created by PhpStorm.
 * User: Caio
 * Date: 03/08/14
 * Time: 18:41
 */

//CURRENT MODE
$_ENV['SLIM_MODE'] = 'development';
//$_ENV['SLIM_MODE'] = 'production';

define('ROOT_PATH'  , __DIR__.'/../../');
define('VENDOR_PATH', __DIR__.'/../../vendor/');
define('APP_PATH'   , __DIR__.'/../../app/');
define('MODULE_PATH', __DIR__.'/../../app/modules/');
define('PUBLIC_PATH', __DIR__.'/../../public/');

//eloquent ORM
$settings = array(
    'driver' => 'mysql',
    'host' => 'localhost',
    'database' => 'vagrant_dev',
    'username' => 'root',
    'password' => 'vagrant',
    'collation' => 'utf8_general_ci',
    'charset'   => "utf8",
    'prefix' => ''
);

// Bootstrap Eloquent ORM Config
$connFactory = new \Illuminate\Database\Connectors\ConnectionFactory(new Illuminate\Container\Container());
$conn = $connFactory->make($settings);
$resolver = new \Illuminate\Database\ConnectionResolver();
$resolver->addConnection('default', $conn);
$resolver->setDefaultConnection('default');
\Illuminate\Database\Eloquent\Model::setConnectionResolver($resolver);
