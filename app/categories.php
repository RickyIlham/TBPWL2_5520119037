<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class categories extends Model
{
    protected $table = 'categories';

    protected $primaryKey = 'id';

    public $incrementing = false;

    protected $keyType = 'char';
}
