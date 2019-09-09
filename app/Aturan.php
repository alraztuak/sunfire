<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Aturan extends Model
{
    protected $table = "aturans";
    protected $fillable=['nomor','nomor_index','perihal','isi','aturan_jenis_id','aturan_info_id','lampiran','pdf','views','status','published_at','create_by','update_by'];

    use SoftDeletes;
    protected $dates =['deleted_at'];

    public function aturanTopiks()
    {
        return $this->belongsToMany(AturanTopik::class);
    }

    /* check content has aturan_topik */
    public function hasAturanTopiks($aturanTopikId)
    {
        return in_array($aturanTopikId, $this->aturanTopiks->pluck('id')->toArray());
    }


}
