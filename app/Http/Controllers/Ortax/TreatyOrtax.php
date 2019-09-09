<?php

namespace App\Http\Controllers\Ortax;

use Response;
use App\Treaty;
use App\TreatyInfo;
use App\TreatyJenis;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TreatyOrtax extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function list()
    {
        $treaty=Treaty::select('treaties.*','treaty_infos.indonesia','treaty_infos.english','treaty_infos.splash','treaty_jenis.judul as jenis')
                    ->join('treaty_infos', 'treaties.treaty_info_id', '=', 'treaty_infos.id')
                    ->join('treaty_jenis', 'treaties.treaty_jenis_id', '=', 'treaty_jenis.id')
                    ->where('treaties.status','=','1')
                    ->orderby('treaties.id','desc')
                    ->paginate(10); 
        dd($treaty);
        return view('ortax.treaty.index');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $treaty=Treaty::select('treaties.*','treaty_infos.indonesia','treaty_infos.english','treaty_infos.splash','treaty_jenis.judul as jenis')
                    ->join('treaty_infos', 'treaties.treaty_info_id', '=', 'treaty_infos.id')
                    ->join('treaty_jenis', 'treaties.treaty_jenis_id', '=', 'treaty_jenis.id')
                    ->where('treaties.id','=',$id)
                    ->where('treaties.status','=','1')
                    ->first();
        dd($treaty);
        return view('ortax.treaty.show');
    }

}
