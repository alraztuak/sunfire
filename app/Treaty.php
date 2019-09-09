<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Treaty extends Model
{
    protected $table = "treaties";
    protected $fillable=['treaty_info_id','treaty_jenis_id','kode','judul','isi_id','isi_en','views','status','signed_at','published_at','create_by','update_by'];

    use SoftDeletes;
    protected $dates =['deleted_at'];

    public function treatyinfos()
    {  
        return $this->belongsTo(TreatyInfo::class);
    }
    public function treatyjenis()
    {  
        return $this->belongsTo(TreatyJenis::class);
    }
}
