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
        $this->data['title'] = 'ADMIN GENERATOR';

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

        $dbName = Manager::select('SELECT DATABASE()')[0]['DATABASE()'];
        $tables = Manager::select('SHOW TABLES');
        $responseTable = array();

        for($i=0;$i<count($tables);$i++){
            $tableName = $tables[$i]['Tables_in_'.$dbName];
            $tableCollumns = Manager::select('SHOW COLUMNS FROM '.$tableName.'  WHERE Field !=\'deleted_at\' AND Field!=\'updated_at\' AND Field!=\'created_at\'');

            array_push($responseTable, array(
                'name'=>$tableName,
                'modelName'=>\StringUtils::to_camel_case($tableName,true),
                'slug'=>\StringUtils::slugify($tableName),
                'fields'=>$tableCollumns
            ));

        }

//        echo json_encode($responseTable);
//        die;


        $this->data['data'] = $responseTable;

        $this->app->render('/generator/generator.twig',$this->data);
    }

    public function generate(){
        $this->data['action'] = 'generate';

        $params = $this->app->request->post();


        $loader = new \Twig_Loader_Filesystem(APP_PATH.'views/generator/');
        $twig = new \Twig_Environment($loader);

        $jsonResult['generator'] = array();
        $jsonResult['generator']['entities'] = array();

        $dbName = Manager::select('SELECT DATABASE()')[0]['DATABASE()'];
        $tables = Manager::select('SHOW TABLES');
        $responseTable = array();

        for($i=0;$i<count($tables);$i++){
            $tableName = $tables[$i]['Tables_in_'.$dbName];

            //add model name
            $modelName = $params['table_'.$tableName.'_model'];

            //add entity slug
            $slug = $params['table_'.$tableName.'_slug'];

            //add entity slug
            $isAdmin = ($params['table_'.$tableName.'_admin']);

            //add entity slug
            $isApi = ($params['table_'.$tableName.'_api']);

            $primaryKey = '';
            $foreignKeys = array();

            //ENTITY FIELDS
            $tableCollumns = Manager::select('SHOW COLUMNS FROM '.$tableName.'  WHERE Field !=\'deleted_at\' AND Field!=\'updated_at\' AND Field!=\'created_at\'');
            $fields = array();
            $searchableFields = array();

            for($k=0;$k<count($tableCollumns);$k++){
                //table
                $fieldName = $tableCollumns[$k]['Field'];
                $fieldType = $tableCollumns[$k]['Type'];
                $fieldKey = $tableCollumns[$k]['Key'];

                if ($fieldKey=='PRI') {
                    //PK
                    $primaryKey = $fieldName;
                }elseif ($fieldKey=='MUL'){
                    //FK
                    array_push($foreignKeys,$fieldName);
                }else {

                    //form
                    $fieldIsAdmin = $params['table_'.$tableName.'_field_'.$fieldName.'_admin'];
                    $fieldIsSearchable = $params['table_'.$tableName.'_field_'.$fieldName.'_searchable'];
                    $fieldFormType = $params['table_'.$tableName.'_field_'.$fieldName.'_formtype'];

                    //add to searchables
                    if($fieldIsSearchable) {
                        array_push($searchableFields,$fieldName);
                    }

                    array_push($fields,array(
                        "name"=>$fieldName,
                        "isAdmin"=>$fieldIsAdmin,
                        "isSearchable"=>$fieldIsSearchable,
                        "formType"=>$fieldFormType
                    ));

                }
            }

            //RELATIONS
            $relations = array();
            $totalRelations = $params['table_'.$tableName.'_relations_total'];
            for($k=0;$k<$totalRelations;$k++){
                $relationType = $params['table_'.$tableName.'_relations_type_'.$k];
                $relationModel = $params['table_'.$tableName.'_relations_model_'.$k];

                $relation = array(
                    'type'=>$relationType,
                    'model'=>$relationModel
                );
                array_push($relations,$relation);
            }


            //ADD DATA
            $data = array(
                'model'=>$modelName,
                'table'=>$tableName,
                'primaryKey'=>$primaryKey,
                'slug'=>$slug,
                'isAdmin'=>$isAdmin,
                'isAPI'=>$isApi,
                'fields'=>$fields,
                'searchableFields'=>$searchableFields,
                'relations'=>$relations
            );



            //writing models
            $renderedClass = $twig->render('model.twig', $data);
            $myfile = fopen(APP_PATH.'models/test/'.$modelName.'.php', "w");
            fwrite($myfile, $renderedClass);
            fclose($myfile);


            if($isAdmin){
                //writing ADMIN CONTROLLERS
                $renderedClass = $twig->render('admin_controller.twig', $data);


                $myfile = fopen(APP_PATH.'controllers/Admin/test/'.$modelName.'Controller.php', "w");
                fwrite($myfile, $renderedClass);
                fclose($myfile);

                //writing ADMIN VIEWS


                //edit
                $renderedClass = $twig->render('admin_edit.twig', $data);
                $myfile = fopen($this->checkFolder(APP_PATH.'views/admin/test/'.$slug.'/edit.twig'), "w");
                fwrite($myfile, $this->replaceTwigTags($renderedClass));
                fclose($myfile);;

                //list

                $renderedClass = $twig->render('admin_list.twig', $data);
                $myfile = fopen($this->checkFolder(APP_PATH.'views/admin/test/'.$slug.'/list.twig'), "w");
                fwrite($myfile, $this->replaceTwigTags($renderedClass));
                fclose($myfile);


                //MAIN MENU

            }


            array_push($jsonResult['generator']['entities'],$data);
        }

        //write admin routes


        echo json_encode($jsonResult);
        die;



    }

    public function checkFolder($pFileName){
        $filename = $pFileName;
        $dirname = dirname($filename);
        if (!is_dir($dirname))
        {
            mkdir($dirname, 0755, true);
        }
        return $filename;
    }

    public function replaceTwigTags($pString) {
        $pString = str_replace('[%','{%',$pString);
        $pString = str_replace('%]','%}',$pString);
        $pString = str_replace('[[','{{',$pString);
        $pString = str_replace(']]','}}',$pString);

        return $pString;
    }

}