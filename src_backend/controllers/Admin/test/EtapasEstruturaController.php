<?php
/**
 * Created by PhpStorm.
 * User: cfranchi
 * Date: 06/08/14
 * Time: 15:12
 */


namespace Admin;

use Slim\Slim;

class EtapasEstruturaController extends GeneralAdminController {

    public function __construct() {

        parent::__construct();

        $this->data['page_name'] = 'EtapasEstrutura';
        $this->data['menu'] = 'etapas-estrutura';

    }

    public function index() {
        $this->data['action'] = 'list';

        $total = \EtapasEstrutura::all()->count();

        $this->data['totalPages'] = $total/$this->pageLimit;
        $this->data['currentPage'] = $this->currentPage;
        $this->data['previousPage'] = $this->currentPage-1;
        $this->data['nextPage'] = $this->currentPage+1;

        $queryModel = new \EtapasEstrutura();
        $result = $queryModel->take($this->pageLimit)->skip($this->pageLimit*($this->currentPage-1))->orderBy('updated_at','DESC')->get();

        //assign view data from table
        $this->data['table'] = $result;

        $this->app->render('admin/etapas-estrutura/list.twig',$this->data);
    }

    public function page_get($page) {
        $this->data['action'] = 'list';

        //assign requested page
        $this->currentPage = $page;


        $total = count(\EtapasEstrutura::all());

        $this->data['totalPages'] = $total/$this->pageLimit;
        $this->data['currentPage'] = $this->currentPage;
        $this->data['previousPage'] = $this->currentPage-1;
        $this->data['nextPage'] = $this->currentPage+1;

        $this->data['table'] =  \EtapasEstrutura::take($this->pageLimit)->skip($this->pageLimit*($this->currentPage-1))->orderBy('updated_at','DESC')->get();

        $this->app->render('admin/etapas-estrutura/list.twig',$this->data);
    }

    public function edit_get($id = '') {

        //
        $this->data['table'] =  \EtapasEstrutura::find($id);

        //
        $this->data['categorias'] =  \Categorias::all(); //relation
        if($id=='') {
        $this->data['action'] = 'create';
        }else {
        $this->data['action'] = 'edit';
        $this->data['photos_related'] = $this->data['table']->photos()->get();
        }

        $this->loadJs("vendor/parsley.min.js");
        $this->app->render('admin/etapas-estrutura/edit.twig',$this->data);
    }

    public function edit_post(){

        $this->data['action'] = 'create';

        $params = $this->app->request->post();

        if($params['id']=='') {
            //create
            $model = new \EtapasEstrutura();
        }else {
            //edit
            $model = \EtapasEstrutura::find($params['id']);
        }

        //assign
                                                        
        //save
        if($model->save()){
            $this->app->flashKeep('success', 'Registered');
        }else {
            $this->app->flashKeep('error', 'Not possible at this time, try again later.');
        }


        $this->app->redirect('/admin/EtapasEstrutura');
    }

    public function delete_get($id) {
        //
        $model = \EtapasEstrutura::find($id);
        $model->delete();
        $this->app->flashNow('warning', 'Successfully deleted');

        $this->app->redirect('/admin/EtapasEstrutura');
    }

    public function search_get($search){

        $value = urldecode($search);

        $query = "(";
        $total = count(\EtapasEstrutura::$searchable);
        for($i=0;$i<$total;$i++) {
            $searchableField = \EtapasEstrutura::$searchable[$i];
            $query .= $searchableField." LIKE '%".$value."%'";
            $query .= ($i==$total-1) ? ') AND deleted_at IS NULL' : ' OR '; //excluding soft deleted from the search query
        }

        $this->data['table'] =  \EtapasEstrutura::whereRAW($query)->get();

        $this->data['action'] = 'Search by "'.$value.'" resulted in "'.$this->data['table']->count().'" term(s)';

        $this->app->render('admin/etapas-estrutura/list.twig',$this->data);

    }
}
