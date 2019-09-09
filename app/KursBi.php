<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KursBi extends Model
{
    protected $table = "kurs_bis";
    protected $fillable=['start_at','end_at','status','create_by','update_by'];
    
    use SoftDeletes;
    protected $dates =['deleted_at'];

    public function kurskodes()
    {  
        return $this->belongsTo(KursKode::class);
    }

}
