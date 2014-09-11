<?php
/**
 * Created by PhpStorm.
 * User: cfranchi
 * Date: 30/07/14
 * Time: 17:25
 */

use Illuminate\Database\Eloquent\SoftDeletingTrait;



class Noticias extends Illuminate\Database\Eloquent\Model
{
    use SoftDeletingTrait;

    //list of fields that can be searchable
    public static $searchable = array('id','titulo','descricao','tipo');

    protected $table = 'tb_noticias';

    protected $key = 'id';

    protected $hidden = [];

    //table vars
    protected $dates = ['deleted_at'];
    public $timestamps = true;

    public function photos()
    {
        return $this->morphMany('Photos', 'connection');
    }
 }