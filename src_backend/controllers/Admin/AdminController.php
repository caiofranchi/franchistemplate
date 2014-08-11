<?php
/**
 * Created by PhpStorm.
 * User: cfranchi
 * Date: 06/08/14
 * Time: 15:12
 */


namespace Admin;

use Slim\Slim;

class AdminController extends GeneralAdminController {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        //render page
        if($this->isUserLogged()){
            $this->app->redirect('dashboard');
        } else {
            $this->app->redirect('login');
        }
    }

    /**
     * Middle layer method for verify user on routes
     * Checking if the user is logged on admin
     */
    public function authenticate(\Slim\Route $route) {
//        $this->app = \Slim\Slim::getInstance();

        if(!$this->isUserLogged()) {
//        $this->app->stop();
            $this->app->redirect('login');
        }
    }


    /**
     * Verify if the user is logged on admin
     * @return bool
     */
    public function isUserLogged(){
        $this->app = \Slim\Slim::getInstance();

        // Verifying User Authorization
        if((string)$this->app->getCookie('USER_ID',false) !== ''){
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

    public function login() {

        if($this->app->request->isPost()) {
            //render page
            $email = $_REQUEST["email"];
            $password = $_REQUEST["password"];
            $remember = isset($_REQUEST["remember"]) ? $_REQUEST["remember"] : false;


            if(!empty($email) && !empty($password)){

                $user = \Admins::where('email',$email)->first();

                if(count($user)==1) {
                    //user exists

                    if (\PassHash::check_password($user->password,$password)) {

                        // User password is correct
                        if($remember==='true') {
                            $this->app->setCookie('USER_ID',$user->id);
                            $this->app->setCookie('USER_NAME',$user->name);
                        } else {
                            $_SESSION['USER_ID'] = $user->id;
                            $_SESSION['USER_NAME'] = $user->name;
                        }

                        $this->app->flashNow('success', 'Welcome');

                        //Redirect user to dashboard
                        $this->app->redirect('dashboard');
                    } else {

                        $this->app->flashNow('error', 'Cannot login');
                    }

                } else {
                    //user not exists
                    $this->app->flashNow('error', 'Cannot login');
                }

            } else {
                $this->app->flashNow('error', 'Email and password are required to login');
            }
        }


        $this->app->render('admin/login.twig',$this->data);
    }

    public function logout(){
        //clear and destroy all sessions
        $_SESSION['USER_ID'] = '';
        $_SESSION['USER_NAME'] = '';
        unset($_SESSION['USER_ID']);
        unset($_SESSION['USER_NAME']);
        session_unset();
        session_destroy();
        $_SESSION = array();

        //clear and destroy all cookies
        $this->app->deleteCookie('USER_ID');
        $this->app->deleteCookie('USER_NAME');

        //redirect user
        $this->app->flashNow('error','You have been logged out.');
        $this->app->flashKeep();
        $this->app->redirect('login');
    }

    public function dashboard_get(){
        $this->app->render('admin/dashboard.twig',$this->data);
    }
}
