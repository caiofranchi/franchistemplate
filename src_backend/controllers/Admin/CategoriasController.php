<?php
/**
 * Created by PhpStorm.
 * User: cfranchi
 * Date: 06/08/14
 * Time: 15:12
 */


namespace Admin;

use Slim\Slim;

class CategoriasController extends \GeneralController {

    public function __construct() {
        parent::__construct();

        $this->data['page_name'] = 'Categorias';
        $this->data['active_menu'] = 'categorias';

        $this->data['title'] = 'Admin - Categorias';
    }

    public function index() {
        $this->data['action'] = 'list';

        $this->data['table'] =  \Categorias::take($this->pageLimit)->skip($this->pageLimit*($this->currentPage-1))->get();;

        $this->app->render('admin/categorias_list.twig',$this->data);
    }

    public function edit() {
        $this->data['action'] = 'list';

        $this->data['table'] =  \Categorias::find(1);

        $this->app->render('admin/categorias_edit.twig',$this->data);
    }
}
