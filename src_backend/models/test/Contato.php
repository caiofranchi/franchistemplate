<?php
/**
 * Created by PhpStorm.
 * User: cfranchi
 * Date: 30/07/14
 * Time: 17:25
 */

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Contato extends Illuminate\Database\Eloquent\Model
{
    use SoftDeletingTrait;

    //list of fields that can be searchable
    public static $searchable = array('nome','email','mensagem','ip',);

    protected $table = 'contato';

    protected $key = 'id';

    protected $hidden = [];

    //table vars
    protected $dates = ['deleted_at'];

    public $timestamps = true;

                                                
                            }