<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContentCat extends Model
{
    protected $table = "content_cats";
    protected $fillable=['judul','status','create_by','update_by'];
    
    public function contents()
    {  
        return $this->hasMany(Content::class);
    }
}
