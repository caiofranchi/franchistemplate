<?php

/**
 * Created by PhpStorm.
 * User: cfranchi
 * Date: 06/08/14
 * Time: 15:50
 */

namespace Admin;

use Slim\Slim;


class GeneralAdminController extends \GeneralController
{

    protected $pageLimit = 10;
    protected $currentPage = 1;

    public function __construct()
    {
        parent::__construct();

        $this->app = Slim::getInstance();
        $this->data = array();

        /** default title */
        $this->data['title'] = 'Admin';

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
        $this->data['assetUrl'] = $this->data['baseUrl'].'admin/assets/';

        $this->loadBaseCss();
        $this->loadBaseJs();

        /** global javascript var */
        $this->data['global'] = array(
            'mainURL' => $this->baseUrl().'admin/'
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

}