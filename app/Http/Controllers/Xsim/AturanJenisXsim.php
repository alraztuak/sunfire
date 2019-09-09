<?php

namespace App\Http\Controllers\Xsim;

use Auth;
use App\AturanJenis;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Xsim\AturanJenis\CreateRequest;
use App\Http\Requests\Xsim\AturanJenis\UpdateRequest;
use Yajra\Datatables\Datatables;

class AturanJenisXsim extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('xsim.aturanjenis.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        //redirecting
        return view('xsim.aturanjenis.create');
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
        AturanJenis::create([
            'id'=>$request->id,
            'judul'=>$request->judul,
            'status'=>'0',
            'create_by'=> Auth::user()->name,
            'update_by'=> ''
        ]);
          
        //splash message
        session() -> flash('success','Data berhasil disimpan');
        //redirecting
        return redirect(route('aturanjenisxsim.index'));
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
        $aturanjenis=AturanJenis::find($id);
        return view('xsim.aturanjenis.create')->with('aturanjenis', $aturanjenis);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, AturanJenis $aturanjenisxsim)
    {
        $data = $request->only(['id','judul']);
        // cek new image

        $data['update_by']=Auth::user()->name;

        $aturanjenisxsim->update($data);
          
        //splash message
        session() -> flash('success','Data berhasil disimpan');
        //redirecting
        return redirect(route('aturanjenisxsim.index'));
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
        $aturanjenis=AturanJenis::find($id);
        if($aturanjenis->aturans->count()=='0'){
            if($aturanjenis->status=='0'){
                    //SoftDelete
                    $aturanjenis->forcedelete();
                    //splash message
                    session() -> flash('success','Data berhasil dihapus');
            }else{
                    //splash message
                    session() -> flash('warning','Status Data masih aktif');
            }
        }else{
            //splash message
            session() -> flash('warning','Jenis Peraturan masih digunakan, hapus Peraturan terlebih dahulu');
        }
        //redirecting
        return redirect(route('aturanjenisxsim.index'));
    }
    /**
     * Display a listing of the resource in Json.
     *
     */
    public function dataAturanJenis()
    {
        return Datatables::of(AturanJenis::query())
            ->editColumn('created_at', function ($aturanjenis) 
            { //change over here 
            return date('d M Y', strtotime($aturanjenis->created_at) );
            })
            ->addColumn('aturan', function ($aturanjenis) 
            { //change over here 
                return $aturanjenis->aturans->count();
            })
            ->make(true);
    }

    /**
     * Update Status.
     *
     */
    public function complete($id){
        //dd($todoId);
        $aturanjenisxsim=AturanJenis::find($id);
        $aturanjenisxsim->update(['status'=>1]);

        //splash
        session() -> flash('success','Status Berhasil di aktifkan');
        //redirecting
        return redirect(route('aturanjenisxsim.index'));
    }

    /**
     * Un-Update Status.
     *
     */
    public function uncomplete($id){
        //dd($todoId);
        $aturanjenisxsim=AturanJenis::find($id);
        $aturanjenisxsim->update(['status'=>0]);
        
        //splash
        session() -> flash('success','Status Berhasil di non-aktifkan');
        //redirecting
        return redirect(route('aturanjenisxsim.index'));
    }
}
