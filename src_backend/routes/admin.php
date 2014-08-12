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
        $app->get('/dashboard', array($refAdminController,'authenticate') , array($refAdminController, 'dashboard_get'));


    //USER GENERATED ENTITIES

    // Library group`
    $app->group('/categorias', array($refAdminController,'authenticate') , function () use ($app) {

        $refUserController = new \Admin\CategoriasController;

        //list
        $app->get('/',array($refUserController,'index'));

        //page
        $app->get('/page/:page',array($refUserController,'page_get'));

        //create
        $app->get('/create', array($refUserController,'edit_get'));
        $app->post('/create', array($refUserController,'edit_post'));

        //get one user
        $app->get('/edit(/:id)', array($refUserController,'edit_get'));
        $app->post('/edit(/:id)', array($refUserController,'edit_post'));

        //edit user
//        $app->post('/:id', function ($id) {
//
//        });
//
//        //delete user
//        $app->delete('/:id', function ($id) {
//
//        });


    });

});