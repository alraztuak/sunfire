<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Content extends Model
{
    protected $table = "contents";
    protected $fillable=['content_cat_id','judul','sumber','url','info','isi','splash','views','status','create_by','update_by'];

    use SoftDeletes;
    protected $dates =['deleted_at'];

    public function contentcats()
    {  
        return $this->belongsTo(ContentCat::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    /* check content has tag */
    public function hastags($tagId)
    {
        return in_array($tagId, $this->tags->pluck('id')->toArray());
    }

    public function trendings()
    {
        return $this->belongsToMany(Trending::class);
    }
}
