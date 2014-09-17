<?php
/**
 * Created by PhpStorm.
 * User: cfranchi
 * Date: 30/07/14
 * Time: 17:25
 */

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Etapas extends Illuminate\Database\Eloquent\Model
{
    use SoftDeletingTrait;

    //list of fields that can be searchable
    public static $searchable = array('nome','slug','data_inicio','data_fim','localizacao','retirada','regulamento_arquivo','regulamento','manual','cor',);

    protected $table = 'etapas';

    protected $key = 'id';

    protected $hidden = [];

    //table vars
    protected $dates = ['deleted_at'];

    public $timestamps = true;

                                                
                            }