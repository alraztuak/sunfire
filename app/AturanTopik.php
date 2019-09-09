<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AturanTopik extends Model
{
    protected $table = "aturan_topiks";
    protected $fillable=['id','judul','status','create_by','update_by'];
    
    public function aturans()
    {  
        return $this->belongsToMany(Aturan::class);
    }
}
