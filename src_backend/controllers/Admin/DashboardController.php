<?php
/**
 * Created by PhpStorm.
 * User: cfranchi
 * Date: 06/08/14
 * Time: 15:12
 */


namespace Admin;

use Slim\Slim;

class DashboardController extends GeneralAdminController {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $this->data['menu'] = 'dashboard';
        //
        $this->data['total_fotos'] = \Photos::all()->count();
        $this->data['total_categorias'] = \Categorias::all()->count();
        $this->data['total_noticias'] = \Noticias::all()->count();
        $this->data['total_portfolio'] = \Portfolio::all()->count();
        $this->data['total_contatos'] = \Contato::all()->count();
        //
        $this->app->render('/admin/dashboard.twig',$this->data);
    }

}
