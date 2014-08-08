<?php
/**
 * Created by PhpStorm.
 * User: cfranchi
 * Date: 30/07/14
 * Time: 17:25
 */

class Categorias extends Illuminate\Database\Eloquent\Model
{
    protected $table = 'tb_categorias';

    protected $key = 'id';

    protected $hidden = [];

    public function portfolio()
        {
              return $this->hasMany('Portfolio');

        }
     }