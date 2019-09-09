<?php

namespace App\Http\Controllers\Xsim;

use Auth;
use App\Treaty;
use App\TreatyInfo;
use App\TreatyJenis;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Http\Requests\Xsim\Treaty\CreateRequest;
use App\Http\Requests\Xsim\Treaty\UpdateRequest;
use Yajra\Datatables\Datatables;

class TreatyXsim extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('xsim.treaty.index');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //dd(TreatyInfo::all());
        //redirecting
        return view('xsim.treaty.create')
            ->with('treatyinfo', TreatyInfo::select('id','kode','indonesia','status')->get())
            ->with('treatyjenis', TreatyJenis::select('id','judul','status')->get());
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

        $treatyinfoxsim=TreatyInfo::find($request->treaty_info_id);
        $kode = $treatyinfoxsim->kode;

        //Create Post
        $treaty = Treaty::create([
            'judul'=>$request->judul,
            'treaty_info_id'=>$request->treaty_info_id,
            'treaty_jenis_id'=>$request->treaty_jenis_id,
            'kode'=>$kode,
            'isi_id'=>$request->isi_id,
            'isi_en'=>$request->isi_en,
            'views'=>'0',
            'status'=>'0',
            'signed_at'=>$request->signed_at,
            'published_at'=>$request->published_at,
            'create_by'=> Auth::user()->name,
            'update_by'=> ''
        ]);

        //splash message
        session() -> flash('success','Data berhasil disimpan');
        //redirecting
        return redirect(route('treatyxsim.index'));
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
        $treaty=Treaty::find($id);
        return view('xsim.treaty.create')
            ->with('treaty', $treaty)
            ->with('treatyinfo', TreatyInfo::select('id','kode','indonesia','status')->get())
            ->with('treatyjenis', TreatyJenis::select('id','judul','status')->get());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, Treaty $treatyxsim)
    {
        $data = $request->only(['treaty_info_id','treaty_jenis_id','judul','kode','isi_id','isi_en','signed_at','published_at']);
        //dd($request->category);

        $treatyinfoxsim=TreatyInfo::find($request->treaty_info_id);
        $kode = $treatyinfoxsim->kode;

        $data['treaty_info_id']=$request->treaty_info_id;
        $data['treaty_jenis_id']=$request->treaty_jenis_id;
        $data['kode']=$kode;
        $data['update_by']=Auth::user()->name;

        $treatyxsim->update($data);
          
        //splash message
        session() -> flash('success','Data berhasil disimpan');
        //redirecting
        return redirect(route('treatyxsim.index'));
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
        $treaty=Treaty::find($id);
        if($treaty->status=='0'){
                //SoftDelete
                $treaty->delete();
                //splash message
                session() -> flash('success','Data berhasil dialihkan ke Trash');
        }else{
                //splash message
                session() -> flash('warning','Status Data masih aktif');
        }

        //redirecting
        return redirect(route('treatyxsim.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Treaty $treatyxsim)
    {
        if($id=='0'){
            //Restore Proses
            $treaty = Treaty::onlyTrashed()->get();
            //dd($treaty);
            foreach ($treaty as $treatys)
                {
                    $treatys->forceDelete();
                }
            //splash message
            session() -> flash('success','Semua Data berhasil dihapus permanen');
        }else{
            //Restore Proses
            $treaty = Treaty::onlyTrashed()->where('id',$id)->first();
            //dd($treaty->splash);
            $treaty->forceDelete();
            //splash message
            session() -> flash('success','Data berhasil dihapus permanen');
        }
        
        //redirecting
        return redirect(route('treatyxsim.trashed'));
    }

    /**
     * Display a listing of the Trashed.
     *
     * @return \Illuminate\Http\Response
     */
    public function trashed()
    {
        //dd();
        return view('xsim.treaty.trash');
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
            $treaty = Treaty::onlyTrashed();
            $treaty->restore();
            //splash message
            session() -> flash('success','Semua Data berhasil dialihkan ke Production');
        }else{
            //Restore Proses
            $treaty = Treaty::onlyTrashed()->where('id',$id);
            $treaty->restore();
            //splash message
            session() -> flash('success','Data berhasil dialihkan ke Production');
        }
        
        //redirecting
        return redirect(route('treatyxsim.trashed'));
    }
    /**
     * Display a listing of the resource in Json.
     *
     */
    public function dataTreaty()
    {
        return Datatables::of(Treaty::select('id', 'judul','kode','treaty_jenis_id','published_at','status'))
        ->addColumn('treaty_jenis', function ($treaty)
        { //change over here 
            $treatyjenisxsim=TreatyJenis::find($treaty->treaty_jenis_id);
            $treaty_jenis = $treatyjenisxsim->judul;
            return $treaty_jenis;
        })
        ->editColumn('published_at', function ($treaty) 
        { //change over here 
            return date('d M Y', strtotime($treaty->published_at) );
        })
        ->make(true);
    }
    /**
     * Display Trashed List in Json.
     *
     */
    public function trashedTreaty()
    {
        //dd(Treaty::query());
        return Datatables::of(Treaty::onlyTrashed()->select('id', 'judul','kode','treaty_jenis_id','published_at','status'))
        ->addColumn('treaty_jenis', function ($treaty)
        { //change over here 
            $treatyjenisxsim=TreatyJenis::find($treaty->treaty_jenis_id);
            $jenis = $treatyjenisxsim->judul;
            return $jenis;
        })
        ->editColumn('published_at', function ($treaty) 
        { //change over here 
            return date('d M Y', strtotime($treaty->published_at) );
        })
        ->make(true);
    }

    /**
     * Update Status.
     *
     */
    public function complete($id){
        //dd($todoId);
        $treatyxsim=Treaty::find($id);

        $treatyxsim->update(['status'=>1]);

        //splash
        session() -> flash('success','Status Berhasil di aktifkan');
        //redirecting
        return redirect(route('treatyxsim.index'));
    }

    /**
     * Un-Update Status.
     *
     */
    public function uncomplete($id){
        //dd($todoId);
        $treatyxsim=Treaty::find($id);

        $treatyxsim->update(['status'=>0]);
        
        //splash
        session() -> flash('success','Status Berhasil di non-aktifkan');
        //redirecting
        return redirect(route('treatyxsim.index'));
    }
}
