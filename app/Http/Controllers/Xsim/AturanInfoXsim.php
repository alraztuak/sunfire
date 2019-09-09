<?php

namespace App\Http\Controllers\Xsim;

use Auth;
use App\AturanInfo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Xsim\AturanInfo\CreateRequest;
use App\Http\Requests\Xsim\AturanInfo\UpdateRequest;
use Yajra\Datatables\Datatables;

class AturanInfoXsim extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('xsim.aturaninfo.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        //redirecting
        return view('xsim.aturaninfo.create');
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
        AturanInfo::create([
            'id'=>$request->id,
            'judul'=>$request->judul,
            'status'=>'0',
            'create_by'=> Auth::user()->name,
            'update_by'=> ''
        ]);
          
        //splash message
        session() -> flash('success','Data berhasil disimpan');
        //redirecting
        return redirect(route('aturaninfoxsim.index'));
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
        $aturaninfo=AturanInfo::find($id);
        return view('xsim.aturaninfo.create')->with('aturaninfo', $aturaninfo);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, AturanInfo $aturaninfoxsim)
    {
        $data = $request->only(['id','judul']);
        // cek new image

        $data['update_by']=Auth::user()->name;

        $aturaninfoxsim->update($data);
          
        //splash message
        session() -> flash('success','Data berhasil disimpan');
        //redirecting
        return redirect(route('aturaninfoxsim.index'));
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
        $aturaninfo=AturanInfo::find($id);
        if($aturaninfo->aturans->count()=='0'){
            if($aturaninfo->status=='0'){
                    //SoftDelete
                    $aturaninfo->forcedelete();
                    //splash message
                    session() -> flash('success','Data berhasil dihapus');
            }else{
                    //splash message
                    session() -> flash('warning','Status Data masih aktif');
            }
        }else{
            //splash message
            session() -> flash('warning','Info Status Peraturan masih digunakan, hapus Peraturan terlebih dahulu');
        }
        //redirecting
        return redirect(route('aturaninfoxsim.index'));
    }
    /**
     * Display a listing of the resource in Json.
     *
     */
    public function dataAturanInfo()
    {
        return Datatables::of(AturanInfo::query())
            ->editColumn('created_at', function ($aturaninfo) 
            { //change over here 
            return date('d M Y', strtotime($aturaninfo->created_at) );
            })
            ->addColumn('aturan', function ($aturaninfo) 
            { //change over here 
                return $aturaninfo->aturans->count();
            })
            ->make(true);
    }

    /**
     * Update Status.
     *
     */
    public function complete($id){
        //dd($todoId);
        $aturaninfoxsim=AturanInfo::find($id);
        $aturaninfoxsim->update(['status'=>1]);

        //splash
        session() -> flash('success','Status Berhasil di aktifkan');
        //redirecting
        return redirect(route('aturaninfoxsim.index'));
    }

    /**
     * Un-Update Status.
     *
     */
    public function uncomplete($id){
        //dd($todoId);
        $aturaninfoxsim=AturanInfo::find($id);
        $aturaninfoxsim->update(['status'=>0]);
        
        //splash
        session() -> flash('success','Status Berhasil di non-aktifkan');
        //redirecting
        return redirect(route('aturaninfoxsim.index'));
    }
}
