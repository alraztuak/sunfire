<?php

namespace App\Http\Controllers\Xsim;

use Auth;
use App\PutusanCat;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Xsim\PutusanCat\CreateRequest;
use App\Http\Requests\Xsim\PutusanCat\UpdateRequest;
use Yajra\Datatables\Datatables;

class PutusanCatXsim extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('xsim.putusancat.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        //redirecting
        return view('xsim.putusancat.create');
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
        PutusanCat::create([
            'judul'=>$request->judul,
            'status'=>'0',
            'create_by'=> Auth::user()->name,
            'update_by'=> ''
        ]);
          
        //splash message
        session() -> flash('success','Data berhasil disimpan');
        //redirecting
        return redirect(route('putusancatxsim.index'));
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
        $Putusancat=PutusanCat::find($id);
        return view('xsim.putusancat.create')->with('putusancat', $Putusancat);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, PutusanCat $Putusancatxsim)
    {
        $data = $request->only(['judul']);
        // cek new image

        $data['update_by']=Auth::user()->name;

        $Putusancatxsim->update($data);
          
        //splash message
        session() -> flash('success','Data berhasil disimpan');
        //redirecting
        return redirect(route('putusancatxsim.index'));
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
        $Putusancat=PutusanCat::find($id);
        if($Putusancat->Putusans->count()=='0'){
            if($Putusancat->status=='0'){
                    //SoftDelete
                    $Putusancat->forcedelete();
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
        return redirect(route('putusancatxsim.index'));
    }
    /**
     * Display a listing of the resource in Json.
     *
     */
    public function dataPutusanCat()
    {
        return Datatables::of(PutusanCat::select('id', 'judul','created_at','status'))
            ->editColumn('created_at', function ($Putusancat) 
            { //change over here 
            return date('d M Y', strtotime($Putusancat->created_at) );
            })
            ->addColumn('putusans', function ($Putusancat) 
            { //change over here 
                return $Putusancat->putusans->count();
            })
            ->make(true);
    }

    /**
     * Update Status.
     *
     */
    public function complete($id){
        //dd($todoId);
        $Putusancatxsim=PutusanCat::find($id);
        $Putusancatxsim->update(['status'=>1]);

        //splash
        session() -> flash('success','Status Berhasil di aktifkan');
        //redirecting
        return redirect(route('putusancatxsim.index'));
    }

    /**
     * Un-Update Status.
     *
     */
    public function uncomplete($id){
        //dd($todoId);
        $Putusancatxsim=PutusanCat::find($id);
        $Putusancatxsim->update(['status'=>0]);
        
        //splash
        session() -> flash('success','Status Berhasil di non-aktifkan');
        //redirecting
        return redirect(route('putusancatxsim.index'));
    }
}
