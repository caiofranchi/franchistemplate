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
        $app->get('/', array($refAdminController, 'authenticate') ,array($refAdminController,'index'));

        // LOGIN VIEW
        $app->map('/login',array($refAdminController,'login'))->via('GET', 'POST');



        // LOGOUT
        $app->get('/logout',array($refAdminController,'logout'));


        //DASHBOARD
        $app->get('/dashboard', array($refAdminController,'authenticate') ,  function () use ($app) {
            $app->render('/admin/dashboard.twig');
        });


    //USER GENERATED ENTITIES

    // Library group`
    $app->group('/categorias', array($refAdminController,'authenticate') , function () use ($app) {

        $refUserController = new \Admin\CategoriasController();

        //list
        $app->get('/',array($refUserController,'index'));

        //page
        $app->get('/page/:page', function ($id) {

        });

        //get one user
        $app->get('/:id', array($refUserController,'edit'));

        //update/insert user
        $app->put('/:id', function ($id) {

        });

        //delete user
        $app->delete('/:id', function ($id) {

        });


    });

});