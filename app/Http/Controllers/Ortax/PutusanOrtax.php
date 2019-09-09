<?php

namespace App\Http\Controllers\Ortax;

use Response;
use App\Putusan;
use App\PutusanCat;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PutusanOrtax extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function list()
    {
        $putusan=Putusan::select('putusans.*','putusan_cats.judul as kategori')
                    ->join('putusan_cats', 'putusans.putusan_cat_id', '=', 'putusan_cats.id')
                    ->where('putusans.status','=','1')
                    ->orderby('putusans.id','desc')
                    ->paginate(10); 
        dd($putusan);
        return view('ortax.putusan.index');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $putusan=Putusan::select('putusans.*','putusan_cats.judul as kategori')
                ->join('putusan_cats', 'putusans.putusan_cat_id', '=', 'putusan_cats.id')
                ->where('putusans.id','=',$id)
                ->where('putusans.status','=','1')
                ->first();
        dd($putusan);
        return view('ortax.putusan.show');
    }
}
