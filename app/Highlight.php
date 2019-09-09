<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Highlight extends Model
{
    protected $table = "highlights";
    protected $fillable=['idref','modul','judul','isi','splash','views','status','create_by','update_by'];

    use SoftDeletes;
    protected $dates =['deleted_at'];
}
