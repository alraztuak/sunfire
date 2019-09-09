<?php

namespace App\Http\Controllers\Ortax;

use Response;
use App\Aturan;
use App\AturanJenis;
use App\AturanInfo;
use App\AturanTopik;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AturanOrtax extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function list()
    {
        $aturan = Aturan::select('aturans.id','aturan_jenis.judul as jenis','aturans.perihal','aturans.nomor','aturans.views','aturans.created_at')
                    ->join('aturan_jenis', 'aturans.aturan_jenis_id', '=', 'aturan_jenis.id')
                    ->where('aturans.status','=','1')
                    ->orderby('aturans.id','desc')
                    ->paginate(15); 
        
                    //$aturanjenis = AturanJenis::find($aturan->aturan_jenis_id);
        dd($aturan);
        return view('ortax.aturan.index');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $aturan  = Aturan::select('aturans.*','aturan_jenis.judul as jenis')
                    ->join('aturan_jenis', 'aturans.aturan_jenis_id', '=', 'aturan_jenis.id')
                    ->where('aturans.id','=',$id)
                    ->where('aturans.status','=','1')
                    ->first();

        $aturanjenis = AturanJenis::find($aturan->aturan_jenis_id)->where('status','=','1')->first();
        $aturaninfo = AturanInfo::find($aturan->aturan_info_id)->where('status','=','1')->first();

        $aturanstatus = Aturan::select('aturans.id','aturan_jenis.judul as jenis','aturans.perihal','aturans.nomor','aturans.views','aturans.created_at')
                            ->join('aturan_status', 'aturans.id', '=', 'aturan_status.status_id')
                            ->join('aturan_jenis', 'aturans.aturan_jenis_id', '=', 'aturan_jenis.id')
                            ->where('aturan_status.aturan_id','=',$aturan->id)
                            ->get();

        $aturanterkait = Aturan::select('aturans.id','aturan_jenis.judul as jenis','aturans.perihal','aturans.nomor','aturans.views','aturans.created_at')
                            ->join('aturan_terkait', 'aturans.id', '=', 'aturan_terkait.terkait_id')
                            ->join('aturan_jenis', 'aturans.aturan_jenis_id', '=', 'aturan_jenis.id')
                            ->where('aturan_terkait.aturan_id','=',$aturan->id)
                            ->get();
                        
        $aturanhistori = Aturan::select('aturans.id','aturan_jenis.judul as jenis','aturans.perihal','aturans.nomor','aturans.views','aturans.created_at')
                            ->join('aturan_histori', 'aturans.id', '=', 'aturan_histori.histori_id')
                            ->join('aturan_jenis', 'aturans.aturan_jenis_id', '=', 'aturan_jenis.id')
                            ->where('aturan_histori.aturan_id','=',$aturan->id)
                            ->get();

        dd($aturan);
        return view('ortax.aturan.show');
    }
}
