<?php
/**
 * Created by PhpStorm.
 * User: cfranchi
 * Date: 30/07/14
 * Time: 17:25
 */

class Groups extends Illuminate\Database\Eloquent\Model
{
    protected $table = 'groups';

    protected $key = '';

    protected $hidden = [];

                    public function users()
        {
              return $this->hasMany('users');

        }
             }