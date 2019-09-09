<?php

namespace App\Http\Controllers\Xsim;

use Auth;
use DB;
use App\KursMk;
use App\KursKode;
use App\Aturan;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Http\Requests\Xsim\KursMk\CreateRequest;
use App\Http\Requests\Xsim\KursMk\UpdateRequest;
use Yajra\Datatables\Datatables;

class KursMkXsim extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('xsim.kursmk.index');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //dd(KursMkCat::all());
        //redirecting
        return view('xsim.kursmk.create')
            ->with('kurskode', KursKode::select('id', 'judul', 'kode','satuan','status')->where('kursmk','=','1')->where('status','=','1')->orderBy('kode', 'ASC')->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRequest $request)
    {   

        // explode mata uang
        $kodekurs = explode(PHP_EOL, preg_replace('/\r/','',$request->kurskode));
        $updatekurs = explode(PHP_EOL, preg_replace('/\r/','',$request->kursmk));
        //dd($request->kurskode);
        // di array agar bisa masuk ke query
        $kode_kurs = implode(", ", $kodekurs);
        $update_kurs = implode(", ", $updatekurs);

        // manual insert into
        $kurskmk = DB::insert("insert into kurs_mks (start_at,end_at,aturan_id,status,create_by,update_by,created_at,".$kode_kurs .")
                     values ('".$request->start_at."','".$request->end_at."','".$request->aturan_id."','0','".Auth::user()->name."','','".$request->start_at."',".$update_kurs.")");
        //dd($kurskmk);
        //Create Post
        /*$kursmk = KursMk::create([
            'start_at'=>$request->start_at,
            'end_at'=>$request->end_at,
            'aturan_id'=>$request->aturan_id,
            'status'=>'0',
            'create_by'=> Auth::user()->name,
            'update_by'=> ''
        ]);
        */

        //splash message
        session() -> flash('success','Data berhasil disimpan');
        //redirecting
        return redirect(route('kursmkxsim.index'));
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
        $kursmk=KursMk::find($id);
        
        return view('xsim.kursmk.create')
            ->with('kursmk', $kursmk)
            ->with('kurskode', KursKode::select('id','judul','kode','satuan','status')->where('kursmk','=','1')->where('status','=','1')->orderBy('kode', 'ASC')->get());

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, KursMk $kursmkxsim)
    {

        $data = $request->All();

        //dd($request->category); cari dulu mata uangnya
        $kurskode=KursKode::select('id','judul','kode','satuan','status')->where('kursmk','=','1')->where('status','=','1')->get();
        // buat input update data per mata uang
        foreach($kurskode as $kurskodes) {
            $kursmkxsim->{$kurskodes->kode}=$request->{$kurskodes->kode};
        }
        
        $data['update_by']=Auth::user()->name;

        $kursmkxsim->update($data);

       // dd($kursmkxsim);
          
        //splash message
        session() -> flash('success','Data berhasil disimpan');
        //redirecting
        return redirect(route('kursmkxsim.index'));
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
        $kursmk=KursMk::find($id);
        if($kursmk->status=='0'){
                //SoftDelete
                $kursmk->delete();
                //splash message
                session() -> flash('success','Data berhasil dialihkan ke Trash');
        }else{
                //splash message
                session() -> flash('warning','Status Data masih aktif');
        }

        //redirecting
        return redirect(route('kursmkxsim.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, KursMk $kursmkxsim)
    {
        if($id=='0'){
            //Restore Proses
            $kursmk = KursMk::onlyTrashed()->get();
            //dd($kursmk);
            foreach ($kursmk as $kursmks)
                {
                    $kursmks->forceDelete();
                }
            //splash message
            session() -> flash('success','Semua Data berhasil dihapus permanen');
        }else{
            //Restore Proses
            $kursmk = KursMk::onlyTrashed()->where('id',$id)->first();
            //dd($kursmk->splash);
            $kursmk->forceDelete();
            //splash message
            session() -> flash('success','Data berhasil dihapus permanen');
        }
        
        //redirecting
        return redirect(route('kursmkxsim.trashed'));
    }

    /**
     * Display a listing of the Trashed.
     *
     * @return \Illuminate\Http\Response
     */
    public function trashed()
    {
        //dd();
        return view('xsim.kursmk.trash');
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
            $kursmk = KursMk::onlyTrashed();
            $kursmk->restore();
            //splash message
            session() -> flash('success','Semua Data berhasil dialihkan ke Production');
        }else{
            //Restore Proses
            $kursmk = KursMk::onlyTrashed()->where('id',$id);
            $kursmk->restore();
            //splash message
            session() -> flash('success','Data berhasil dialihkan ke Production');
        }
        
        //redirecting
        return redirect(route('kursmkxsim.trashed'));
    }
    /**
     * Display a listing of the resource in Json.
     *
     */
    public function dataKursMk()
    {
        return Datatables::of(KursMk::select('id', 'start_at','end_at','aturan_id','created_at','status'))
        ->addColumn('aturan_nomor', function ($kursmk)
        { //change over here 
            $aturanxsim=Aturan::find($kursmk->aturan_id);
            $aturan = $aturanxsim->nomor;
            return $aturan;
        })
        ->editColumn('start_at', function ($kursmk) 
        { //change over here 
            return date('d M Y', strtotime($kursmk->start_at) );
        })
        ->editColumn('end_at', function ($kursmk) 
        { //change over here 
            return date('d M Y', strtotime($kursmk->end_at) );
        })
        ->editColumn('created_at', function ($kursmk) 
        { //change over here 
            return date('d M Y', strtotime($kursmk->created_at) );
        })
        ->make(true);
    }
    /**
     * Display Trashed List in Json.
     *
     */
    public function trashedKursMk()
    {
        //dd(KursMk::query());
        return Datatables::of(KursMk::onlyTrashed()->select('id', 'start_at','end_at','aturan_id','created_at','status'))
        ->addColumn('aturan_nomor', function ($kursmk)
        { //change over here 
            $aturanxsim=Aturan::find($kursmk->aturan_id);
            $aturan = $aturanxsim->nomor;
            return $aturan;
        })
        ->editColumn('start_at', function ($kursmk) 
        { //change over here 
            return date('d M Y', strtotime($kursmk->start_at) );
        })
        ->editColumn('end_at', function ($kursmk) 
        { //change over here 
            return date('d M Y', strtotime($kursmk->end_at) );
        })
        ->editColumn('created_at', function ($kursmk) 
        { //change over here 
            return date('d M Y', strtotime($kursmk->created_at) );
        })
        ->make(true);
    }

    /**
     * Update Status.
     *
     */
    public function complete($id){
        //dd($todoId);
        $kursmkxsim=KursMk::find($id);

        $kursmkxsim->update(['status'=>1]);

        //splash
        session() -> flash('success','Status Berhasil di aktifkan');
        //redirecting
        return redirect(route('kursmkxsim.index'));
    }

    /**
     * Un-Update Status.
     *
     */
    public function uncomplete($id){
        //dd($todoId);
        $kursmkxsim=KursMk::find($id);

        $kursmkxsim->update(['status'=>0]);
        
        //splash
        session() -> flash('success','Status Berhasil di non-aktifkan');
        //redirecting
        return redirect(route('kursmkxsim.index'));
    }
}
