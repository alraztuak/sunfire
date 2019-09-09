<?php

namespace App\Http\Controllers\Api;

use JWTAuth;
use App\Aturan;
use App\AturanJenis;
use App\AturanInfo;
use App\AturanTopik;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;

class AturanApi extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function list()
    {
        $aturanapi = Aturan::select('aturans.id','aturan_jenis.judul as jenis','aturans.perihal','aturans.nomor','aturans.views','aturans.created_at')
                        ->join('aturan_jenis', 'aturans.aturan_jenis_id', '=', 'aturan_jenis.id')
                        ->where('aturans.status','=','1')
                        ->orderby('aturans.id','desc')
                        ->paginate(15);         
        //dd($aturanapi);

        $aturanapi ->map(function ($aturanapis) {

                        $aturanapis['tanggal'] = $aturanapis['created_at']->format('d F Y',$aturanapis['created_at']);
                        $aturanapis['hari'] = $aturanapis['created_at']->format('d',$aturanapis['created_at']);
                        $aturanapis['bulan'] = $aturanapis['created_at']->format('M',$aturanapis['created_at']);
                        $aturanapis['tahun'] = $aturanapis['created_at']->format('Y',$aturanapis['created_at']);
                        $aturanapis['perihal'] = Str::words($aturanapis['perihal'], 15,'...');
                        return $aturanapis;
                    });

        return response()
                ->json([
                    'data' => $aturanapi
                ]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $aturanapi  = Aturan::select('aturans.*','aturan_jenis.judul as jenis')
                    ->join('aturan_jenis', 'aturans.aturan_jenis_id', '=', 'aturan_jenis.id')
                    ->where('aturans.id','=',$id)
                    ->where('aturans.status','=','1')
                    ->first();

        $aturaninfo = AturanInfo::find($aturanapi->aturan_info_id)->where('status','=','1')->first();

        $aturanstatus = Aturan::select('aturans.id','aturan_jenis.judul as jenis','aturans.perihal','aturans.nomor','aturans.views','aturans.created_at')
                            ->join('aturan_status', 'aturans.id', '=', 'aturan_status.status_id')
                            ->join('aturan_jenis', 'aturans.aturan_jenis_id', '=', 'aturan_jenis.id')
                            ->where('aturan_status.aturan_id','=',$aturanapi->id)
                            ->get();

        $aturanterkait = Aturan::select('aturans.id','aturan_jenis.judul as jenis','aturans.perihal','aturans.nomor','aturans.views','aturans.created_at')
                            ->join('aturan_terkait', 'aturans.id', '=', 'aturan_terkait.terkait_id')
                            ->join('aturan_jenis', 'aturans.aturan_jenis_id', '=', 'aturan_jenis.id')
                            ->where('aturan_terkait.aturan_id','=',$aturanapi->id)
                            ->get();
                        
        $aturanhistori = Aturan::select('aturans.id','aturan_jenis.judul as jenis','aturans.perihal','aturans.nomor','aturans.views','aturans.created_at')
                            ->join('aturan_histori', 'aturans.id', '=', 'aturan_histori.histori_id')
                            ->join('aturan_jenis', 'aturans.aturan_jenis_id', '=', 'aturan_jenis.id')
                            ->where('aturan_histori.aturan_id','=',$aturanapi->id)
                            ->get();

        //dd($aturanapi);

        return response()
            ->json([
                'data' => $aturanapi,
                'info_status' => $aturaninfo->judul,
                'status' => $aturanstatus,
                'histori' => $aturanhistori,
                'terkait' => $aturanterkait
            ]);
    }
}
