<?php
/**
 * Created by PhpStorm.
 * User: cfranchi
 * Date: 06/08/14
 * Time: 15:12
 */


namespace Admin;

use Slim\Slim;

class FotosController extends GeneralAdminController {

    public function __construct() {

        parent::__construct();

        $this->data['page_name'] = 'Fotos';
        $this->data['menu'] = 'fotos';

    }

    public function index() {
        $this->data['action'] = 'list';

        $total = \Fotos::all()->count();

        $this->data['totalPages'] = $total/$this->pageLimit;
        $this->data['currentPage'] = $this->currentPage;
        $this->data['previousPage'] = $this->currentPage-1;
        $this->data['nextPage'] = $this->currentPage+1;

        $queryModel = new \Fotos();
        $result = $queryModel->take($this->pageLimit)->skip($this->pageLimit*($this->currentPage-1))->orderBy('updated_at','DESC')->get();

        //assign view data from table
        $this->data['table'] = $result;

        $this->app->render('admin/fotos/list.twig',$this->data);
    }

    public function page_get($page) {
        $this->data['action'] = 'list';

        //assign requested page
        $this->currentPage = $page;


        $total = count(\Fotos::all());

        $this->data['totalPages'] = $total/$this->pageLimit;
        $this->data['currentPage'] = $this->currentPage;
        $this->data['previousPage'] = $this->currentPage-1;
        $this->data['nextPage'] = $this->currentPage+1;

        $this->data['table'] =  \Fotos::take($this->pageLimit)->skip($this->pageLimit*($this->currentPage-1))->orderBy('updated_at','DESC')->get();

        $this->app->render('admin/fotos/list.twig',$this->data);
    }

    public function edit_get($id = '') {

        //
        $this->data['table'] =  \Fotos::find($id);

        //
                if($id=='') {
        $this->data['action'] = 'create';
        }else {
        $this->data['action'] = 'edit';
                }


                        
                                                

        $this->loadJs("vendor/parsley.min.js");

        $this->app->render('admin/fotos/edit.twig',$this->data);
    }

    public function edit_post(){

        $this->data['action'] = 'create';

        $params = $this->app->request->post();

        if($params['id']=='') {
            //create
            $model = new \Fotos();
        }else {
            //edit
            $model = \Fotos::find($params['id']);
        }

        //assign

                                    $model->caminho = $params['caminho'];
                                                $model->titulo = $params['titulo'];
                                                $model->descricao = $params['descricao'];
                    

        //save
        if($model->save()){
            $this->app->flashKeep('success', 'Registered');
        }else {
            $this->app->flashKeep('error', 'Not possible at this time, try again later.');
        }

        

        $this->app->redirect('/admin/fotos');
    }

    public function upload_post($id = '') {
        header("Content-Type: application/json");

        $upload_handler = new \UploadHandler(array(
        'upload_dir' => $this->pathToUpload,
        'upload_url' => $this->URLToUpload,
        'mkdir_mode' => 0777,

        'image_versions' => array(
            // The empty image version key defines options for the original image:
            '' => array(
            // Automatically rotate images based on EXIF meta data:
            'auto_orient' => true
            ),
            'high' => array(
            'max_width' => 1400,
            'max_height' => 942
            ),
            'medium' => array(
            'max_width' => 631,//480,
            'max_height' => 500// 380
            ),
            'thumbnail' => array(
                // Uncomment the following to use a defined directory for the thumbnails
                // instead of a subdirectory based on the version identifier.
                // Make sure that this directory doesn't allow execution of files if you
                // don't pose any restrictions on the type of uploaded files, e.g. by
                // copying the .htaccess file from the files directory for Apache:
                //'upload_dir' => dirname($this->get_server_var('SCRIPT_FILENAME')).'/thumb/',
                //'upload_url' => $this->get_full_url().'/thumb/',
                // Uncomment the following to force the max
                // dimensions and e.g. create square thumbnails:
                //'crop' => true,
                'max_width' => 300,
                'max_height' => 300
            )
        )
        //            'post_max_size' =>
        ));

        exit;
    }

    public function delete_get($id) {
        //
        $model = \Fotos::find($id);
        $model->delete();
        $this->app->flashNow('warning', 'Successfully deleted');

        $this->app->redirect('/admin/Fotos');
    }

    public function search_get($search){

        $value = urldecode($search);

        $query = "(";
        $total = count(\Fotos::$searchable);
        for($i=0;$i<$total;$i++) {
            $searchableField = \Fotos::$searchable[$i];
            $query .= $searchableField." LIKE '%".$value."%'";
            $query .= ($i==$total-1) ? ') AND deleted_at IS NULL' : ' OR '; //excluding soft deleted from the search query
        }

        $this->data['table'] =  \Fotos::whereRAW($query)->get();

        $this->data['action'] = 'Search by "'.$value.'" resulted in "'.$this->data['table']->count().'" term(s)';

        $this->app->render('admin/fotos/list.twig',$this->data);

    }
}
