<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $table = "tags";
    protected $fillable=['judul','status','create_by','update_by'];

    public function contents()
    {
        return $this->belongsToMany(Content::class);
    }
}
