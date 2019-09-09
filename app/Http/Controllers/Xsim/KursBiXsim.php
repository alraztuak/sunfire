<?php

namespace App\Http\Controllers\Xsim;

use Auth;
use DB;
use App\KursBi;
use App\KursKode;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Http\Requests\Xsim\KursBi\CreateRequest;
use App\Http\Requests\Xsim\KursBi\UpdateRequest;
use Yajra\Datatables\Datatables;

class KursBiXsim extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('xsim.kursbi.index');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //dd(KursBiCat::all());
        //redirecting
        return view('xsim.kursbi.create')
            ->with('kurskode', KursKode::select('id', 'judul', 'kode','satuan','status')->where('kursbi','=','1')->where('status','=','1')->orderBy('kode', 'ASC')->get());
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
        $updatekurs_jual = explode(PHP_EOL, preg_replace('/\r/','',$request->kursbi_jual));
        $updatekurs_beli = explode(PHP_EOL, preg_replace('/\r/','',$request->kursbi_beli));
        $updatekurs_k_jual = explode(PHP_EOL, preg_replace('/\r/','',$request->kursbi_k_jual));
        $updatekurs_k_beli = explode(PHP_EOL, preg_replace('/\r/','',$request->kursbi_k_beli));

        // hitung kurs tengah tanpa loop ... merge dulu array, sum, dan di round
        $updatekurs_tengah = array_map(function($updatekurs_jual,$updatekurs_beli){  
                        return round(array_sum(array($updatekurs_jual,$updatekurs_beli))/2, 2 );
                    },$updatekurs_jual,$updatekurs_beli); 
        
        $updatekurs_k_tengah = array_map(function($updatekurs_k_jual,$updatekurs_k_beli){  
                                    return round(array_sum(array($updatekurs_k_jual,$updatekurs_k_beli))/2, 2 );
                                },$updatekurs_k_jual,$updatekurs_k_beli); 
       
        //dd($request->kurskode);
        // di array agar bisa masuk ke query
        $kode_kurs_jual = implode(", ", array_map( function($kodekurs) { return($kodekurs.'_jual'); }, $kodekurs ));
        $kode_kurs_beli = implode(", ", array_map( function($kodekurs) { return($kodekurs.'_beli'); }, $kodekurs ));
        $kode_kurs_tengah = implode(", ", array_map( function($kodekurs) { return($kodekurs.'_tengah'); }, $kodekurs ));
        $kode_kurs_k_jual = implode(", ", array_map( function($kodekurs) { return($kodekurs.'_k_jual'); }, $kodekurs ));
        $kode_kurs_k_beli = implode(", ", array_map( function($kodekurs) { return($kodekurs.'_k_beli'); }, $kodekurs ));
        $kode_kurs_k_tengah = implode(", ", array_map( function($kodekurs) { return($kodekurs.'_k_tengah'); }, $kodekurs ));
        $update_kurs_jual = implode(", ", $updatekurs_jual);
        $update_kurs_beli = implode(", ", $updatekurs_beli);
        $update_kurs_tengah = implode(", ", $updatekurs_tengah);
        $update_kurs_k_jual = implode(", ", $updatekurs_k_jual);
        $update_kurs_k_beli = implode(", ", $updatekurs_k_beli);
        $update_kurs_k_tengah = implode(", ", $updatekurs_k_tengah);
        //dd($update_kurs_k_tengah);

        // manual insert into
        $kurskmk = DB::insert("insert into kurs_bis (start_at,end_at,status,create_by,update_by,created_at,".$kode_kurs_jual.",".$kode_kurs_beli.",".$kode_kurs_k_jual.",".$kode_kurs_k_beli.",".$kode_kurs_tengah.",".$kode_kurs_k_tengah.")
                     values ('".$request->start_at."','".$request->end_at."','0','".Auth::user()->name."','','".$request->start_at."',".$update_kurs_jual.",".$update_kurs_beli.",".$update_kurs_k_jual.",".$update_kurs_k_beli.",".$update_kurs_tengah.",".$update_kurs_k_tengah.")");
        //dd($kurskmk);
        //Create Post
        /*$kursbi = KursBi::create([
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
        return redirect(route('kursbixsim.index'));
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
        $kursbi=KursBi::find($id);
        
        return view('xsim.kursbi.create')
            ->with('kursbi', $kursbi)
            ->with('kurskode', KursKode::select('id','judul','kode','satuan','status')->where('kursbi','=','1')->where('status','=','1')->orderBy('kode', 'ASC')->get());

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, KursBi $kursbixsim)
    {

        $data = $request->All();

        //dd($request->category); cari dulu mata uangnya
        $kurskode=KursKode::select('id','judul','kode','satuan','status')->where('kursbi','=','1')->where('status','=','1')->get();

        // buat input update data per mata uang
        foreach($kurskode as $kurskodes) {
            $kursbixsim->{$kurskodes->kode.'_jual'}=$request->{$kurskodes->kode.'_jual'};
            $kursbixsim->{$kurskodes->kode.'_beli'}=$request->{$kurskodes->kode.'_beli'};
            $kursbixsim->{$kurskodes->kode.'_tengah'}=round(($request->{$kurskodes->kode.'_beli'}+$request->{$kurskodes->kode.'_jual'})/2 ,2);
            $kursbixsim->{$kurskodes->kode.'_k_jual'}=$request->{$kurskodes->kode.'_k_jual'};
            $kursbixsim->{$kurskodes->kode.'_k_beli'}=$request->{$kurskodes->kode.'_k_beli'};
            $kursbixsim->{$kurskodes->kode.'_k_tengah'}=round(($request->{$kurskodes->kode.'_k_beli'}+$request->{$kurskodes->kode.'_k_jual'})/2 ,2);
        }

        $data['update_by']=Auth::user()->name;
        
        $kursbixsim->update($data);

       // dd($kursbixsim);
          
        //splash message
        session() -> flash('success','Data berhasil disimpan');
        //redirecting
        return redirect(route('kursbixsim.index'));
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
        $kursbi=KursBi::find($id);
        if($kursbi->status=='0'){
                //SoftDelete
                $kursbi->delete();
                //splash message
                session() -> flash('success','Data berhasil dialihkan ke Trash');
        }else{
                //splash message
                session() -> flash('warning','Status Data masih aktif');
        }

        //redirecting
        return redirect(route('kursbixsim.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, KursBi $kursbixsim)
    {
        if($id=='0'){
            //Restore Proses
            $kursbi = KursBi::onlyTrashed()->get();
            //dd($kursbi);
            foreach ($kursbi as $kursbis)
                {
                    $kursbis->forceDelete();
                }
            //splash message
            session() -> flash('success','Semua Data berhasil dihapus permanen');
        }else{
            //Restore Proses
            $kursbi = KursBi::onlyTrashed()->where('id',$id)->first();
            //dd($kursbi->splash);
            $kursbi->forceDelete();
            //splash message
            session() -> flash('success','Data berhasil dihapus permanen');
        }
        
        //redirecting
        return redirect(route('kursbixsim.trashed'));
    }

    /**
     * Display a listing of the Trashed.
     *
     * @return \Illuminate\Http\Response
     */
    public function trashed()
    {
        //dd();
        return view('xsim.kursbi.trash');
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
            $kursbi = KursBi::onlyTrashed();
            $kursbi->restore();
            //splash message
            session() -> flash('success','Semua Data berhasil dialihkan ke Production');
        }else{
            //Restore Proses
            $kursbi = KursBi::onlyTrashed()->where('id',$id);
            $kursbi->restore();
            //splash message
            session() -> flash('success','Data berhasil dialihkan ke Production');
        }
        
        //redirecting
        return redirect(route('kursbixsim.trashed'));
    }
    /**
     * Display a listing of the resource in Json.
     *
     */
    public function dataKursBi()
    {
        return Datatables::of(KursBi::select('id', 'start_at','end_at','created_at','status'))
        ->editColumn('start_at', function ($kursbi) 
        { //change over here 
            return date('d M Y', strtotime($kursbi->start_at) );
        })
        ->editColumn('end_at', function ($kursbi) 
        { //change over here 
            return date('d M Y', strtotime($kursbi->end_at) );
        })
        ->editColumn('created_at', function ($kursbi) 
        { //change over here 
            return date('d M Y', strtotime($kursbi->created_at) );
        })
        ->make(true);
    }
    /**
     * Display Trashed List in Json.
     *
     */
    public function trashedKursBi()
    {
        //dd(KursBi::query());
        return Datatables::of(KursBi::onlyTrashed()->select('id', 'start_at','end_at','created_at','status'))
        ->editColumn('start_at', function ($kursbi) 
        { //change over here 
            return date('d M Y', strtotime($kursbi->start_at) );
        })
        ->editColumn('end_at', function ($kursbi) 
        { //change over here 
            return date('d M Y', strtotime($kursbi->end_at) );
        })
        ->editColumn('created_at', function ($kursbi) 
        { //change over here 
            return date('d M Y', strtotime($kursbi->created_at) );
        })
        ->make(true);
    }

    /**
     * Update Status.
     *
     */
    public function complete($id){
        //dd($todoId);
        $kursbixsim=KursBi::find($id);

        $kursbixsim->update(['status'=>1]);

        //splash
        session() -> flash('success','Status Berhasil di aktifkan');
        //redirecting
        return redirect(route('kursbixsim.index'));
    }

    /**
     * Un-Update Status.
     *
     */
    public function uncomplete($id){
        //dd($todoId);
        $kursbixsim=KursBi::find($id);

        $kursbixsim->update(['status'=>0]);
        
        //splash
        session() -> flash('success','Status Berhasil di non-aktifkan');
        //redirecting
        return redirect(route('kursbixsim.index'));
    }
}
