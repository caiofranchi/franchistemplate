<?php
/**
 * Created by PhpStorm.
 * User: cfranchi
 * Date: 05/08/14
 * Time: 14:36
 */

$app->group('/generator',function () use ($app) {
    $refSiteController = new \Generator\GeneratorController();

    // HOME
    $app->get('/', array($refSiteController, 'index'));
    $app->post('/', array($refSiteController, 'generate'));


});