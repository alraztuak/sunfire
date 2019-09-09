<?php

namespace App\Http\Controllers\Xsim;

use Auth;
use App\ContentCat;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Xsim\ContentCat\CreateRequest;
use App\Http\Requests\Xsim\ContentCat\UpdateRequest;
use Yajra\Datatables\Datatables;

class ContentCatXsim extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('xsim.contentcat.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        //redirecting
        return view('xsim.contentcat.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRequest $request)
    {
        //Create Post
        ContentCat::create([
            'judul'=>$request->judul,
            'status'=>'0',
            'create_by'=> Auth::user()->name,
            'update_by'=> ''
        ]);
          
        //splash message
        session() -> flash('success','Data berhasil disimpan');
        //redirecting
        return redirect(route('contentcatxsim.index'));
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
        $contentcat=ContentCat::find($id);
        return view('xsim.contentcat.create')->with('contentcat', $contentcat);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, ContentCat $contentcatxsim)
    {
        $data = $request->only(['judul']);
        // cek new image

        $data['update_by']=Auth::user()->name;

        $contentcatxsim->update($data);
          
        //splash message
        session() -> flash('success','Data berhasil disimpan');
        //redirecting
        return redirect(route('contentcatxsim.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //cari ID
        $contentcat=ContentCat::find($id);
        if($contentcat->contents->count()=='0'){
            if($contentcat->status=='0'){
                    //SoftDelete
                    $contentcat->forcedelete();
                    //splash message
                    session() -> flash('success','Data berhasil dihapus');
            }else{
                    //splash message
                    session() -> flash('warning','Status Data masih aktif');
            }
        }else{
            //splash message
            session() -> flash('warning','Category content masih digunakan, hapus content terlebih dahulu');
        }
        //redirecting
        return redirect(route('contentcatxsim.index'));
    }
    /**
     * Display a listing of the resource in Json.
     *
     */
    public function dataContentCat()
    {
        return Datatables::of(ContentCat::select('id', 'judul','created_at','status'))
            ->editColumn('created_at', function ($contentcat) 
            { //change over here 
            return date('d M Y', strtotime($contentcat->created_at) );
            })
            ->addColumn('contents', function ($contentcat) 
            { //change over here 
                return $contentcat->contents->count();
            })
            ->make(true);
    }

    /**
     * Update Status.
     *
     */
    public function complete($id){
        //dd($todoId);
        $contentcatxsim=ContentCat::find($id);
        $contentcatxsim->update(['status'=>1]);

        //splash
        session() -> flash('success','Status Berhasil di aktifkan');
        //redirecting
        return redirect(route('contentcatxsim.index'));
    }

    /**
     * Un-Update Status.
     *
     */
    public function uncomplete($id){
        //dd($todoId);
        $contentcatxsim=ContentCat::find($id);
        $contentcatxsim->update(['status'=>0]);
        
        //splash
        session() -> flash('success','Status Berhasil di non-aktifkan');
        //redirecting
        return redirect(route('contentcatxsim.index'));
    }
}
