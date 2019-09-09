<?php

namespace App\Http\Controllers\Xsim;

use Auth;
use App\KppJenis;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Xsim\KppJenis\CreateRequest;
use App\Http\Requests\Xsim\KppJenis\UpdateRequest;
use Yajra\Datatables\Datatables;

class KppJenisXsim extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('xsim.kppjenis.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        //redirecting
        return view('xsim.kppjenis.create');
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
        KppJenis::create([
            'judul'=>$request->judul,
            'status'=>'0',
            'create_by'=> Auth::user()->name,
            'update_by'=> ''
        ]);
          
        //splash message
        session() -> flash('success','Data berhasil disimpan');
        //redirecting
        return redirect(route('kppjenisxsim.index'));
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
        $kppjenis=KppJenis::find($id);
        return view('xsim.kppjenis.create')->with('kppjenis', $kppjenis);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, KppJenis $kppjenisxsim)
    {
        $data = $request->only(['judul']);
        // cek new image

        $data['update_by']=Auth::user()->name;

        $kppjenisxsim->update($data);
          
        //splash message
        session() -> flash('success','Data berhasil disimpan');
        //redirecting
        return redirect(route('kppjenisxsim.index'));
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
        $kppjenis=KppJenis::find($id);
        if($kppjenis->kpps->count()=='0'){
            if($kppjenis->status=='0'){
                    //SoftDelete
                    $kppjenis->forcedelete();
                    //splash message
                    session() -> flash('success','Data berhasil dihapus');
            }else{
                    //splash message
                    session() -> flash('warning','Status Data masih aktif');
            }
        }else{
            //splash message
            session() -> flash('warning','Category Putusan masih digunakan, hapus Putusan terlebih dahulu');
        }
        //redirecting
        return redirect(route('kppjenisxsim.index'));
    }
    /**
     * Display a listing of the resource in Json.
     *
     */
    public function dataKppJenis()
    {
        return Datatables::of(KppJenis::select('id', 'judul','created_at','status'))
            ->editColumn('created_at', function ($kppjenis) 
            { //change over here 
            return date('d M Y', strtotime($kppjenis->created_at) );
            })
            ->addColumn('kpps', function ($kppjenis) 
            { //change over here 
                return $kppjenis->kpps->count();
            })
            ->make(true);
    }

    /**
     * Update Status.
     *
     */
    public function complete($id){
        //dd($todoId);
        $kppjenisxsim=KppJenis::find($id);
        $kppjenisxsim->update(['status'=>1]);

        //splash
        session() -> flash('success','Status Berhasil di aktifkan');
        //redirecting
        return redirect(route('kppjenisxsim.index'));
    }

    /**
     * Un-Update Status.
     *
     */
    public function uncomplete($id){
        //dd($todoId);
        $kppjenisxsim=KppJenis::find($id);
        $kppjenisxsim->update(['status'=>0]);
        
        //splash
        session() -> flash('success','Status Berhasil di non-aktifkan');
        //redirecting
        return redirect(route('kppjenisxsim.index'));
    }
}
