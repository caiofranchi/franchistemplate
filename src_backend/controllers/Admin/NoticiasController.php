<?php
/**
 * Created by PhpStorm.
 * User: cfranchi
 * Date: 06/08/14
 * Time: 15:12
 */


namespace Admin;

use Slim\Slim;

class NoticiasController extends GeneralAdminController {

    public function __construct() {

        parent::__construct();

        $this->data['page_name'] = 'Notícias';
        $this->data['menu'] = 'noticias';

        $this->data['title'] = 'Admin - Notícias';


    }

    public function index() {
        $this->data['action'] = 'list';

        $total = \Noticias::all()->count();

        $this->data['totalPages'] = $total/$this->pageLimit;
        $this->data['currentPage'] = $this->currentPage;
        $this->data['previousPage'] = $this->currentPage-1;
        $this->data['nextPage'] = $this->currentPage+1;

        $queryModel = new \Noticias();
        $result = $queryModel->take($this->pageLimit)->skip($this->pageLimit*($this->currentPage-1))->orderBy('updated_at')->get();

        //assign view data from table
        $this->data['table'] = $result;

        $this->app->render('admin/noticias/list.twig',$this->data);
    }

    public function page_get($page) {
        $this->data['action'] = 'list';

        //assign requested page
        $this->currentPage = $page;


        $total = count(\Noticias::all());

        $this->data['totalPages'] = $total/$this->pageLimit;
        $this->data['currentPage'] = $this->currentPage;
        $this->data['previousPage'] = $this->currentPage-1;
        $this->data['nextPage'] = $this->currentPage+1;

        $this->data['table'] =  \Noticias::take($this->pageLimit)->skip($this->pageLimit*($this->currentPage-1))->orderBy('ordem')->get();

        $this->app->render('admin/noticias/list.twig',$this->data);
    }

    public function edit_get($id = '') {

        //
        $this->data['table'] =  \Noticias::find($id);

        //
        
        if($id=='') {
            $this->data['action'] = 'create';
        }else {
            $this->data['action'] = 'edit';
            $this->data['photos_related'] = $this->data['table']->photos()->get();
        }

        $this->app->render('admin/noticias/edit.twig',$this->data);
    }

    public function edit_post(){

        $this->data['action'] = 'create';

        $params = $this->app->request->post();

        if($params['id']=='') {
            //create
            $categoria = new \Noticias();
        }else {
            //edit
            $categoria = \Noticias::find($params['id']);
        }

        //assign
        $categoria->titulo = $params['titulo'];
        $categoria->slug = $params['slug'];
        $categoria->tipo = $params['tipo'];
        $categoria->publicado = $params['publicado'];
        $categoria->video = $params['video'];
        $categoria->descricao = $params['descricao'];

        //save
        if($categoria->save()){
            $this->app->flashNow('success', 'Registered');
        }else {
            $this->app->flashNow('error', 'Not possible at this time, try again later.');
        }



        $this->app->render('admin/noticias/edit.twig',$this->data);
    }

    public function delete_get($id) {
        //
        $categoria = \Noticias::find($id);
        $categoria->delete();
        $this->app->flashNow('warning', 'Successfully deleted');

        $this->app->redirect('/admin/noticias');
    }

    public function search_get($search){

        $value = urldecode($search);

        $query = "(";
        $total = count(\Noticias::$searchable);
        for($i=0;$i<$total;$i++) {
            $searchableField = \Noticias::$searchable[$i];
            $query .= $searchableField." LIKE '%".$value."%'";
            $query .= ($i==$total-1) ? ') AND deleted_at IS NULL' : ' OR '; //excluding soft deleted from the search query
        }

        $this->data['table'] =  \Noticias::whereRAW($query)->get();

        $this->data['action'] = 'Search by "'.$value.'" resulted in "'.$this->data['table']->count().'" term(s)';

        $this->app->render('admin/noticias/list.twig',$this->data);

    }
}
