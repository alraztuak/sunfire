<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KursKode extends Model
{
    protected $table = "kurs_kodes";
    protected $fillable=['judul','kode','satuan','kursmk','kursbi','splash','status','create_by','update_by'];
    
}
