<?php
/**
 * Created by PhpStorm.
 * User: Caio
 * Date: 03/08/14
 * Time: 18:41
 */

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
