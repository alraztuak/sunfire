<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TreatyInfo extends Model
{
    protected $table = "treaty_infos";
    protected $fillable=['kode','indonesia','english','splash','status','create_by','update_by'];

    use SoftDeletes;
    protected $dates =['deleted_at'];

    public function treaties()
    {  
        return $this->hasMany(Treaty::class);
    }
}
