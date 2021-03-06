<?php
/**
 * Created by PhpStorm.
 * User: cfranchi
 * Date: 30/07/14
 * Time: 17:25
 */

use Illuminate\Database\Eloquent\SoftDeletingTrait;



class Photos extends Illuminate\Database\Eloquent\Model
{
    use SoftDeletingTrait;

    //list of fields that can be searchable
    public static $searchable = array('id','description');

    protected $table = 'tb_photos';

    protected $key = 'id';

    protected $hidden = [];

    //table vars
    protected $dates = ['deleted_at'];
    public $timestamps = true;


//    public function portfolio()
//    {
//        return $this->belongsTo('Portfolio','portfolio_id')->select(array('id', 'titulo'));
//
//    }

    public function connection()
    {
        return $this->morphTo();
    }

 }