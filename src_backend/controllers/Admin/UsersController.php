<?php
/**
 * Created by PhpStorm.
 * User: cfranchi
 * Date: 06/08/14
 * Time: 15:12
 */


namespace Admin;

use Slim\Slim;

class UsersController extends \GeneralController {


    public function index() {
        $this->app->render('admin/users_list.twig');
    }

}
