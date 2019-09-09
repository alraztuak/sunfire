<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AturanJenis extends Model
{
    protected $table = "aturan_jenis";
    protected $fillable=['id','judul','status','create_by','update_by'];
    
    public function aturans()
    {  
        return $this->hasMany(Aturan::class);
    }
}
