<?php

namespace App\Http\Controllers\Api;

use JWTAuth;
use App\Content;
use App\Tag;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;

class TagApi extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function list($id)
    {
        $tagapi = Tag::where('id','=',$id)->first();
        //dd($tagapi);
        $contentapi = Content::select('contents.id','contents.content_cat_id', 'contents.judul','contents.sumber','contents.isi','contents.splash','contents.views','contents.created_at')
                    ->join('content_tag', 'contents.id', '=', 'content_tag.content_id')
                    ->join('tags', 'tags.id', '=', 'content_tag.tag_id')
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
                    'tag' => $tagapi->judul,
                    'tag_tanggal' => $tagapi->created_at->format('d F Y',$tagapi->created_at),
                    'tag_hari' => $tagapi->created_at->format('d',$tagapi->created_at),
                    'tag_bulan' => $tagapi->created_at->format('M',$tagapi->created_at),
                    'tag_tahun' => $tagapi->created_at->format('Y',$tagapi->created_at),
                    'data' => $contentapi
                ]);
    }
}
