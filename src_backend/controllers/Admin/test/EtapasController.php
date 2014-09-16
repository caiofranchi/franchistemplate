<?php
/**
 * Created by PhpStorm.
 * User: cfranchi
 * Date: 06/08/14
 * Time: 15:12
 */


namespace Admin;

use Slim\Slim;

class EtapasController extends GeneralAdminController {

    public function __construct() {

        parent::__construct();

        $this->data['page_name'] = 'Etapas';
        $this->data['menu'] = 'etapas';

    }

    public function index() {
        $this->data['action'] = 'list';

        $total = \Etapas::all()->count();

        $this->data['totalPages'] = $total/$this->pageLimit;
        $this->data['currentPage'] = $this->currentPage;
        $this->data['previousPage'] = $this->currentPage-1;
        $this->data['nextPage'] = $this->currentPage+1;

        $queryModel = new \Etapas();
        $result = $queryModel->take($this->pageLimit)->skip($this->pageLimit*($this->currentPage-1))->orderBy('updated_at','DESC')->get();

        //assign view data from table
        $this->data['table'] = $result;

        $this->app->render('admin/etapas/list.twig',$this->data);
    }

    public function page_get($page) {
        $this->data['action'] = 'list';

        //assign requested page
        $this->currentPage = $page;


        $total = count(\Etapas::all());

        $this->data['totalPages'] = $total/$this->pageLimit;
        $this->data['currentPage'] = $this->currentPage;
        $this->data['previousPage'] = $this->currentPage-1;
        $this->data['nextPage'] = $this->currentPage+1;

        $this->data['table'] =  \Etapas::take($this->pageLimit)->skip($this->pageLimit*($this->currentPage-1))->orderBy('updated_at','DESC')->get();

        $this->app->render('admin/etapas/list.twig',$this->data);
    }

    public function edit_get($id = '') {

        //
        $this->data['table'] =  \Etapas::find($id);

        //
        $this->data['categorias'] =  \Categorias::all(); //relation
        if($id=='') {
        $this->data['action'] = 'create';
        }else {
        $this->data['action'] = 'edit';
        $this->data['photos_related'] = $this->data['table']->photos()->get();
        }


                        
                                                

        $this->loadJs("vendor/parsley.min.js");

        $this->app->render('admin/etapas/edit.twig',$this->data);
    }

    public function edit_post(){

        $this->data['action'] = 'create';

        $params = $this->app->request->post();

        if($params['id']=='') {
            //create
            $model = new \Etapas();
        }else {
            //edit
            $model = \Etapas::find($params['id']);
        }

        //assign
                                    $model->nome = $params['nome'];
                                                $model->slug = $params['slug'];
                                                $model->data_inicio = \DateUtils::convert_brazilian_date_to_mysql($params['data_inicio']);
                                                $model->data_fim = \DateUtils::convert_brazilian_date_to_mysql($params['data_fim']);
                                                $model->localizacao = $params['localizacao'];
                                                $model->retirada = $params['retirada'];
                                                $model->regulamento_arquivo = $params['regulamento_arquivo'];
                                                $model->regulamento = $params['regulamento'];
                                                $model->manual = $params['manual'];
                                                $model->cor = $params['cor'];
                    
        //save
        if($model->save()){
            $this->app->flashKeep('success', 'Registered');
        }else {
            $this->app->flashKeep('error', 'Not possible at this time, try again later.');
        }


        $this->app->redirect('/admin/Etapas');
    }

    public function delete_get($id) {
        //
        $model = \Etapas::find($id);
        $model->delete();
        $this->app->flashNow('warning', 'Successfully deleted');

        $this->app->redirect('/admin/Etapas');
    }

    public function search_get($search){

        $value = urldecode($search);

        $query = "(";
        $total = count(\Etapas::$searchable);
        for($i=0;$i<$total;$i++) {
            $searchableField = \Etapas::$searchable[$i];
            $query .= $searchableField." LIKE '%".$value."%'";
            $query .= ($i==$total-1) ? ') AND deleted_at IS NULL' : ' OR '; //excluding soft deleted from the search query
        }

        $this->data['table'] =  \Etapas::whereRAW($query)->get();

        $this->data['action'] = 'Search by "'.$value.'" resulted in "'.$this->data['table']->count().'" term(s)';

        $this->app->render('admin/etapas/list.twig',$this->data);

    }
}
