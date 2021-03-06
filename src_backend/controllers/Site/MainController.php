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
        $this->data['title'] = 'SITE';

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
        $this->app->render('/site/content/home.twig',$this->data);
    }

            public function admins_index(){
            $this->data['menu'] = 'admins';
            //
            $this->app->render('/site/content/admins.twig',$this->data);
        }
            public function contato_index(){
            $this->data['menu'] = 'contato';
            //
            $this->app->render('/site/content/contato.twig',$this->data);
        }
            public function estrutura_index(){
            $this->data['menu'] = 'estrutura';
            //
            $this->app->render('/site/content/estrutura.twig',$this->data);
        }
            public function etapas_index(){
            $this->data['menu'] = 'etapas';
            //
            $this->app->render('/site/content/etapas.twig',$this->data);
        }
            public function etapas_estrutura_index(){
            $this->data['menu'] = 'etapas-estrutura';
            //
            $this->app->render('/site/content/etapas-estrutura.twig',$this->data);
        }
            public function etapas_fotos_index(){
            $this->data['menu'] = 'etapas-fotos';
            //
            $this->app->render('/site/content/etapas-fotos.twig',$this->data);
        }
            public function fotos_index(){
            $this->data['menu'] = 'fotos';
            //
            $this->app->render('/site/content/fotos.twig',$this->data);
        }
            public function imprensa_index(){
            $this->data['menu'] = 'imprensa';
            //
            $this->app->render('/site/content/imprensa.twig',$this->data);
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


}