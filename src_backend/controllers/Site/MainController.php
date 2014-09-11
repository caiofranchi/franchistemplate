<?php

/**
 * Created by PhpStorm.
 * User: cfranchi
 * Date: 06/08/14
 * Time: 15:50
 */

namespace Site;

use Slim\Slim;


class MainController extends \GeneralController
{

    protected $pageLimit = 8;
    protected $currentPage = 1;

    public function __construct()
    {
        parent::__construct();

        $this->app = Slim::getInstance();
//        $this->data = array();

        /** default title */
        $this->data['title'] = 'EMED';

        /** meta tag and information */
        $this->data['meta'] = array();

        /** queued css files */
        $this->data['css'] = array(
            'internal'  => array(),
            'external'  => array()
        );

        /** queued js files */
        $this->data['js'] = array(
            'internal'  => array(),
            'external'  => array()
        );

        /** prepared message info */
        $this->data['message'] = array(
            'error'    => array(),
            'info'    => array(),
            'debug'    => array(),
        );

        /** global javascript var */
        $this->data['global'] = array();

        /** base dir for asset file */
        $this->data['baseUrl']  = $this->baseUrl();
        $this->data['siteUrl']  = $this->app->request->getResourceUri();
        $this->data['assetUrl'] = $this->data['baseUrl'].'assets/';

        $this->loadBaseCss();
        $this->loadBaseJs();

        /** global javascript var */
        $this->data['global'] = array(
            'mainUrl' => $this->baseUrl()
        );

        //menu portfolio categorias
        $this->data['categorias'] = \Categorias::orderBy('ordem','ASC')->get();
    }

    /**
     * load base css for the template
     */
    protected function loadBaseCss()
    {
        $this->loadCss("style.min.css");
    }

    /**
     * load base js for the template
     */
    protected function loadBaseJs()
    {
        $this->loadJs("vendor/jquery.js");
        $this->loadJs("scripts.min.js");
    }

    /**
     * INTERNALS
     */


    public function home(){
        $this->data['menu'] = 'home';
        //
        $mobile = new \Mobile_Detect();
        if($mobile->isTablet() || $mobile->isMobile()){
            $this->app->render('/site/content/home_mobile.twig',$this->data);
        } else {
            $this->app->render('/site/content/home.twig',$this->data);
        }

    }

    public function empresa(){
        $this->data['menu'] = 'empresa';
        //
        $this->app->render('/site/content/empresa.twig',$this->data);
    }

    public function contato_get(){
        $this->data['menu'] = 'contato';
        //
        $this->loadJs('vendor/jquery.ui.widget.js');
        $this->loadJs('vendor/jquery.fileupload.js');
        $this->loadJs('vendor/jquery.iframe-transport.js');
        $this->loadJs('vendor/jquery.fileupload-process.js');
        $this->loadJs('vendor/jquery.fileupload-image.js');
        //
        $this->app->render('/site/content/contato.twig',$this->data);
    }

    public function contato_upload(){
        $this->data['menu'] = 'contato';
        //
        header("Content-Type: application/json");


        $pathToUpload = PUBLIC_PATH.'assets/uploads/cv/';
        $URLToUpload = $this->baseUrl().'assets/uploads/cv/';
        $upload_handler = new \UploadHandler(array(
            'upload_dir' => $pathToUpload,
            'upload_url' => $URLToUpload,
            'mkdir_mode' => 0777,
            'random_name' => true,
        ));
            //md5(uniqid(rand()))
        exit;

        $this->app->render('/site/content/contato.twig',$this->data);
    }

    public function contato_post(){
//        header("Content-Type: application/json");

        //assign
        $params = $this->app->request->post();

        $contato = new \Contato();

        $contato->nome = $params['nome'];
        $contato->email = $params['email'];
        $contato->mensagem = $params['mensagem'];
        $contato->curriculo = $params['path'];
        $contato->ip = \Utils::get_real_ip();

        if($contato->save()){
            $this->app->flashKeep('success', 'Cadastrado com sucesso.');
        }else {
            $this->app->flashKeep('error', 'Ocorreu um erro, tente novamente mais tarde.');
        }

        echo 'success';
        exit;
    }

    public function noticias($slug=''){
        $this->data['menu'] = 'noticias';
        //
        if(!$this->app->request->isAjax()){
            $this->data['table'] = \Noticias::with('photos')->get();
        }

        //esta abrindo um item do portfolio
        if($slug!==''){
            $this->data['interna'] = \Noticias::where('slug', '=', $slug)->with('photos')->first();

            //if is ajax request
            if($this->app->request->isAjax()){
                $this->app->render('/site/content/noticias-item.twig',$this->data);
            }
        }

        //
        if(!$this->app->request->isAjax()){
            $this->app->render('/site/content/noticias.twig',$this->data);
        }
    }

    public function portfolio($slugCategoria,$slugPortfolio=''){
        $this->data['menu'] = 'portfolio';
        $this->data['categoria'] = $slugCategoria;


        if(!$this->app->request->isAjax()){
            //listar categorias, ordenando a atual como primeira
            $this->data['categorias'] = \Categorias::whereRAW('id > 0 ORDER BY slug="'.$slugCategoria.'" DESC, ordem ASC')->get();

            //lista os produtos da categoria, através do slug de cada um
            $catID = \Categorias::where('slug', '=', $slugCategoria)->pluck('id');
            $this->data['table'] = \Portfolio::where('categoria_id', '=', $catID)->with('categorias')->with('photos')->get();
        }

        //esta abrindo um item do portfolio
        if($slugPortfolio!==''){
            $this->data['interna'] = \Portfolio::where('slug', '=', $slugPortfolio)->with('categorias')->with('photos')->first();

            //if is ajax request
            if($this->app->request->isAjax()){
                $this->app->render('/site/content/portfolio-item.twig',$this->data);
            }
        }

        //
        if(!$this->app->request->isAjax()){
            $this->app->render('/site/content/portfolio.twig',$this->data);
        }

    }

//    public function portfolio_item($slugCategoria,$slugPortfolio=''){
//        $this->data['menu'] = 'portfolio';
//        $this->data['categoria'] = $slugCategoria;
//        //
//        $this->app->render('/site/content/portfolio-item.twig',$this->data);
//    }
}