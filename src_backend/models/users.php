<?php
/**
 * Created by PhpStorm.
 * User: cfranchi
 * Date: 30/07/14
 * Time: 17:25
 */

class Users extends Illuminate\Database\Eloquent\Model
{
    protected $table = 'users';

    protected $key = 'id';

    protected $hidden = ['descricao','tipo',];

                    public function groups()
        {
              return $this->belongsTo('groups');

        }
             }