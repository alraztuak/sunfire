<?php

namespace App\Http\Controllers\Api;

use JWTAuth;
use App\Putusan;
use App\PutusanCat;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;

class PutusanApi extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function list()
    {
        $putusanapi =Putusan::select('putusans.*','putusan_cats.judul as kategori')
                    ->join('putusan_cats', 'putusans.putusan_cat_id', '=', 'putusan_cats.id')
                    ->where('putusans.status','=','1')
                    ->orderby('putusans.id','desc')
                    ->paginate(10);    

        $putusanapi ->map(function ($putusanapis) {
                        
                        $putusanapis['tanggal'] = $putusanapis['created_at']->format('d F Y',$putusanapis['created_at']);
                        $putusanapis['hari'] = $putusanapis['created_at']->format('d',$putusanapis['created_at']);
                        $putusanapis['bulan'] = $putusanapis['created_at']->format('M',$putusanapis['created_at']);
                        $putusanapis['tahun'] = $putusanapis['created_at']->format('Y',$putusanapis['created_at']);
                        $putusanapis['isi'] = Str::words($putusanapis['isi'], 15,'...');
                        return $putusanapis;
                    });
        //dd($putusanapi);
        return response()
                ->json([
                    'data' => $putusanapi
                ]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $putusanapi = Putusan::select('putusans.*','putusan_cats.judul as kategori')
                    ->join('putusan_cats', 'putusans.putusan_cat_id', '=', 'putusan_cats.id')
                    ->where('putusans.id','=',$id)
                    ->where('putusans.status','=','1')
                    ->first();

        return response()
            ->json([
                'data' => $putusanapi
            ]);
    }
}
