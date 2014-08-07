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
        if(\Admin\AdminController::isUserLogged()){
            $app->redirect('dashboard');
        } else {
            $app->redirect('login');
        }
    });

    // LOGIN VIEW
    $app->get('/login',function () use ($app) {
        //render page
        $app->render('admin/login.twig');
    });

    //LOGIN POST
    $app->post('/login',function () use ($app) {
        //render page
        $email = $_REQUEST["email"];
        $password = $_REQUEST["password"];
        $remember = isset($_REQUEST["remember"]) ? $_REQUEST["remember"] : false;


        if(!empty($email) && !empty($password)){

            $user = \Admins::where('email',$email)->first();

            if(count($user)==1) {
                //user exists

                if (PassHash::check_password($user->password,$password)) {

                    // User password is correct
                    if($remember==='true') {
                        $app->setCookie('USER_ID',$user->id);
                        $app->setCookie('USER_NAME',$user->name);
                    } else {
                        $_SESSION['USER_ID'] = $user->id;
                        $_SESSION['USER_NAME'] = $user->name;
                    }

                    $app->flashNow('success', 'Welcome');

                    //Redirect user to dashboard
                    $app->redirect('dashboard');
                } else {

                    $app->flashNow('error', 'Cannot login');
                }

            } else {
                //user not exists
                $app->flashNow('error', 'Cannot login');
            }

        } else {
            $app->flashNow('error', 'Email and password are required to login');
        }

        $app->render('admin/login.twig');

    });


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
    $app->get('/dashboard',array(new \Admin\AdminController(), 'authenticate') ,  function () use ($app) {
        $app->render('dashboard.php');
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