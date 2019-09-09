<?php

namespace App\Http\Controllers\Ortax;

use Response;
use App\Content;
use App\ContentCat;
use App\Tag;
use App\Highlight;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ContentOrtax extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function list($param)
    {
        $contentcat = ContentCat::where('judul','=',$param)->first();
        $content=Content::select('id','content_cat_id', 'judul','sumber','isi','splash','views','created_at')
                    ->where('status','=','1')
                    ->where('content_cat_id','=',$contentcat->id)
                    ->orderby('id','desc')
                    ->paginate(10); 
        dd($content);
        return view('ortax.content.index');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($param, $id)
    {
        $content=Content::whereId($id)->where('status','=','1')->first();
        //dd($content);
        return view('ortax.content.show');
    }

}
