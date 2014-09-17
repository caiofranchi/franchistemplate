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
        $app->get('/dashboard', array($refAdminController,'authenticate') , array(new \Admin\DashboardController, 'index'));


        //USER GENERATED ENTITIES
                    // Admins
            $app->group('/admins', array($refAdminController,'authenticate') , function () use ($app) {
                $refUserController = new \Admin\AdminsController;

                //list
                $app->get('/',array($refUserController,'index'));

                //page listing
                $app->get('/page/:page',array($refUserController,'page_get'));

                //search
                $app->get('/search/:value',array($refUserController,'search_get'));

                //file upload
                $app->post('/upload(/:id)',array($refUserController,'upload_post'));

                //create
                $app->get('/create', array($refUserController,'edit_get'));
                $app->post('/create', array($refUserController,'edit_post'));

                //get one user
                $app->get('/edit(/:id)', array($refUserController,'edit_get'));
                $app->post('/edit(/:id)', array($refUserController,'edit_post'));

                $app->get('/delete/:id', array($refUserController,'delete_get'));
            });
                    // Contato
            $app->group('/contato', array($refAdminController,'authenticate') , function () use ($app) {
                $refUserController = new \Admin\ContatoController;

                //list
                $app->get('/',array($refUserController,'index'));

                //page listing
                $app->get('/page/:page',array($refUserController,'page_get'));

                //search
                $app->get('/search/:value',array($refUserController,'search_get'));

                //file upload
                $app->post('/upload(/:id)',array($refUserController,'upload_post'));

                //create
                $app->get('/create', array($refUserController,'edit_get'));
                $app->post('/create', array($refUserController,'edit_post'));

                //get one user
                $app->get('/edit(/:id)', array($refUserController,'edit_get'));
                $app->post('/edit(/:id)', array($refUserController,'edit_post'));

                $app->get('/delete/:id', array($refUserController,'delete_get'));
            });
                    // Estrutura
            $app->group('/estrutura', array($refAdminController,'authenticate') , function () use ($app) {
                $refUserController = new \Admin\EstruturaController;

                //list
                $app->get('/',array($refUserController,'index'));

                //page listing
                $app->get('/page/:page',array($refUserController,'page_get'));

                //search
                $app->get('/search/:value',array($refUserController,'search_get'));

                //file upload
                $app->post('/upload(/:id)',array($refUserController,'upload_post'));

                //create
                $app->get('/create', array($refUserController,'edit_get'));
                $app->post('/create', array($refUserController,'edit_post'));

                //get one user
                $app->get('/edit(/:id)', array($refUserController,'edit_get'));
                $app->post('/edit(/:id)', array($refUserController,'edit_post'));

                $app->get('/delete/:id', array($refUserController,'delete_get'));
            });
                    // Etapas
            $app->group('/etapas', array($refAdminController,'authenticate') , function () use ($app) {
                $refUserController = new \Admin\EtapasController;

                //list
                $app->get('/',array($refUserController,'index'));

                //page listing
                $app->get('/page/:page',array($refUserController,'page_get'));

                //search
                $app->get('/search/:value',array($refUserController,'search_get'));

                //file upload
                $app->post('/upload(/:id)',array($refUserController,'upload_post'));

                //create
                $app->get('/create', array($refUserController,'edit_get'));
                $app->post('/create', array($refUserController,'edit_post'));

                //get one user
                $app->get('/edit(/:id)', array($refUserController,'edit_get'));
                $app->post('/edit(/:id)', array($refUserController,'edit_post'));

                $app->get('/delete/:id', array($refUserController,'delete_get'));
            });
                    // EtapasEstrutura
            $app->group('/etapas-estrutura', array($refAdminController,'authenticate') , function () use ($app) {
                $refUserController = new \Admin\EtapasEstruturaController;

                //list
                $app->get('/',array($refUserController,'index'));

                //page listing
                $app->get('/page/:page',array($refUserController,'page_get'));

                //search
                $app->get('/search/:value',array($refUserController,'search_get'));

                //file upload
                $app->post('/upload(/:id)',array($refUserController,'upload_post'));

                //create
                $app->get('/create', array($refUserController,'edit_get'));
                $app->post('/create', array($refUserController,'edit_post'));

                //get one user
                $app->get('/edit(/:id)', array($refUserController,'edit_get'));
                $app->post('/edit(/:id)', array($refUserController,'edit_post'));

                $app->get('/delete/:id', array($refUserController,'delete_get'));
            });
                    // EtapasFotos
            $app->group('/etapas-fotos', array($refAdminController,'authenticate') , function () use ($app) {
                $refUserController = new \Admin\EtapasFotosController;

                //list
                $app->get('/',array($refUserController,'index'));

                //page listing
                $app->get('/page/:page',array($refUserController,'page_get'));

                //search
                $app->get('/search/:value',array($refUserController,'search_get'));

                //file upload
                $app->post('/upload(/:id)',array($refUserController,'upload_post'));

                //create
                $app->get('/create', array($refUserController,'edit_get'));
                $app->post('/create', array($refUserController,'edit_post'));

                //get one user
                $app->get('/edit(/:id)', array($refUserController,'edit_get'));
                $app->post('/edit(/:id)', array($refUserController,'edit_post'));

                $app->get('/delete/:id', array($refUserController,'delete_get'));
            });
                    // Fotos
            $app->group('/fotos', array($refAdminController,'authenticate') , function () use ($app) {
                $refUserController = new \Admin\FotosController;

                //list
                $app->get('/',array($refUserController,'index'));

                //page listing
                $app->get('/page/:page',array($refUserController,'page_get'));

                //search
                $app->get('/search/:value',array($refUserController,'search_get'));

                //file upload
                $app->post('/upload(/:id)',array($refUserController,'upload_post'));

                //create
                $app->get('/create', array($refUserController,'edit_get'));
                $app->post('/create', array($refUserController,'edit_post'));

                //get one user
                $app->get('/edit(/:id)', array($refUserController,'edit_get'));
                $app->post('/edit(/:id)', array($refUserController,'edit_post'));

                $app->get('/delete/:id', array($refUserController,'delete_get'));
            });
                    // Imprensa
            $app->group('/imprensa', array($refAdminController,'authenticate') , function () use ($app) {
                $refUserController = new \Admin\ImprensaController;

                //list
                $app->get('/',array($refUserController,'index'));

                //page listing
                $app->get('/page/:page',array($refUserController,'page_get'));

                //search
                $app->get('/search/:value',array($refUserController,'search_get'));

                //file upload
                $app->post('/upload(/:id)',array($refUserController,'upload_post'));

                //create
                $app->get('/create', array($refUserController,'edit_get'));
                $app->post('/create', array($refUserController,'edit_post'));

                //get one user
                $app->get('/edit(/:id)', array($refUserController,'edit_get'));
                $app->post('/edit(/:id)', array($refUserController,'edit_post'));

                $app->get('/delete/:id', array($refUserController,'delete_get'));
            });
        

});