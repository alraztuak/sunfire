<?php

namespace App\Http\Controllers\Xsim;

use Auth;
use DB;
use App\Aturan;
use App\AturanTopik;
use App\AturanJenis;
use App\AturanInfo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Xsim\Aturan\CreateRequest;
use App\Http\Requests\Xsim\Aturan\UpdateRequest;
use Yajra\Datatables\Datatables;

class AturanXsim extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('xsim.aturan.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('xsim.aturan.create')
        ->with('aturan_topik', AturanTopik::select('id', 'judul','status')->get())
        ->with('aturan_jenis', AturanJenis::select('id', 'judul','status')->get())
        ->with('aturan_info', AturanInfo::select('id', 'judul','status')->get());
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
        //upload lampiran
        if($request->lampiran!=''){
            $lampiran = $request->lampiran->store('aturan/lampiran');
        }else{
            $lampiran = '';
        }
        //upload pdf
        if($request->pdf!=''){
            $pdf = $request->pdf->store('aturan/pdf');
        }else{
            $pdf = '';
        }

        //Create Post
        $aturan = Aturan::create([
            'aturan_jenis_id'=>$request->aturan_jenis,
            'aturan_info_id'=>$request->aturan_info,
            'nomor'=>$request->nomor,
            'nomor_index'=>$request->nomor_index,
            'published_at'=>$request->published_at,
            'perihal'=>$request->perihal,
            'isi'=>$request->isi,
            'views'=>'0',
            'status'=>'0',
            'lampiran'=>$lampiran,
            'pdf'=>$pdf,
            'create_by'=> Auth::user()->name,
            'update_by'=> ''
        ]);

        if($request->aturan_topik){
            $aturan->aturanTopiks()->attach($request->aturan_topik);
        }
          
        //splash message
        session() -> flash('success','Data berhasil disimpan');
        //redirecting
        return redirect(route('aturanxsim.index'));
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
        $aturan=Aturan::find($id);
        return view('xsim.aturan.create')
        ->with('aturan', $aturan)
        ->with('aturan_topik', AturanTopik::select('id', 'judul','status')->get())
        ->with('aturan_jenis', AturanJenis::select('id', 'judul','status')->get())
        ->with('aturan_info', AturanInfo::select('id', 'judul','status')->get());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, Aturan $aturanxsim)
    {
        $data = $request->only(['aturan_topik','ç','aturan_info','published_at','nomor','nomor_index','perihal','isi','lampiran','pdf']);
        //dd($request->aturan_jenis);
        // cek new lampiran
        if($request->hasFile('lampiran')){
            //upload lampiran
            $lampiran = $request->lampiran->store('aturan/lampiran');

            // delete old lampiran
            Storage::delete($aturanxsim->lampiran);
            $data['lampiran']=$lampiran;

        }
        // cek new pdf
        if($request->hasFile('pdf')){
            //upload pdf
            $pdf = $request->pdf->store('aturan/pdf');

            // delete old pdf
            Storage::delete($aturanxsim->pdf);
            $data['pdf']=$pdf;

        }

        if($request->aturan_topik){
            $aturanxsim->aturanTopiks()->sync($request->aturan_topik);
        }

        $data['aturan_info_id']=$request->aturan_info;
        $data['aturan_jenis_id']=$request->aturan_jenis;
        $data['published_at']=$request->published_at;
        $data['update_by']=Auth::user()->name;
        //dd($data);
        $aturanxsim->update($data);
        //dd($aturanxsim);
          
        //splash message
        session() -> flash('success','Data berhasil disimpan');
        //redirecting
        return redirect(route('aturanxsim.index'));
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
        $aturan=Aturan::find($id);
        if($aturan->status=='0'){
                //SoftDelete
                $aturan->delete();
                //splash message
                session() -> flash('success','Data berhasil dialihkan ke Trash');
        }else{
                //splash message
                session() -> flash('warning','Status Data masih aktif');
        }

        //redirecting
        return redirect(route('aturanxsim.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if($id=='0'){
            //Restore Proses
            $aturan = Aturan::onlyTrashed()->get();
            //dd($content);
            foreach ($aturan as $aturans)
                {
                    // delete old image
                    Storage::delete($aturans->lampiran,$aturans->pdf);
                    $aturans->forceDelete();
                    $aturans->aturanTopiks()->sync([]);
                }
            //splash message
            session() -> flash('success','Semua Data berhasil dihapus permanen');
        }else{
            //Restore Proses
            $aturan = Aturan::onlyTrashed()->where('id',$id)->first();
            // delete old image
            Storage::delete($aturan->lampiran,$aturan->pdf);
            //dd($content->splash);
            $aturan->forceDelete();
            $aturan->aturanTopiks()->sync([]);
            //splash message
            session() -> flash('success','Data berhasil dihapus permanen');
        }
        
        //redirecting
        return redirect(route('aturanxsim.trashed'));
    }

    /**
     * Display a listing of the Trashed.
     *
     * @return \Illuminate\Http\Response
     */
    public function trashed()
    {
        //dd();
        return view('xsim.aturan.trash');
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
            $aturan = Aturan::onlyTrashed();
            $aturan->restore();
            //splash message
            session() -> flash('success','Semua Data berhasil dialihkan ke Production');
        }else{
            //Restore Proses
            $aturan = Aturan::onlyTrashed()->where('id',$id);
            $aturan->restore();
            //splash message
            session() -> flash('success','Data berhasil dialihkan ke Production');
        }
        
        //redirecting
        return redirect(route('aturanxsim.trashed'));
    }
    
    /**
     * Display a listing of the resource in Json.
     *
     */
    public function dataAturan()
    {
        return Datatables::of(Aturan::query()->select('id', 'nomor','perihal','published_at','status'))
        ->editColumn('published_at', function ($aturan) 
        { //change over here 
            return date('d M Y', strtotime($aturan->published_at) );
        }
        )->make(true);
    }

    /**
     * Display Trashed List in Json.
     *
     */
    public function trashedAturan()
    {
        //dd(Content::query());
        return Datatables::of(Aturan::onlyTrashed()->select('id', 'nomor','perihal','published_at','status'))
        ->editColumn('published_at', function ($aturan) 
        { //change over here 
            return date('d M Y', strtotime($aturan->created_at) );
        }
        )->make(true);
    }

    /**
     * Update Status.
     *
     */
    public function complete($id){
        //dd($todoId);
        $aturanxsim=Aturan::find($id);

        $aturanxsim->update(['status'=>1]);

        //splash
        session() -> flash('success','Status Berhasil di aktifkan');
        //redirecting
        return redirect(route('aturanxsim.index'));
    }

    /**
     * Un-Update Status.
     *
     */
    public function uncomplete($id){
        //dd($todoId);
        $aturanxsim=Aturan::find($id);

        $aturanxsim->update(['status'=>0]);
        
        //splash
        session() -> flash('success','Status Berhasil di non-aktifkan');
        //redirecting
        return redirect(route('aturanxsim.index'));
    }

    /**
     * Highlight
     *
     */
    public function link($id)
    {
        $terkait = DB::table('aturan_terkait')
                    ->join('aturans', 'aturans.id', '=', 'aturan_terkait.terkait_id')
                    ->select('aturan_terkait.id','aturan_terkait.aturan_id','aturan_terkait.terkait_id','aturans.nomor')
                    ->where('aturan_terkait.aturan_id','=', $id)
                    ->get();
        $status = DB::table('aturan_status')
                    ->join('aturans', 'aturans.id', '=', 'aturan_status.status_id')
                    ->select('aturan_status.id','aturan_status.aturan_id','aturan_status.status_id','aturans.nomor')
                    ->where('aturan_status.aturan_id','=', $id)
                    ->get();
        $histori = DB::table('aturan_histori')
                    ->join('aturans', 'aturans.id', '=', 'aturan_histori.histori_id')
                    ->select('aturan_histori.id','aturan_histori.aturan_id','aturan_histori.histori_id','aturans.nomor')
                    ->where('aturan_histori.aturan_id','=', $id)
                    ->get();                
        //dd($status);

        $aturan = request()->query('id');

        if($aturan){
            $aturanxsim = Aturan::where('id', '=', $aturan)->first();
        }else{
            $aturanxsim = Aturan::find($id);
        }

        return view('xsim.aturan.link')
        ->with('aturan', Aturan::find($id))
        ->with('search', $aturanxsim)
        ->with('terkait', $terkait)
        ->with('status', $status)
        ->with('histori', $histori);

    }

    /**
     * Tambah Peraturan Terkait.
     *
     */
    public function addterkait($id,$id_terkait){
        
        //dd($todoId);
        $addterkait=DB::table('aturan_terkait');

        $addterkait->insert(['aturan_id'=>$id,'terkait_id'=>$id_terkait,'created_at'=>now()]);
        
        //splash
        session() -> flash('success','Peraturan Berhasil ditambahkan kedaftar Peraturan Terkait');
        //redirecting
        return redirect(route('aturanxsim.link', $id));
    }

    /**
     * Tambah Peraturan Histori.
     *
     */
    public function addhistori($id,$id_histori){
        
        //dd($todoId);
        $addhistori=DB::table('aturan_histori');

        $addhistori->insert(['aturan_id'=>$id,'histori_id'=>$id_histori,'created_at'=>now()]);
        
        //splash
        session() -> flash('success','Peraturan Berhasil ditambahkan kedaftar Histori Peraturan');
        //redirecting
        return redirect(route('aturanxsim.link', $id));
    }

    /**
     * Tambah Peraturan status.
     *
     */
    public function addstatus($id,$id_status){
        
        //dd($todoId);
        $addstatus=DB::table('aturan_status');

        $addstatus->insert(['aturan_id'=>$id,'status_id'=>$id_status,'created_at'=>now()]);
        
        //splash
        session() -> flash('success','Peraturan Berhasil ditambahkan kedaftar Status Peraturan');
        //redirecting
        return redirect(route('aturanxsim.link', $id));
    }

    /**
     * Tambah Peraturan status.
     *
     */
    public function delstatus($id,$id_status){
        
        //dd($todoId);
        $delstatus=DB::table('aturan_status')->delete($id_status);
        
        //splash
        session() -> flash('success','Peraturan Berhasil di hapus dari daftar Status Peraturan');
        //redirecting
        return redirect(route('aturanxsim.link', $id));
    }

    /**
     * Tambah Peraturan terkait.
     *
     */
    public function delterkait($id,$id_terkait){
        
        //dd($todoId);
        $delterkait=DB::table('aturan_terkait')->delete($id_terkait);
        
        //splash
        session() -> flash('success','Peraturan Berhasil di hapus dari daftar Peraturan Terkait');
        //redirecting
        return redirect(route('aturanxsim.link', $id));
    }

    /**
     * Tambah Peraturan histori.
     *
     */
    public function delhistori($id,$id_histori){
        
        //dd($todoId);
        $delhistori=DB::table('aturan_histori')->delete($id_histori);
        
        //splash
        session() -> flash('success','Peraturan Berhasil di hapus dari daftar Histori Peraturan');
        //redirecting
        return redirect(route('aturanxsim.link', $id));
    }


}
