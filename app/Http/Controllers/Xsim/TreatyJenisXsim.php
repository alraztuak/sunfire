<?php

namespace App\Http\Controllers\Xsim;

use Auth;
use App\TreatyJenis;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Xsim\TreatyJenis\CreateRequest;
use App\Http\Requests\Xsim\TreatyJenis\UpdateRequest;
use Yajra\Datatables\Datatables;

class TreatyJenisXsim extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('xsim.treatyjenis.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        //redirecting
        return view('xsim.treatyjenis.create');
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
        TreatyJenis::create([
            'judul'=>$request->judul,
            'status'=>'0',
            'create_by'=> Auth::user()->name,
            'update_by'=> ''
        ]);
          
        //splash message
        session() -> flash('success','Data berhasil disimpan');
        //redirecting
        return redirect(route('treatyjenisxsim.index'));
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
        $treatyjenis=TreatyJenis::find($id);
        return view('xsim.treatyjenis.create')->with('treatyjenis', $treatyjenis);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, TreatyJenis $treatyjenisxsim)
    {
        $data = $request->only(['judul']);
        // cek new image

        $data['update_by']=Auth::user()->name;

        $treatyjenisxsim->update($data);
          
        //splash message
        session() -> flash('success','Data berhasil disimpan');
        //redirecting
        return redirect(route('treatyjenisxsim.index'));
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
        $treatyjenis=TreatyJenis::find($id);
        if($treatyjenis->treaties->count()=='0'){
            if($treatyjenis->status=='0'){
                    //SoftDelete
                    $treatyjenis->forcedelete();
                    //splash message
                    session() -> flash('success','Data berhasil dihapus');
            }else{
                    //splash message
                    session() -> flash('warning','Status Data masih aktif');
            }
        }else{
            //splash message
            session() -> flash('warning','Category Treaty masih digunakan, hapus Treaty terlebih dahulu');
        }
        //redirecting
        return redirect(route('treatyjenisxsim.index'));
    }
    /**
     * Display a listing of the resource in Json.
     *
     */
    public function dataTreatyJenis()
    {
        return Datatables::of(TreatyJenis::select('id', 'judul','created_at','status'))
            ->editColumn('created_at', function ($treatyjenis) 
            { //change over here 
            return date('d M Y', strtotime($treatyjenis->created_at) );
            })
            ->addColumn('treaties', function ($treatyjenis) 
            { //change over here 
                return $treatyjenis->treaties->count();
            })
            ->make(true);
    }

    /**
     * Update Status.
     *
     */
    public function complete($id){
        //dd($todoId);
        $treatyjenisxsim=TreatyJenis::find($id);
        $treatyjenisxsim->update(['status'=>1]);

        //splash
        session() -> flash('success','Status Berhasil di aktifkan');
        //redirecting
        return redirect(route('treatyjenisxsim.index'));
    }

    /**
     * Un-Update Status.
     *
     */
    public function uncomplete($id){
        //dd($todoId);
        $treatyjenisxsim=TreatyJenis::find($id);
        $treatyjenisxsim->update(['status'=>0]);
        
        //splash
        session() -> flash('success','Status Berhasil di non-aktifkan');
        //redirecting
        return redirect(route('treatyjenisxsim.index'));
    }
}
