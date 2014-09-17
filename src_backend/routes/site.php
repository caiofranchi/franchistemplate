<?php
/**
 * Created by PhpStorm.
 * User: cfranchi
 * Date: 05/08/14
 * Time: 14:36
 */

$app->group('/',function () use ($app) {
    $refSiteController = new \Site\MainController;

    // HOME
    $app->get('/', array($refSiteController, 'home'));

    //USER GENERATED ENTITIES
            $app->map('admins', array($refSiteController, 'admins_index'))->via('GET', 'POST');
            $app->map('contato', array($refSiteController, 'contato_index'))->via('GET', 'POST');
            $app->map('estrutura', array($refSiteController, 'estrutura_index'))->via('GET', 'POST');
            $app->map('etapas', array($refSiteController, 'etapas_index'))->via('GET', 'POST');
            $app->map('etapas-estrutura', array($refSiteController, 'etapas_estrutura_index'))->via('GET', 'POST');
            $app->map('etapas-fotos', array($refSiteController, 'etapas_fotos_index'))->via('GET', 'POST');
            $app->map('fotos', array($refSiteController, 'fotos_index'))->via('GET', 'POST');
            $app->map('imprensa', array($refSiteController, 'imprensa_index'))->via('GET', 'POST');
    
});