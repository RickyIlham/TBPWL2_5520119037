<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    
    protected $table = 'products';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'char';

    public function brands(){
        return $this->belongsTo(Brands::class);
    }

    public function categories(){
        return $this->belongsTo(Categories::class);
    }
    

}

