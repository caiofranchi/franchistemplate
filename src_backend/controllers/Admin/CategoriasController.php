<?php
/**
 * Created by PhpStorm.
 * User: cfranchi
 * Date: 06/08/14
 * Time: 15:12
 */


namespace Admin;

use Slim\Slim;

class CategoriasController extends GeneralAdminController {

    public function __construct() {
        parent::__construct();

        $this->data['page_name'] = 'Categorias';
        $this->data['active_menu'] = 'categorias';

        $this->data['title'] = 'Admin - Categorias';


    }

    public function index() {
        $this->data['action'] = 'list';

        $total = count(\Categorias::all());

        $this->data['totalPages'] = $total/$this->pageLimit;
        $this->data['currentPage'] = $this->currentPage;
        $this->data['previousPage'] = $this->currentPage-1;
        $this->data['nextPage'] = $this->currentPage+1;

        $this->data['table'] =  \Categorias::take($this->pageLimit)->skip($this->pageLimit*($this->currentPage-1))->orderBy('ordem')->get();

        $this->app->render('admin/categorias/list.twig',$this->data);
    }

    public function page_get($page) {
        $this->data['action'] = 'list';

        //assign requested page
        $this->currentPage = $page;


        $total = count(\Categorias::all());

        $this->data['totalPages'] = $total/$this->pageLimit;
        $this->data['currentPage'] = $this->currentPage;
        $this->data['previousPage'] = $this->currentPage-1;
        $this->data['nextPage'] = $this->currentPage+1;

        $this->data['table'] =  \Categorias::take($this->pageLimit)->skip($this->pageLimit*($this->currentPage-1))->orderBy('ordem')->get();

        $this->app->render('admin/categorias/list.twig',$this->data);
    }

    public function edit_get($id) {
        $this->data['action'] = 'edit';

        $this->data['table'] =  \Categorias::find($id);

        $this->app->render('admin/categorias/edit.twig',$this->data);
    }

    public function create_get(){
        $this->data['action'] = 'create';
        $this->app->render('admin/categorias/edit.twig',$this->data);
    }

    public function create_post(){
        $this->data['action'] = 'create';

        $params = $this->app->request->post();

        var_dump($params);

        $this->app->render('admin/categorias/edit.twig',$this->data);
    }

    public function search_get($search){
//        $filters = array('type_id','status','division','date_of_activation','date_of_closure');
//
//        foreach ($filters as $filter) {
//            $value = Input::get($filter);
//            if (!empty($value) && $value != -1) {//-1 is the value of 'ALL' option
//                $projects->where($filter,'=',$value);
//            }
//        }
//
//        $search = Input::get('search');
//
//        if (!empty($search)) {
//            $projects->whereRAW("MATCH(name,description) AGAINST(? IN BOOLEAN MODE)",array($search));
//        }
    }
}
