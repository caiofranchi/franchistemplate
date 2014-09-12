<?php
/**
 * Created by PhpStorm.
 * User: cfranchi
 * Date: 04/08/14
 * Time: 14:47
 */
session_cache_limiter(false);
session_start();

require_once '../../vendor/autoload.php';
require_once 'inc/Config.php';

//setup SLIM
$app = new \Slim\Slim(array(
    'mode' => $_ENV['SLIM_MODE']
));
$app->setName('MainAdminRouting');

// Only invoked if mode is "production"
$app->configureMode('production', function () use ($app) {
    $app->config(array(
        'log.enabled' => true,
        'debug' => false,
        'templates.path' => './',
        'cookies.httponly' => true,
        'cookies.secret_key' => 'SPECIAL_SECRET',
        'cookies.encrypt' => true,
    ));
});

// Only invoked if mode is "development"
$app->configureMode('development', function () use ($app) {
    $app->config(array(
        'log.enabled' => false,
        'debug' => true,
        'templates.path' => './',
        'cookies.httponly' => false,
        'cookies.secret_key' => 'secret',
        'cookies.encrypt' => true,
    ));
});

//cookie session store configuration
$app->config('cookies.lifetime' , '20 minutes');
$app->config('cookies.cipher', MCRYPT_RIJNDAEL_256);
$app->config('cookies.cipher_mode', MCRYPT_MODE_CBC);

/*

    SETTING ADMIN ROUTES

*/

// HOME
$app->get('/',function () use ($app) {
    //render page
//    require_once 'login.php';
    if(isUserLogged()){
        $app->redirect('dashboard');
    } else {
        $app->redirect('login');
    }
});

// LOGIN
$app->map('/login',function () use ($app) {
    //render page
    $app->render('login.php');
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
$app->get('/dashboard', 'authenticate', function () use ($app) {
    $app->render('dashboard.php');
});

//ENTITIES: {{ name }}

/**
 * Adding Middle Layer to authenticate every request
 * Checking if the user is logged on admin
 */
function authenticate(\Slim\Route $route) {
    $app = \Slim\Slim::getInstance();

    if(!isUserLogged()) {
//        $response["error"] = true;
//        $response["message"] = "Access Denied.";
//        echoRespnse(401, $response);
//        $app->stop();
        $app->redirect('login');
    }
}

function isUserLogged(){
    $app = \Slim\Slim::getInstance();

    // Verifying User Authorization
    if((string)$app->getCookie('USER_ID',false) !== ''){
        //cookie exists
        return true;
    } else {

        //verifica a sessao
        if(isset($_SESSION["USER_ID"])) {
            if($_SESSION["USER_ID"]!=='') {
                return true;
            }else {
                return false;
            }
        }else {
            return false;
        }
    }

    return false;
}


//run application
$app->run();
