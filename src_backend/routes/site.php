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

    //EMPRESA
    $app->get('empresa', array($refSiteController, 'empresa'));

    $app->get('portfolio/:slugCategoria(/:slugPortfolio)', array($refSiteController, 'portfolio'));

//    $app->get('portfolio/:slugCategoria/:slugPortfolio', array($refSiteController, 'portfolio_item'));

    $app->get('noticias(/:slug)', array($refSiteController, 'noticias'));

    $app->get('contato', array($refSiteController, 'contato_get'));
    $app->post('contato', array($refSiteController, 'contato_post'));
    $app->post('contato/upload', array($refSiteController, 'contato_upload'));


});