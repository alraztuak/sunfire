<?php

namespace App\Http\Controllers\Ortax;

use Response;
use App\Content;
use App\Trending;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TrendingOrtax extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function list($id)
    {
        $trending = Trending::where('id','=',$id)->first();
        //dd($trending);
        $content=Content::select('contents.id','contents.content_cat_id', 'contents.judul','contents.sumber','contents.isi','contents.splash','contents.views','contents.created_at')
                    ->join('content_trending', 'contents.id', '=', 'content_trending.content_id')
                    ->join('trendings', 'trendings.id', '=', 'content_trending.trending_id')
                    ->where('contents.status','=','1')
                    ->orderby('contents.id','desc')
                    ->paginate(10); 
        //dd($content);
        return view('ortax.content.index');
    }
}
