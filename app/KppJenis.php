<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KppJenis extends Model
{
    protected $table = "kpp_jenis";
    protected $fillable=['judul','status','create_by','update_by'];
    
    public function kpps()
    {  
        return $this->hasMany(Kpp::class);
    }
}
