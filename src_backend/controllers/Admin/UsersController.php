<?php
/**
 * Created by PhpStorm.
 * User: cfranchi
 * Date: 06/08/14
 * Time: 15:12
 */


namespace Admin;

use Slim\Slim;

class UsersController extends GeneralAdminController {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $this->app->render('admin/users_list.twig');
    }

    public function change_password(){
        $this->app->redirect('/admin/dashboard');
    }
}
