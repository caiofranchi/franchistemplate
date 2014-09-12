<?php

/**
 * Created by PhpStorm.
 * User: cfranchi
 * Date: 06/08/14
 * Time: 15:50
 */

namespace Generator;

use Illuminate\Database\Capsule\Manager;
use Illuminate\Support\Facades\DB;
use Slim\Slim;


class GeneratorController extends \GeneralController
{

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
        $this->data['assetUrl'] = $this->data['baseUrl'].'admin/assets/';

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
        $this->loadCss("vendor/bootstrap.min.css");
        $this->loadCss("main.css");
    }

    /**
     * load base js for the template
     */
    protected function loadBaseJs()
    {
        $this->loadJs("vendor/jquery-1.10.2.js");
        $this->loadJs("vendor/bootstrap.min.js");
        $this->loadJs("main.js");
    }

    /**
     * INTERNALS
     */


    public function index(){
        $dbName = 'vagrant_dev';
        $tables = Manager::select('SHOW TABLES');
        $responseTable = array();

        for($i=0;$i<count($tables);$i++){
            $tableName = $tables[$i]['Tables_in_'.$dbName];
            $tableCollumns = Manager::select('SHOW COLUMNS FROM '.$tableName);

            array_push($responseTable, array(
                'name'=>$tableName,
                'fields'=>$tableCollumns
            ));

        }

//        echo json_encode($responseTable);
//        die;

        $this->data['data'] = $responseTable;

        $this->app->render('/generator/generator.twig',$this->data);
    }

}