<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Putusan extends Model
{
    protected $table = "putusans";
    protected $fillable=['putusan_cat_id','putusan_jenis_id','judul','tahun','info','isi','views','status','published_at','create_by','update_by'];

    use SoftDeletes;
    protected $dates =['deleted_at'];

    public function putusancats()
    {  
        return $this->belongsTo(PutusanCat::class);
    }
}
