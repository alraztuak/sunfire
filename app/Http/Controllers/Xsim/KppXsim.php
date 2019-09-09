<?php

namespace App\Http\Controllers\Xsim;

use Auth;
use App\Kpp;
use App\KppJenis;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Http\Requests\Xsim\Kpp\CreateRequest;
use App\Http\Requests\Xsim\Kpp\UpdateRequest;
use Yajra\Datatables\Datatables;

class KppXsim extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('xsim.kpp.index');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //dd(KppJenis::all());
        //redirecting
        return view('xsim.kpp.create')
            ->with('kppjenis', KppJenis::select('id', 'judul','status')->get());
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

        //Create Post
        $kpp = Kpp::create([
            'kpp_jenis_id'=>$request->kpp_jenis_id,
            'kodekpp'=>$request->kodekpp,
            'kodewil'=>$request->kodewil,
            'nama'=>$request->nama,
            'kota'=>$request->kota,
            'lurah'=>$request->lurah,
            'camat'=>$request->camat,
            'alamat'=>$request->alamat,
            'telepon'=>$request->telepon,
            'fax'=>$request->fax,
            'views'=>'0',
            'status'=>'0',
            'create_by'=> Auth::user()->name,
            'update_by'=> ''
        ]);

        //splash message
        session() -> flash('success','Data berhasil disimpan');
        //redirecting
        return redirect(route('kppxsim.index'));
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
        $kpp=Kpp::find($id);
        return view('xsim.kpp.create')
            ->with('kpp', $kpp)
            ->with('kppjenis', KppJenis::select('id', 'judul','status')->get());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, Kpp $kppxsim)
    {
        $data = $request->only(['Kpp_jenis_id','kodekpp','kodewil','nama','kota','lurah','camat','alamat','telepon','fax']);
        //dd($request->category);

        $data['kpp_jenis_id']=$request->kpp_jenis_id;
        $data['update_by']=Auth::user()->name;

        $kppxsim->update($data);
          
        //splash message
        session() -> flash('success','Data berhasil disimpan');
        //redirecting
        return redirect(route('kppxsim.index'));
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
        $kpp=Kpp::find($id);
        if($kpp->status=='0'){
                //SoftDelete
                $kpp->delete();
                //splash message
                session() -> flash('success','Data berhasil dialihkan ke Trash');
        }else{
                //splash message
                session() -> flash('warning','Status Data masih aktif');
        }

        //redirecting
        return redirect(route('kppxsim.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Kpp $kppxsim)
    {
        if($id=='0'){
            //Restore Proses
            $kpp = Kpp::onlyTrashed()->get();
            //dd($kpp);
            foreach ($kpp as $kpps)
                {
                    $kpps->forceDelete();
                }
            //splash message
            session() -> flash('success','Semua Data berhasil dihapus permanen');
        }else{
            //Restore Proses
            $kpp = Kpp::onlyTrashed()->where('id',$id)->first();
            //dd($kpp->splash);
            $kpp->forceDelete();
            //splash message
            session() -> flash('success','Data berhasil dihapus permanen');
        }
        
        //redirecting
        return redirect(route('kppxsim.trashed'));
    }

    /**
     * Display a listing of the Trashed.
     *
     * @return \Illuminate\Http\Response
     */
    public function trashed()
    {
        //dd();
        return view('xsim.kpp.trash');
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
            $kpp = Kpp::onlyTrashed();
            $kpp->restore();
            //splash message
            session() -> flash('success','Semua Data berhasil dialihkan ke Production');
        }else{
            //Restore Proses
            $kpp = Kpp::onlyTrashed()->where('id',$id);
            $kpp->restore();
            //splash message
            session() -> flash('success','Data berhasil dialihkan ke Production');
        }
        
        //redirecting
        return redirect(route('kppxsim.trashed'));
    }
    /**
     * Display a listing of the resource in Json.
     *
     */
    public function dataKpp()
    {
        return Datatables::of(Kpp::select('id','kota', 'nama','kpp_jenis_id','kodekpp','kodewil','status','created_at'))
        ->addColumn('kpp_jenis', function ($kpp)
        { //change over here 
            $kppjenisxsim=KppJenis::find($kpp->kpp_jenis_id);
            $kpp_jenis = $kppjenisxsim->judul;
            return $kpp_jenis;
        })
        ->editColumn('created_at', function ($kpp) 
        { //change over here 
            return date('d M Y', strtotime($kpp->created_at) );
        })
        ->make(true);
    }
    /**
     * Display Trashed List in Json.
     *
     */
    public function trashedKpp()
    {
        //dd(Kpp::query());
        return Datatables::of(Kpp::onlyTrashed()->select('id','kota', 'nama','kpp_jenis_id','kodekpp','kodewil','status','created_at'))
        ->addColumn('kpp_jenis', function ($kpp)
        { //change over here 
            $kppjenisxsim=KppJenis::find($kpp->kpp_jenis_id);
            $kpp_jenis = $kppjenisxsim->judul;
            return $kpp_jenis;
        })
        ->editColumn('created_at', function ($kpp) 
        { //change over here 
            return date('d M Y', strtotime($kpp->created_at) );
        })
        ->make(true);
    }

    /**
     * Update Status.
     *
     */
    public function complete($id){
        //dd($todoId);
        $kppxsim=Kpp::find($id);

        $kppxsim->update(['status'=>1]);

        //splash
        session() -> flash('success','Status Berhasil di aktifkan');
        //redirecting
        return redirect(route('kppxsim.index'));
    }

    /**
     * Un-Update Status.
     *
     */
    public function uncomplete($id){
        //dd($todoId);
        $kppxsim=Kpp::find($id);

        $kppxsim->update(['status'=>0]);
        
        //splash
        session() -> flash('success','Status Berhasil di non-aktifkan');
        //redirecting
        return redirect(route('kppxsim.index'));
    }
}
