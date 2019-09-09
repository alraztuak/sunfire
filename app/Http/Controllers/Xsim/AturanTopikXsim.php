<?php

namespace App\Http\Controllers\Xsim;

use Auth;
use App\AturanTopik;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Xsim\AturanTopik\CreateRequest;
use App\Http\Requests\Xsim\AturanTopik\UpdateRequest;
use Yajra\Datatables\Datatables;

class AturanTopikXsim extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('xsim.aturantopik.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        //redirecting
        return view('xsim.aturantopik.create');
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
        AturanTopik::create([
            'id'=>$request->id,
            'judul'=>$request->judul,
            'status'=>'0',
            'create_by'=> Auth::user()->name,
            'update_by'=> ''
        ]);
          
        //splash message
        session() -> flash('success','Data berhasil disimpan');
        //redirecting
        return redirect(route('aturantopikxsim.index'));
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
        $aturantopik=AturanTopik::find($id);
        return view('xsim.aturantopik.create')->with('aturantopik', $aturantopik);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, AturanTopik $aturantopikxsim)
    {
        $data = $request->only(['id','judul']);
        // cek new image

        $data['update_by']=Auth::user()->name;

        $aturantopikxsim->update($data);
          
        //splash message
        session() -> flash('success','Data berhasil disimpan');
        //redirecting
        return redirect(route('aturantopikxsim.index'));
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
        $aturantopik=AturanTopik::find($id);
        if($aturantopik->aturans->count()=='0'){
            if($aturantopik->status=='0'){
                    //SoftDelete
                    $aturantopik->forcedelete();
                    //splash message
                    session() -> flash('success','Data berhasil dihapus');
            }else{
                    //splash message
                    session() -> flash('warning','Status Data masih aktif');
            }
        }else{
            //splash message
            session() -> flash('warning','Topik Peraturan masih digunakan, hapus Peraturan terlebih dahulu');
        }
        //redirecting
        return redirect(route('aturantopikxsim.index'));
    }
    /**
     * Display a listing of the resource in Json.
     *
     */
    public function dataAturanTopik()
    {
        return Datatables::of(AturanTopik::query())
            ->editColumn('created_at', function ($aturantopik) 
            { //change over here 
            return date('d M Y', strtotime($aturantopik->created_at) );
            })
            ->addColumn('aturan', function ($aturantopik) 
            { //change over here 
                return $aturantopik->aturans->count();
            })
            ->make(true);
    }

    /**
     * Update Status.
     *
     */
    public function complete($id){
        //dd($todoId);
        $aturantopikxsim=AturanTopik::find($id);
        $aturantopikxsim->update(['status'=>1]);

        //splash
        session() -> flash('success','Status Berhasil di aktifkan');
        //redirecting
        return redirect(route('aturantopikxsim.index'));
    }

    /**
     * Un-Update Status.
     *
     */
    public function uncomplete($id){
        //dd($todoId);
        $aturantopikxsim=AturanTopik::find($id);
        $aturantopikxsim->update(['status'=>0]);
        
        //splash
        session() -> flash('success','Status Berhasil di non-aktifkan');
        //redirecting
        return redirect(route('aturantopikxsim.index'));
    }
}
