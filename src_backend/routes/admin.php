<?php
/**
 * Created by PhpStorm.
 * User: cfranchi
 * Date: 05/08/14
 * Time: 14:36
 */

/**
 * Sample group routing with user check in middleware
 */
// API group
$app->group('/admin', function () use ($app) {

    $refAdminController = new \Admin\AdminController;

    // HOME
    $app->get('/', array($refAdminController, 'authenticate') ,function () use ($app) {
        //render page
        if(\Admin\AdminController::isUserLogged()){
            $app->redirect('dashboard');
        } else {
            $app->redirect('login');
        }
    });

    // LOGIN VIEW
    $app->map('/login',array($refAdminController,'login'))->via('GET', 'POST');



    // LOGOUT
    $app->get('/logout',array($refAdminController,'logout'));


    //DASHBOARD
    $app->get('/dashboard', array($refAdminController,'authenticate') ,  function () use ($app) {
        $app->render('/admin/dashboard.twig');
    });


    //USER GENERATED ENTITIES

//    // Library group
//    $app->group('/library', function () use ($app) {
//
//        // Get book with ID
//        $app->get('/books/:id', function ($id) {
//
//        });
//
//        // Update book with ID
//        $app->put('/books/:id', function ($id) {
//
//        });
//
//        // Delete book with ID
//        $app->delete('/books/:id', function ($id) {
//
//        });
//
//    });

});