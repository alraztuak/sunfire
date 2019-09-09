<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Trending extends Model
{
    protected $table = "trendings";
    protected $fillable=['judul','splash','views','status','create_by','update_by'];

    use SoftDeletes;
    protected $dates =['deleted_at'];

    public function contents()
    {
        return $this->belongsToMany(Content::class);
    }

    /* check content has tag */
    public function hascontents($contentId)
    {
        return in_array($contentId, $this->contents->pluck('id')->toArray());
    }
}
