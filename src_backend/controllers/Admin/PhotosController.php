<?php
/**
 * Created by PhpStorm.
 * User: cfranchi
 * Date: 06/08/14
 * Time: 15:12
 */


namespace Admin;

use Slim\Slim;

class PhotosController extends GeneralAdminController {

    public function __construct() {

        parent::__construct();

        $this->data['page_name'] = 'Fotos';
        $this->data['menu'] = 'fotos';

        $this->data['title'] = 'Admin - Fotos';


    }

    public function index() {
        $this->data['action'] = 'list';

        $total = \Photos::all()->count();

        $this->data['totalPages'] = $total/$this->pageLimit;
        $this->data['currentPage'] = $this->currentPage;
        $this->data['previousPage'] = $this->currentPage-1;
        $this->data['nextPage'] = $this->currentPage+1;

        $queryModel = new \Photos();
        $result = $queryModel->take($this->pageLimit)->skip($this->pageLimit*($this->currentPage-1))->orderBy('updated_at')->get();

        //assign view data from table
        $this->data['table'] = $result;

        $this->app->render('admin/fotos/list.twig',$this->data);
    }

    public function page_get($page) {
        $this->data['action'] = 'list';

        //assign requested page
        $this->currentPage = $page;


        $total = count(\Photos::all());

        $this->data['totalPages'] = $total/$this->pageLimit;
        $this->data['currentPage'] = $this->currentPage;
        $this->data['previousPage'] = $this->currentPage-1;
        $this->data['nextPage'] = $this->currentPage+1;

        $this->data['table'] =  \Photos::take($this->pageLimit)->skip($this->pageLimit*($this->currentPage-1))->orderBy('ordem')->get();

        $this->app->render('admin/fotos/list.twig',$this->data);
    }

    public function edit_get($id = '') {
        if($id=='') {
            $this->data['action'] = 'create';
        }else {
            $this->data['action'] = 'edit';
        }
        //
        $this->data['table'] =  \Photos::find($id);

        $this->app->render('admin/fotos/edit.twig',$this->data);
    }

    public function edit_post(){

        $this->data['action'] = 'create';

        $params = $this->app->request->post();

        if($params['id']=='') {
            //create
            $categoria = new \Photos();
        }else {
            //edit
            $categoria = \Photos::find($params['id']);
        }

        //assign
        $categoria->titulo = $params['titulo'];
        $categoria->slug = $params['slug'];
        $categoria->categoria_id = $params['categoria_id'];
        $categoria->localizacao = $params['localizacao'];
        $categoria->ano = $params['ano'];
        $categoria->metragem = $params['metragem'];
        $categoria->descricao = $params['descricao'];

        //save
        if($categoria->save()){
            $this->app->flashNow('success', 'Registered');
        }else {
            $this->app->flashNow('error', 'Not possible at this time, try again later.');
        }

        //render css assets
        $this->loadCss('vendor/jquery.fileupload.css');
        $this->loadCss('vendor/jquery.fileupload-ui.css');

        //render js assets
        $this->loadJs('vendor/jquery.ui.widget.js');
        $this->loadJs('vendor/jquery.fileupload.js');
        $this->loadJs('vendor/jquery.iframe-transport.js');

        $this->app->render('admin/fotos/edit.twig',$this->data);
    }

    public function delete_get($id) {
        //
        $categoria = \Photos::find($id);
        $categoria->delete();
        $this->app->flashNow('warning', 'Successfully deleted');

        $this->app->redirect('/admin/fotos');
    }

    public function search_get($search){

        $value = urldecode($search);

        $query = "(";
        $total = count(\Photos::$searchable);
        for($i=0;$i<$total;$i++) {
            $searchableField = \Photos::$searchable[$i];
            $query .= $searchableField." LIKE '%".$value."%'";
            $query .= ($i==$total-1) ? ') AND deleted_at IS NULL' : ' OR '; //excluding soft deleted from the search query
        }

        $this->data['table'] =  \Photos::with('categorias')->whereRAW($query)->get();

        $this->data['action'] = 'Search by "'.$value.'" resulted in "'.$this->data['table']->count().'" term(s)';

        $this->app->render('admin/fotos/list.twig',$this->data);

    }
}
