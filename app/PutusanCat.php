<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PutusanCat extends Model
{
    protected $table = "putusan_cats";
    protected $fillable=['judul','status','create_by','update_by'];
    
    public function putusans()
    {  
        return $this->hasMany(Putusan::class);
    }
}
