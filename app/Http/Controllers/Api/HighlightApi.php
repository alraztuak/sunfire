<?php

namespace App\Http\Controllers\Api;

use JWTAuth;
use App\Highlight;
use App\Tag;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;

class HighlightApi extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function list()
    {
        $highlightapi=Highlight::select('id','modul', 'judul','isi','splash','views','created_at')
                    ->where('status','=','1')
                    ->orderby('id','desc')
                    ->paginate(10); 
       // dd($highlightapi);

        $highlightapi ->map(function ($highlightapis) {

                        //dd($highlightapis['content_cat_id']); 
                        
                        $highlightapis['tanggal'] = $highlightapis['created_at']->format('d F Y',$highlightapis['created_at']);
                        $highlightapis['hari'] = $highlightapis['created_at']->format('d',$highlightapis['created_at']);
                        $highlightapis['bulan'] = $highlightapis['created_at']->format('M',$highlightapis['created_at']);
                        $highlightapis['tahun'] = $highlightapis['created_at']->format('Y',$highlightapis['created_at']);
                        $highlightapis['isi'] = Str::words($highlightapis['isi'], 15,'...');
                        return $highlightapis;
                    });

        return response()
                ->json([
                    'data' => $highlightapi
                ]);
    }
}
