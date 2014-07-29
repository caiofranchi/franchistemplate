<?php
/**
 * Created by PhpStorm.
 * User: Caio
 * Date: 28/07/14
 * Time: 22:11
 */
require_once 'vendor/autoload.php';
require_once 'inc/utils.php';

////slim
//$app = new \Slim\Slim();
//$app->get('/hello/:name', function ($name) {
//    echo "Hello, $name";
//});
//$app->run();
//


//read config JSON
$filePath = file_get_contents("config.json");
$jsonConfig= json_decode($filePath,false);

$objDataBase = $jsonConfig->generator->database;
$objEntities = $jsonConfig->generator->entities;

//var_dump($objEntities)

//eloquent ORM
$settings = array(
    'driver' => 'mysql',
    'host' => $objDataBase->host,
    'database' => $objDataBase->database,
    'username' => $objDataBase->user,
    'password' => $objDataBase->password,
    'collation' => 'utf8_general_ci',
    'charset'   => "utf8",
    'prefix' => ''
);

// Bootstrap Eloquent ORM
$connFactory = new \Illuminate\Database\Connectors\ConnectionFactory(new Illuminate\Container\Container());
$conn = $connFactory->make($settings);
$resolver = new \Illuminate\Database\ConnectionResolver();
$resolver->addConnection('default', $conn);
$resolver->setDefaultConnection('default');
\Illuminate\Database\Eloquent\Model::setConnectionResolver($resolver);


//twig
$loader = new Twig_Loader_Filesystem('templates/');
$twig = new Twig_Environment($loader, array(
    'cache' => 'compilation_cache',
));


//parsing json
$jsonIterator = new RecursiveIteratorIterator(
    new RecursiveArrayIterator($objEntities),
    RecursiveIteratorIterator::SELF_FIRST);

foreach ($objEntities as $key) {


    //rendering Models based on templates
    $arrTeste = (array) $key;

    $renderedClass = $twig->render('model.twig', $arrTeste);

    //writing php models
    $myfile = fopen('publish/app/models/'.$key->slug.'.php', "w");
    fwrite($myfile, $renderedClass);
    fclose($myfile);

}



//each entity
//$totalEntities = count($objEntities);
//
//for($i=0 ; $i<$totalEntities;$i++) {
//
//
//}
