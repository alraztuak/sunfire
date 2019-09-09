<?php

namespace App\Http\Controllers\Xsim;

use Auth;
use App\KursKode;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Str;
use App\Http\Requests\Xsim\KursKode\CreateRequest;
use App\Http\Requests\Xsim\KursKode\UpdateRequest;
use Yajra\Datatables\Datatables;

class KursKodeXsim extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('xsim.kurskode.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        //redirecting
        return view('xsim.kurskode.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRequest $request)
    {
        //upload image
        if($request->splash!=''){
            $image = $request->splash->store('kurskode');
        }else{
            $image = '';
        }

        if($request->kursmk=='on'){
            $column_kmk = $request->kode;
            $value_kmk = '1';
            //dd($column_kmk );
            $isColKmkExist = Schema::hasColumn('kurs_mks',$column_kmk);
            if(!$isColKmkExist){
                Schema::table('kurs_mks', function (Blueprint $table) use ($column_kmk)
                {
                    $table->double($column_kmk)->nullable()->default('0')->after('end_at');
                });
            }
        }else{
            $value_kmk = '0';
        }

        if($request->kursbi=='on'){
            $column_bi = $request->kode;
            $value_bi = '1';
            //dd($column_bi);
            $isColBiExist = Schema::hasColumn('kurs_bis',$column_bi."_jual");
            if(!$isColBiExist){
                Schema::table('kurs_bis', function (Blueprint $table) use ($column_bi)
                {
                    $table->double($column_bi."_jual")->nullable()->default('0')->after('end_at');
                    $table->double($column_bi."_beli")->nullable()->default('0')->after('end_at');
                    $table->double($column_bi."_tengah")->nullable()->default('0')->after('end_at');
                    $table->double($column_bi."_k_jual")->nullable()->default('0')->after('end_at');
                    $table->double($column_bi."_k_beli")->nullable()->default('0')->after('end_at');
                    $table->double($column_bi."_k_tengah")->nullable()->default('0')->after('end_at');
                });
            }
        }else{
            $value_bi = '0';
        }

        //Create Post
        KursKode::create([
            'judul'=>$request->judul,
            'kode'=>$request->kode,
            'satuan'=>$request->satuan,
            'kursmk'=>$value_kmk,
            'kursbi'=>$value_bi,
            'splash'=>$image,
            'status'=>'0',
            'create_by'=> Auth::user()->name,
            'update_by'=> ''
        ]);
          
        //splash message
        session() -> flash('success','Data berhasil disimpan');
        //redirecting
        return redirect(route('kurskodexsim.index'));
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
        $kurskode=KursKode::find($id);
        return view('xsim.kurskode.create')->with('kurskode', $kurskode);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, KursKode $kurskodexsim)
    {
        $data = $request->only(['judul','kode','satuan','kursmk','kursbi']);
        
        // cek new image
        if($request->hasFile('splash')){
            //upload image
            $image = $request->splash->store('kurskode');

            // delete old image
            Storage::delete($kurskodexsim->splash);
            $data['splash']=$image;

        }
        // add table in kursMK
        if($request->kursmk=='on'){
            $column_kmk = $request->kode;
            $value_kmk = '1';
            //dd($column_kmk );
            $isColKmkExist = Schema::hasColumn('kurs_mks',$column_kmk);
            if(!$isColKmkExist){
                Schema::table('kurs_mks', function (Blueprint $table) use ($column_kmk)
                {
                    $table->double($column_kmk)->nullable()->default('0')->after('end_at');
                });
            }
        }else{
            $value_kmk = '0';
        }

        // add table in kursBI
        if($request->kursbi=='on'){
            $column_bi = $request->kode;
            $value_bi = '1';
            //dd($column_kmk );
            $isColBiExist = Schema::hasColumn('kurs_bis',$column_bi."_jual");
            if(!$isColBiExist){
                Schema::table('kurs_bis', function (Blueprint $table) use ($column_bi)
                {
                    $table->double($column_bi."_jual")->nullable()->default('0')->after('end_at');
                    $table->double($column_bi."_beli")->nullable()->default('0')->after('end_at');
                    $table->double($column_bi."_tengah")->nullable()->default('0')->after('end_at');
                    $table->double($column_bi."_k_jual")->nullable()->default('0')->after('end_at');
                    $table->double($column_bi."_k_beli")->nullable()->default('0')->after('end_at');
                    $table->double($column_bi."_k_tengah")->nullable()->default('0')->after('end_at');
                });
            }
        }else{
            $value_bi = '0';
        }

        $data['kursmk']=$value_kmk;
        $data['kursbi']=$value_bi;
        $data['update_by']=Auth::user()->name;
        $kurskodexsim->update($data);
          
        //splash message
        session() -> flash('success','Data berhasil disimpan');
        //redirecting
        return redirect(route('kurskodexsim.index'));
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
        $kurskode=KursKode::find($id);
       
            if($kurskode->status=='0'){

                $column = $kurskode->kode;
                    if(Schema::hasColumn('kurs_mks',$column)){
                        session() -> flash('warning','Mata uang masih digunakan');
                    }else{
                        // delete old image
                        Storage::delete($kurskode->splash);
                        //SoftDelete
                        $kurskode->forcedelete();
                        //splash message
                        session() -> flash('success','Data berhasil dihapus');
                    }
            }else{
                    //splash message
                    session() -> flash('warning','Status Data masih aktif');
            }
        //redirecting
        return redirect(route('kurskodexsim.index'));
    }
    /**
     * Display a listing of the resource in Json.
     *
     */
    public function dataKursKode()
    {
        return Datatables::of(KursKode::select('id', 'judul','kode','satuan','kursmk','kursbi','created_at','status'))
            ->editColumn('created_at', function ($kurskode) 
            { //change over here 
            return date('d M Y', strtotime($kurskode->created_at) );
            })
            ->editColumn('kursmk', function ($kurskode) 
            { //change over here 
                if($kurskode->kursmk=='1')
                {
                    $kursmk = '<i class="fas fa-lg fa-check-circle" style="color:green"></i>';
                }else{
                    $kursmk = '<i class="fas fa-lg fa-times-circle" style="color:red"></i>';
                }
                return $kursmk;
            })
            ->editColumn('kursbi', function ($kurskode) 
            { //change over here 
                if($kurskode->kursbi=='1')
                {
                    $kursbi = '<i class="fas fa-lg fa-check-circle" style="color:green"></i>';
                }else{
                    $kursbi = '<i class="fas fa-lg fa-times-circle" style="color:red"></i>';
                }
                return $kursbi;
            })
            ->rawColumns(['kursmk', 'kursbi'])
            ->toJson();
    }

    /**
     * Update Status.
     *
     */
    public function complete($id){
        //dd($todoId);
        $kurskodexsim=KursKode::find($id);
        $kurskodexsim->update(['status'=>1]);

        //splash
        session() -> flash('success','Status Berhasil di aktifkan');
        //redirecting
        return redirect(route('kurskodexsim.index'));
    }

    /**
     * Un-Update Status.
     *
     */
    public function uncomplete($id){
        //dd($todoId);
        $kurskodexsim=KursKode::find($id);
        $kurskodexsim->update(['status'=>0]);
        
        //splash
        session() -> flash('success','Status Berhasil di non-aktifkan');
        //redirecting
        return redirect(route('kurskodexsim.index'));
    }
}
