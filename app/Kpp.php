<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kpp extends Model
{
    protected $table = "kpps";
    protected $fillable=['kpp_jenis_id','kodekpp','kodewil','nama','kota','lurah','camat','alamat','telepon','fax','views','status','create_by','update_by'];

    use SoftDeletes;
    protected $dates =['deleted_at'];

    public function kppjenis()
    {  
        return $this->belongsTo(KppJenis::class);
    }
}
