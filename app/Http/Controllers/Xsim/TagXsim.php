<?php

namespace App\Http\Controllers\Xsim;

use Auth;
use App\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Xsim\Tag\CreateRequest;
use App\Http\Requests\Xsim\Tag\UpdateRequest;
use Yajra\Datatables\Datatables;

class TagXsim extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('xsim.tag.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        //redirecting
        return view('xsim.tag.create');
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
        Tag::create([
            'judul'=>$request->judul,
            'status'=>'0',
            'create_by'=> Auth::user()->name,
            'update_by'=> ''
        ]);
          
        //splash message
        session() -> flash('success','Data berhasil disimpan');
        //redirecting
        return redirect(route('tagxsim.index'));
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
        $tag=Tag::find($id);
        return view('xsim.tag.create')->with('tag', $tag);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, tag $tagxsim)
    {
        $data = $request->only(['judul']);
        // cek new image

        $data['update_by']=Auth::user()->name;

        $tagxsim->update($data);
          
        //splash message
        session() -> flash('success','Data berhasil disimpan');
        //redirecting
        return redirect(route('tagxsim.index'));
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
        $tag=Tag::find($id);
            if($tag->contents->count()=='0'){
                if($tag->status=='0'){
                        //SoftDelete
                        $tag->forcedelete();
                        //splash message
                        session() -> flash('success','Data berhasil dialihkan ke Trash');
                }else{
                        //splash message
                        session() -> flash('warning','Status Data masih aktif');
                }
            }else{
                //splash message
                session() -> flash('warning','Tags content masih digunakan, hapus content terlebih dahulu');
            }
        //redirecting
        return redirect(route('tagxsim.index'));
    }
    /**
     * Display a listing of the resource in Json.
     *
     */
    public function dataTag()
    {
        return Datatables::of(Tag::select('id', 'judul','created_at','status')) 
            ->editColumn('created_at', function ($tag) 
            { //change over here 
            return date('d M Y', strtotime($tag->created_at));
            })
            ->addColumn('contents', function ($tag) 
            { //change over here 
                return $tag->contents->count();
            })
            ->make(true);
    }

    /**
     * Update Status.
     *
     */
    public function complete($id){
        //dd($todoId);
        $tagxsim=Tag::find($id);
        $tagxsim->update(['status'=>1]);

        //splash
        session() -> flash('success','Status Berhasil di aktifkan');
        //redirecting
        return redirect(route('tagxsim.index'));
    }

    /**
     * Un-Update Status.
     *
     */
    public function uncomplete($id){
        //dd($todoId);
        $tagxsim=Tag::find($id);
        $tagxsim->update(['status'=>0]);
        
        //splash
        session() -> flash('success','Status Berhasil di non-aktifkan');
        //redirecting
        return redirect(route('tagxsim.index'));
    }
}
