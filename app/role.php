<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class role extends Model
{

    protected $table = "roles";
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'char';
    


}