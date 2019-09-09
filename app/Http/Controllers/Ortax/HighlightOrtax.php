<?php

namespace App\Http\Controllers\Ortax;

use Response;
use App\Highlight;
use App\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HighlightOrtax extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function list()
    {
        $highlight=Highlight::select('id','modul', 'judul','isi','splash','views','created_at')
                    ->where('status','=','1')
                    ->orderby('id','desc')
                    ->paginate(10); 
        dd($highlight);
        return view('ortax.highlight.index');
    }
}
