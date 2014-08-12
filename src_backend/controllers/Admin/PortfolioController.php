<?php
/**
 * Created by PhpStorm.
 * User: cfranchi
 * Date: 06/08/14
 * Time: 15:12
 */


namespace Admin;

use Slim\Slim;

class PortfolioController extends GeneralAdminController {

    public function __construct() {

        parent::__construct();

        $this->data['page_name'] = 'Portfolio';
        $this->data['menu'] = 'portfolio';

        $this->data['title'] = 'Admin - Portfolio';

    }

    public function index() {
        $this->data['action'] = 'list';

        $allPortfolio = \Portfolio::all();
        $total = count($allPortfolio);


        $this->data['totalPages'] = $total/$this->pageLimit;
        $this->data['currentPage'] = $this->currentPage;
        $this->data['previousPage'] = $this->currentPage-1;
        $this->data['nextPage'] = $this->currentPage+1;
//var_dump(\Portfolio::find(1)->categorias);
//        die();
        $this->data['table'] = \Portfolio::find(1)->categorias()->get();
//        $this->data['table'] =  \Portfolio::take($this->pageLimit)->skip($this->pageLimit*($this->currentPage-1))->orderBy('updated_at')->get();

        $this->app->render('admin/portfolio/list.twig',$this->data);
    }

    public function page_get($page) {
        $this->data['action'] = 'list';

        //assign requested page
        $this->currentPage = $page;


        $total = count(\Portfolio::all());

        $this->data['totalPages'] = $total/$this->pageLimit;
        $this->data['currentPage'] = $this->currentPage;
        $this->data['previousPage'] = $this->currentPage-1;
        $this->data['nextPage'] = $this->currentPage+1;

        $this->data['table'] =  \Portfolio::take($this->pageLimit)->skip($this->pageLimit*($this->currentPage-1))->orderBy('ordem')->get();

        $this->app->render('admin/portfolio/list.twig',$this->data);
    }

    public function edit_get($id = '') {
        if($id=='') {
            $this->data['action'] = 'create';
        }else {
            $this->data['action'] = 'edit';
        }

        //suggests a max order
        $this->data['maxOrder'] = \Portfolio::all()->max('ordem')+1;
        //
        $this->data['table'] =  \Portfolio::find($id);

        $this->app->render('admin/portfolio/edit.twig',$this->data);
    }

    public function edit_post(){

        $this->data['action'] = 'create';

        $params = $this->app->request->post();

        if($params['id']=='') {
            //create
            $categoria = new \Portfolio();
        }else {
            //edit
            $categoria = \Portfolio::find($params['id']);
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

        $this->app->render('admin/portfolio/edit.twig',$this->data);
    }

    public function delete_get($id) {
        //
        $categoria = \Portfolio::find($id);
        $categoria->delete();
        $this->app->flashNow('warning', 'Successfully deleted');

        $this->app->redirect('/admin/categorias');
    }

    public function search_get($search){
        $categoria = new \Portfolio;

        $value = urldecode($search);

        $query = "(";
        $total = count(\Portfolio::$searchable);
        for($i=0;$i<$total;$i++) {
            $searchableField = \Portfolio::$searchable[$i];
            $query .= $searchableField." LIKE '%".$value."%'";
            $query .= ($i==$total-1) ? ') AND deleted_at IS NULL' : ' OR '; //excluding soft deleted from the search query
        }

        $this->data['table'] =  $categoria->whereRAW($query)->get();

        $this->data['action'] = 'Search by "'.$value.'" resulted in "'.$this->data['table']->count().'" term(s)';

        $this->app->render('admin/portfolio/list.twig',$this->data);

    }
}
