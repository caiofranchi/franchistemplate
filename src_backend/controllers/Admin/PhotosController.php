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

        //morphToMany
        $this->data['portfolio'] =  \Portfolio::all();
        $this->data['noticias'] =  \Noticias::all();

        //render css assets
        $this->loadCss('vendor/jquery.fileupload.css');
        $this->loadCss('vendor/jquery.fileupload-ui.css');

        //render js assets
        $this->loadJs('vendor/jquery.ui.widget.js');
        $this->loadJs('vendor/jquery.fileupload.js');
        $this->loadJs('vendor/jquery.iframe-transport.js');
        $this->loadJs('vendor/jquery.fileupload-process.js');
        $this->loadJs('vendor/jquery.fileupload-image.js');

        $this->app->render('admin/fotos/edit.twig',$this->data);
    }

    public function upload_post($id = '') {
        header("Content-Type: application/json");

        $upload_handler = new \UploadHandler(array(
            'upload_dir' => PUBLIC_PATH.'assets/uploads/',
            'upload_url' => $this->baseUrl().'assets/uploads/',
            'mkdir_mode' => 0777,

            'image_versions' => array(
                // The empty image version key defines options for the original image:
                '' => array(
                    // Automatically rotate images based on EXIF meta data:
                    'auto_orient' => true
                ),
                'high' => array(
                    'max_width' => 825,
                    'max_height' => 555
                ),
                'medium' => array(
                    'max_width' => 480,
                    'max_height' => 380
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
                    'max_width' => 200,
                    'max_height' => 200
                )
            )
//            'post_max_size' =>
        ));

        exit;
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
        $categoria->path = $params['path'];
        $categoria->connection_type = $params['connection_type'];
        $categoria->connection_id = $params['connection_id'];
        $categoria->description = $params['description'];

        //save
        if($id = $categoria->save()){
            $this->app->flashNow('success', 'Registered');
        }else {
            $this->app->flashNow('error', 'Not possible at this time, try again later.');
        }

        //file upload rename


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
