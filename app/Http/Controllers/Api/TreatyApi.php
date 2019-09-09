<?php

namespace App\Http\Controllers\Api;

use JWTAuth;
use App\Treaty;
use App\TreatyInfo;
use App\TreatyJenis;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;

class TreatyApi extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function list()
    {
        $treatyapi = treaty::select('treaties.*','treaty_infos.indonesia','treaty_infos.english','treaty_infos.splash','treaty_jenis.judul as jenis')
                    ->join('treaty_infos', 'treaties.treaty_info_id', '=', 'treaty_infos.id')
                    ->join('treaty_jenis', 'treaties.treaty_jenis_id', '=', 'treaty_jenis.id')
                    ->where('treaties.status','=','1')
                    ->orderby('treaties.id','desc')
                    ->paginate(10);         
        //dd($treatyapi);

        $treatyapi ->map(function ($treatyapis) {
                        
                        $treatyapis['tanggal'] = $treatyapis['created_at']->format('d F Y',$treatyapis['created_at']);
                        $treatyapis['hari'] = $treatyapis['created_at']->format('d',$treatyapis['created_at']);
                        $treatyapis['bulan'] = $treatyapis['created_at']->format('M',$treatyapis['created_at']);
                        $treatyapis['tahun'] = $treatyapis['created_at']->format('Y',$treatyapis['created_at']);
                        $treatyapis['judul'] = Str::words($treatyapis['judul'], 15,'...');
                        return $treatyapis;
                    });

        return response()
                ->json([
                    'data' => $treatyapi
                ]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $treatyapi=Treaty::select('treaties.*','treaty_infos.indonesia','treaty_infos.english','treaty_infos.splash','treaty_jenis.judul as jenis')
                    ->join('treaty_infos', 'treaties.treaty_info_id', '=', 'treaty_infos.id')
                    ->join('treaty_jenis', 'treaties.treaty_jenis_id', '=', 'treaty_jenis.id')
                    ->where('treaties.id','=',$id)
                    ->where('treaties.status','=','1')
                    ->first();

        return response()
            ->json([
                'data' => $treatyapi
            ]);
    }
}
