<?php
/**
 * Created by PhpStorm.
 * User: cfranchi
 * Date: 05/08/14
 * Time: 14:36
 */

$app->get('/',function () use ($app) {
    //render page EXAMPLE
    $app->render('home.php');
});