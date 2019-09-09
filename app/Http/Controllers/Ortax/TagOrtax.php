<?php

namespace App\Http\Controllers\Ortax;

use Response;
use App\Content;
use App\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TagOrtax extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function list($id)
    {
        $tag = Tag::where('id','=',$id)->first();
        //dd($tag);
        $content=Content::select('contents.id','contents.content_cat_id', 'contents.judul','contents.sumber','contents.isi','contents.splash','contents.views','contents.created_at')
                    ->join('content_tag', 'contents.id', '=', 'content_tag.content_id')
                    ->join('tags', 'tags.id', '=', 'content_tag.tag_id')
                    ->where('contents.status','=','1')
                    ->orderby('contents.id','desc')
                    ->paginate(10); 
        //dd($content);
        return view('ortax.content.index');
    }
}
