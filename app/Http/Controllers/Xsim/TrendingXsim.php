<?php

namespace App\Http\Controllers\Xsim;

use Auth;
use App\Trending;
use App\Content;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use App\Http\Requests\Xsim\Trending\CreateRequest;
use App\Http\Requests\Xsim\Trending\UpdateRequest;
use Yajra\Datatables\Datatables;

class TrendingXsim extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('xsim.trending.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //redirecting
        return view('xsim.trending.create')
        ->with('content', Content::select('id', 'judul','status')->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRequest $request)
    {
        
        //dd($request->all());
        //upload image
        if($request->splash!=''){
            $image = $request->splash->store('trending');
        }else{
            $image = '';
        }

        //Create Post
        $trending = Trending::create([
            'judul'=>$request->judul,
            'views'=>'0',
            'status'=>'0',
            'splash'=>$image,
            'create_by'=> Auth::user()->name,
            'update_by'=> ''
        ]);

        if($request->content){
            $trending->contents()->attach($request->content);
        }
          
        //splash message
        session() -> flash('success','Data berhasil disimpan');
        //redirecting
        return redirect(route('trendingxsim.index'));
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
        $trending=Trending::find($id);
        return view('xsim.trending.create')
            ->with('trending', $trending)
            ->with('content', Content::select('id', 'judul','status')->get());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, Trending $trendingxsim)
    {
        $data = $request->only(['judul','splash']);
        //dd($request->category);
        // cek new image
        if($request->hasFile('splash')){
            //upload image
            $image = $request->splash->store('trending');

            // delete old image
            Storage::delete($trendingxsim->splash);
            $data['splash']=$image;

        }

        if($request->content){
            $trendingxsim->contents()->sync($request->content);
        }
        $data['update_by']=Auth::user()->name;

        $trendingxsim->update($data);
          
        //splash message
        session() -> flash('success','Data berhasil disimpan');
        //redirecting
        return redirect(route('trendingxsim.index'));
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
        $trending=Trending::find($id);
        if($trending->status=='0'){
                //SoftDelete
                $trending->delete();
                //splash message
                session() -> flash('success','Data berhasil dialihkan ke Trash');
        }else{
                //splash message
                session() -> flash('warning','Status Data masih aktif');
        }

        //redirecting
        return redirect(route('trendingxsim.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Content $contentxsim)
    {
        if($id=='0'){
            //Restore Proses
            $trending = Trending::onlyTrashed()->get();
            //dd($content);
            foreach ($trending as $trendings)
                {
                    // delete old image
                    Storage::delete($trendings->splash);
                    $trendings->forceDelete();
                    $trendings->contents()->sync([]);
                }
            //splash message
            session() -> flash('success','Semua Data berhasil dihapus permanen');
        }else{
            //Restore Proses
            $trending = Trending::onlyTrashed()->where('id',$id)->first();
            // delete old image
            Storage::delete($trending->splash);
            //dd($content->splash);
            $trending->forceDelete();
            $trending->contents()->sync([]);
            //splash message
            session() -> flash('success','Data berhasil dihapus permanen');
        }
        
        //redirecting
        return redirect(route('trendingxsim.trashed'));
    }

    /**
     * Display a listing of the Trashed.
     *
     * @return \Illuminate\Http\Response
     */
    public function trashed()
    {
        //dd();
        return view('xsim.trending.trash');
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
            $trending = Trending::onlyTrashed();
            $trending->restore();
            //splash message
            session() -> flash('success','Semua Data berhasil dialihkan ke Production');
        }else{
            //Restore Proses
            $trending = Trending::onlyTrashed()->where('id',$id);
            $trending->restore();
            //splash message
            session() -> flash('success','Data berhasil dialihkan ke Production');
        }
        
        //redirecting
        return redirect(route('trendingxsim.trashed'));
    }
    /**
     * Display a listing of the resource in Json.
     *
     */
    public function dataTrending()
    {
        return Datatables::of(Trending::select('id', 'judul','created_at','status'))
        ->addColumn('content_count', function ($trending)
        { //change over here 
            return $trending->contents->count();
        })
        ->editColumn('created_at', function ($trending) 
        { //change over here 
            return date('d M Y', strtotime($trending->created_at) );
        })->make(true);
    }
    /**
     * Display Trashed List in Json.
     *
     */
    public function trashedTrending()
    {
        //dd(Content::query());
        return Datatables::of(Trending::onlyTrashed()->select('id', 'judul','created_at','status'))
        ->addColumn('content_count', function ($trending)
        { //change over here 
            return $trending->contents->count();
        })
        ->editColumn('created_at', function ($trending) 
        { //change over here 
            return date('d M Y', strtotime($trending->created_at) );
        })->make(true);
    }

    /**
     * Update Status.
     *
     */
    public function complete($id){
        //dd($todoId);
        $trendingxsim=Trending::find($id);
        $trendingxsim->update(['status'=>1]);

        //splash
        session() -> flash('success','Status Berhasil di aktifkan');
        //redirecting
        return redirect(route('trendingxsim.index'));
    }

    /**
     * Un-Update Status.
     *
     */
    public function uncomplete($id){
        //dd($todoId);
        $trendingxsim=Trending::find($id);
        $trendingxsim->update(['status'=>0]);

        //splash
        session() -> flash('success','Status Berhasil di non-aktifkan');
        //redirecting
        return redirect(route('trendingxsim.index'));
    }
}
