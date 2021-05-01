<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class brands extends Model
{
    protected $table = 'brands';

    protected $primaryKey = 'id';

    public $incrementing = false;

    protected $keyType = 'char';
}
