<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TreatyJenis extends Model
{
    protected $table = "treaty_jenis";
    protected $fillable=['judul','status','create_by','update_by'];
    
    public function treaties()
    {  
        return $this->hasMany(Treaty::class);
    }
}
