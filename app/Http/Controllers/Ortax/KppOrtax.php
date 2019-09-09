<?php

namespace App\Http\Controllers\Ortax;

use Response;
use App\Kpp;
use App\KppJenis;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class KppOrtax extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function list()
    {
            $kpp=Kpp::select('kpps.*','kpp_jenis.judul as jenis')
                    ->join('kpp_jenis', 'kpps.kpp_jenis_id', '=', 'kpp_jenis.id')
                    ->where('kpps.status','=','1')
                    ->orderby('kpps.id','desc')
                    ->paginate(10); 
        dd($kpp);
        return view('ortax.kpp.index');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $kpp=Kpp::select('kpps.*','kpp_jenis.judul as jenis')
                ->join('kpp_jenis', 'kpps.kpp_jenis_id', '=', 'kpp_jenis.id')
                ->where('kpps.id','=',$id)
                ->where('kpps.status','=','1')
                ->first(); 
        dd($kpp);
        return view('ortax.kpp.show');
    }
}
