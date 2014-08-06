<?php
/**
 * Created by PhpStorm.
 * User: cfranchi
 * Date: 06/08/14
 * Time: 15:12
 */


namespace Admin;

use Slim\Slim;

class AdminController extends \GeneralController {

    /**
     * Middle layer method for verify user on routes
     * Checking if the user is logged on admin
     */
    public function authenticate(\Slim\Route $route) {
        $app = \Slim\Slim::getInstance();

        if(!$this->isUserLogged()) {
//        $response["error"] = true;
//        $response["message"] = "Access Denied.";
//        echoRespnse(401, $response);
//        $app->stop();
            $app->redirect('login');
        }
    }

    /**
     * Verify if the user is logged on admin
     * @return bool
     */
    public function isUserLogged(){
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
}
