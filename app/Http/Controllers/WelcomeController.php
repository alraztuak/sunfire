<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use DB;

class WelcomeController extends Controller
{
    
    public function index()
    {
        $berita = DB::table('contents as a')
                ->leftJoin('content_cats as b', 'a.content_cat_id', '=', 'b.id')
                ->select('a.id','a.content_cat_id','a.sumber','a.judul','a.isi','a.created_at', 'b.judul as kategori' )
                ->where('b.judul','=','berita')
                ->where('a.status','=','1')
                ->orderby('a.id','desc')
                ->limit(5)
                ->get();

        $highlight = DB::table('highlights')
                ->select('idref','modul','judul','created_at','splash')
                ->where('status','=','1')
                ->orderby('id','desc')
                ->limit(5)
                ->get();

        $highlightmain = DB::table('highlights')
                ->select('idref','modul','judul','isi','created_at','splash')
                ->where('status','=','1')
                ->orderby('id','desc')
                ->first();

        $highlightcat = DB::table('highlights')
                ->distinct()
                ->where('status','=','1')
                ->orderby('modul','desc')
                ->get('modul');


        $aturan = DB::table('aturans as a')
                ->leftJoin('aturan_jenis as b', 'a.aturan_jenis_id', '=', 'b.id')
                ->select('a.id','a.nomor','a.perihal','b.judul','a.published_at')
                ->where('a.status','=','1')
                ->where('b.status','=','1')
                ->orderby('a.published_at','desc')
                ->limit(5)
                ->get();

        //dd($aturan);

        return view('index')
            ->with('berita', $berita)
            ->with('highlight', $highlight)
            ->with('highlightmain', $highlightmain)
            ->with('highlightcat', $highlightcat)
            ->with('aturan', $aturan);
        
    }
    
}
