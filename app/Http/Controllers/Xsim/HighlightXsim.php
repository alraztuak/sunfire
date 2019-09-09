<?php

namespace App\Http\Controllers\xsim;

use Auth;
use App\Highlight;
use App\Content;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Datatables;

class HighlightXsim extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('xsim.highlight.index');
    }

    /**
     * Display a listing of the Trashed.
     *
     * @return \Illuminate\Http\Response
     */
    public function trashed()
    {
        //dd();
        return view('xsim.highlight.trash');
    }

    /**
     * Display a listing of the Trashed.
     *
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if($id=='0'){
            //Restore Proses
            $highlight = Highlight::onlyTrashed();
            $highlight->restore();
            //splash message
            session() -> flash('success','Semua Data berhasil dialihkan ke Production');
        }else{
            //Restore Proses
            $highlight = Highlight::onlyTrashed()->where('id',$id);
            $highlight->restore();
            //splash message
            session() -> flash('success','Data berhasil dialihkan ke Production');
        }
        
        //redirecting
        return redirect(route('highlightxsim.trashed'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        //cari ID
        $highlight=Highlight::find($id);
        if($highlight->status=='0'){
                //SoftDelete
                $highlight->delete();
                //splash message
                session() -> flash('success','Data berhasil dialihkan ke Trash');
        }else{
                //splash message
                session() -> flash('warning','Status Data masih aktif');
        }

        //redirecting
        return redirect(route('highlightxsim.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Highlight $highlightxsim)
    {
        if($id=='0'){
            //Restore Proses
            $highlight = Highlight::onlyTrashed()->get();
            //dd($highlight);
            foreach ($highlight as $highlights)
                {
                    $highlights->forceDelete();
                }
            //splash message
            session() -> flash('success','Semua Data berhasil dihapus permanen');
        }else{
            //Restore Proses
            $highlight = Highlight::onlyTrashed()->where('id',$id)->first();
            // delete old image
            $highlight->forceDelete();
            //splash message
            session() -> flash('success','Data berhasil dihapus permanen');
        }
        
        //redirecting
        return redirect(route('highlightxsim.trashed'));
    }

    /**
     * Display a listing of the resource in Json.
     *
     */
    public function dataHighlight()
    {
        return Datatables::of(Highlight::select('id', 'judul','modul','created_at','status'))
        ->editColumn('created_at', function ($highlight) 
        { //change over here 
            return date('d M Y', strtotime($highlight->created_at) );
        })->make(true);
    }
    /**
     * Display Trashed List in Json.
     *
     */
    public function trashedHighlight()
    {
        //dd(highlight::query());
        return Datatables::of(Highlight::onlyTrashed()->select('id', 'judul','modul','created_at','status'))
        ->editColumn('created_at', function ($highlight) 
        { //change over here 
            return date('d M Y', strtotime($highlight->created_at) );
        })->make(true);
    }

    /**
     * Update Status.
     *
     */
    public function complete($id){
        //dd($todoId);
        $highlightxsim=Highlight::find($id);
        $highlightxsim->update(['status'=>1]);

        //splash
        session() -> flash('success','Status Berhasil di aktifkan');
        //redirecting
        return redirect(route('highlightxsim.index'));
    }

    /**
     * Un-Update Status.
     *
     */
    public function uncomplete($id){
        //dd($todoId);
        $highlightxsim=Highlight::find($id);
        $highlightxsim->update(['status'=>0]);
        
        //splash
        session() -> flash('warning','Status Berhasil di non-aktifkan');
        //redirecting
        return redirect(route('highlightxsim.index'));
    }

}
