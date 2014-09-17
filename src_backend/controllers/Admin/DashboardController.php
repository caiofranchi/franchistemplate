<?php
/**
 * Created by PhpStorm.
 * User: cfranchi
 * Date: 06/08/14
 * Time: 15:12
 */


namespace Admin;

use Slim\Slim;

class DashboardController extends GeneralAdminController {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $this->data['menu'] = 'dashboard';
        //
                    $this->data['total_admins'] = \Admins::all()->count();
                    $this->data['total_contato'] = \Contato::all()->count();
                    $this->data['total_estrutura'] = \Estrutura::all()->count();
                    $this->data['total_etapas'] = \Etapas::all()->count();
                    $this->data['total_etapas_estrutura'] = \EtapasEstrutura::all()->count();
                    $this->data['total_etapas_fotos'] = \EtapasFotos::all()->count();
                    $this->data['total_fotos'] = \Fotos::all()->count();
                    $this->data['total_imprensa'] = \Imprensa::all()->count();
                //
        $this->app->render('/admin/dashboard.twig',$this->data);
    }

}
