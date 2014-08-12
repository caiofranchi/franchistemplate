<?php
/**
 * Created by PhpStorm.
 * User: cfranchi
 * Date: 30/07/14
 * Time: 17:25
 */

use Illuminate\Database\Eloquent\SoftDeletingTrait;



class Portfolio extends Illuminate\Database\Eloquent\Model
{
    use SoftDeletingTrait;

    //list of fields that can be searchable
    public static $searchable = array('id','nome','descricao','localizacao');

    protected $table = 'tb_portfolio';

    protected $key = 'id';

    protected $hidden = [];

    //table vars
    protected $dates = ['deleted_at'];
    public $timestamps = true;


    public function categorias()
    {
        return $this->belongsTo('Categorias','categoria_id')->select(array('id', 'nome'));

    }

    public function fotos()
    {
          return $this->hasMany('Fotos');

    }
 }