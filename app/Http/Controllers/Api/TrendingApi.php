<?php

namespace App\Http\Controllers\Api;

use JWTAuth;
use App\Content;
use App\Trending;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;

class TrendingApi extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function list($id)
   {
       $trendingapi = Trending::where('id','=',$id)->first();
       //dd($trendingapi);
       $contentapi = Content::select('contents.id','contents.content_cat_id', 'contents.judul','contents.sumber','contents.isi','contents.splash','contents.views','contents.created_at')
                   ->join('content_trending', 'contents.id', '=', 'content_trending.content_id')
                   ->join('trendings', 'trendings.id', '=', 'content_trending.trending_id')
                   ->where('contents.status','=','1')
                   ->orderby('contents.id','desc')
                   ->paginate(10);
      //dd($contentapi);
      

       $contentapi ->map(function ($contentapis) {

                       //dd($contentapis['content_cat_id']); 
                       
                       $contentapis['tanggal'] = $contentapis['created_at']->format('d F Y',$contentapis['created_at']);
                       $contentapis['hari'] = $contentapis['created_at']->format('d',$contentapis['created_at']);
                       $contentapis['bulan'] = $contentapis['created_at']->format('M',$contentapis['created_at']);
                       $contentapis['tahun'] = $contentapis['created_at']->format('Y',$contentapis['created_at']);
                       $contentapis['isi'] = Str::words($contentapis['isi'], 15,'...');
                       return $contentapis;
                   });

       return response()
               ->json([
                   'trending' => $trendingapi->judul,
                   'trending_splash' => $trendingapi->splash,
                   'trending_tanggal' => $trendingapi->created_at->format('d F Y',$trendingapi->created_at),
                   'trending_hari' => $trendingapi->created_at->format('d',$trendingapi->created_at),
                   'trending_bulan' => $trendingapi->created_at->format('M',$trendingapi->created_at),
                   'trending_tahun' => $trendingapi->created_at->format('Y',$trendingapi->created_at),
                   'data' => $contentapi
               ]);
   }
}
