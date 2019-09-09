<?php

namespace App\Http\Controllers\Api;

use JWTAuth;
use App\kpp;
use App\KppJenis;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;

class KppApi extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function list()
    {
        $kppapi = Kpp::select('kpps.*','kpp_jenis.judul as jenis')
                    ->join('kpp_jenis', 'kpps.kpp_jenis_id', '=', 'kpp_jenis.id')
                    ->where('kpps.status','=','1')
                    ->orderby('kpps.id','desc')
                    ->paginate(10);    

        $kppapi ->map(function ($kppapis) {
                        
                        $kppapis['tanggal'] = $kppapis['created_at']->format('d F Y',$kppapis['created_at']);
                        $kppapis['hari'] = $kppapis['created_at']->format('d',$kppapis['created_at']);
                        $kppapis['bulan'] = $kppapis['created_at']->format('M',$kppapis['created_at']);
                        $kppapis['tahun'] = $kppapis['created_at']->format('Y',$kppapis['created_at']);
                        return $kppapis;
                    });
        //dd($kppapi);
        return response()
                ->json([
                    'data' => $kppapi
                ]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $kppapi = Kpp::select('kpps.*','kpp_jenis.judul as jenis')
                    ->join('kpp_jenis', 'kpps.kpp_jenis_id', '=', 'kpp_jenis.id')
                    ->where('kpps.id','=',$id)
                    ->where('kpps.status','=','1')
                    ->first();

        return response()
            ->json([
                'data' => $kppapi
            ]);
    }
}
