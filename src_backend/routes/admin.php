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

    // HOME
    $app->get('/', array(new \Admin\AdminController(), 'authenticate') ,function () use ($app) {
        //render page
        if(isUserLogged()){
            $app->redirect('dashboard');
        } else {
            $app->redirect('login');
        }
    });

    // LOGIN
    $app->map('/login',function () use ($app) {
        //render page
        $app->render('admin/login.php');
    })->via('GET', 'POST');;


    // LOGOUT
    $app->get('/logout',function () use ($app) {

        //clear and destroy all sessions
        $_SESSION['USER_ID'] = '';
        $_SESSION['USER_NAME'] = '';
        unset($_SESSION['USER_ID']);
        unset($_SESSION['USER_NAME']);
        session_unset();
        session_destroy();
        $_SESSION = array();

        //clear and destroy all cookies
        $app->deleteCookie('USER_ID');
        $app->deleteCookie('USER_NAME');

        //redirect user
        $app->flashNow('error','You have been logged out.');
        $app->flashKeep();
        $app->redirect('login');
    });



    //DASHBOARD

//    $teste = new \Admin\AdminController();
//    echo $teste->isUserLogged();
//    $function = $teste->authenticate;


    $app->get('/dashboard',array(new \Admin\AdminController(), 'authenticate') ,  function () use ($app) {
        $app->render('dashboard.php');
    });

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