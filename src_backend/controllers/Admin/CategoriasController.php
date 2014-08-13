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
        $this->data['menu'] = 'categorias';

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

    public function edit_get($id = '') {
        if($id=='') {
            $this->data['action'] = 'create';
        }else {
            $this->data['action'] = 'edit';
        }

        //suggests a max order
        $this->data['maxOrder'] = \Categorias::all()->max('ordem')+1;
        //
        $this->data['table'] =  \Categorias::find($id);

        $this->app->render('admin/categorias/edit.twig',$this->data);
    }

    public function edit_post(){

        $this->data['action'] = 'create';

        $params = $this->app->request->post();

        if($params['id']=='') {
            //create
            $categoria = new \Categorias();
        }else {
            //edit
            $categoria = \Categorias::find($params['id']);
        }

        //assign
        $categoria->nome = $params['nome'];
        $categoria->slug = $params['slug'];
        $categoria->ordem = $params['ordem'];
        $categoria->descricao = $params['descricao'];

        //save
        if($categoria->save()){
            $this->app->flashNow('success', 'Registered');
        }else {
            $this->app->flashNow('error', 'Not possible at this time, try again later.');
        }

        $this->app->render('admin/categorias/edit.twig',$this->data);
    }

    public function delete_get($id) {
        //
        $categoria = \Categorias::find($id);
        $categoria->delete();
        $this->app->flashNow('warning', 'Successfully deleted');

        $this->app->redirect('/admin/categorias');
    }

    public function search_get($search){
        $value = urldecode($search);

        $query = "(";
        $total = count(\Categorias::$searchable);
        for($i=0;$i<$total;$i++) {
            $searchableField = \Categorias::$searchable[$i];
            $query .= $searchableField." LIKE '%".$value."%'";
            $query .= ($i==$total-1) ? ') AND deleted_at IS NULL' : ' OR '; //excluding soft deleted from the search query
        }

        $this->data['table'] =  \Categorias::whereRAW($query)->get();

        $this->data['action'] = 'Search by "'.$value.'" resulted in "'.$this->data['table']->count().'" term(s)';

        $this->app->render('admin/categorias/list.twig',$this->data);

    }
}
