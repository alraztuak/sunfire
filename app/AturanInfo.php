<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AturanInfo extends Model
{
    protected $table = "aturan_infos";
    protected $fillable=['id','judul','status','create_by','update_by'];
    
    public function aturans()
    {  
        return $this->hasMany(Aturan::class);
    }
}
