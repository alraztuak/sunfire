<?php

namespace App\Http\Controllers\Api;

use JWTAuth;
//use Response;
use App\Content;
use App\ContentCat;
use App\Tag;
use App\Highlight;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;

class ContentApi extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function list($param)
    {
        $contentcat = ContentCat::where('judul','=',$param)->first();
        $contentapi = Content::select('id','content_cat_id', 'judul','sumber','isi','splash','created_at')
                    ->where('status','=','1')
                    ->where('content_cat_id','=',$contentcat->id)
                    ->orderby('id','desc')
                    ->paginate(10);         
        //dd($contentapi);

        $contentapi ->map(function ($contentapis) {

                        //dd($contentapis['content_cat_id']);
                        $contentcatxsim=ContentCat::find($contentapis['content_cat_id']);
                        $contentapis['mod'] = $contentcatxsim->judul;  
                        
                        $contentapis['tanggal'] = $contentapis['created_at']->format('d F Y',$contentapis['created_at']);
                        $contentapis['hari'] = $contentapis['created_at']->format('d',$contentapis['created_at']);
                        $contentapis['bulan'] = $contentapis['created_at']->format('M',$contentapis['created_at']);
                        $contentapis['tahun'] = $contentapis['created_at']->format('Y',$contentapis['created_at']);
                        $contentapis['isi'] = Str::words($contentapis['isi'], 15,'...');
                        return $contentapis;
                    });

        return response()
                ->json([
                    'data' => $contentapi
                ]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($param, $id)
    {
        $contentcat = ContentCat::where('judul','=',$param)->first();
        $contentapi = Content::whereId($id)
                        ->where('status','=','1')
                        ->where('content_cat_id','=',$contentcat->id)
                        ->first();

        return response()
            ->json([
                'data' => $contentapi,
                'kategori' => $contentcat->judul
            ]);
    }

}
