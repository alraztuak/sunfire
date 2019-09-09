<?php

namespace App\Http\Controllers\Xsim;

use Auth;
use App\Putusan;
use App\PutusanCat;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Http\Requests\Xsim\Putusan\CreateRequest;
use App\Http\Requests\Xsim\Putusan\UpdateRequest;
use Yajra\Datatables\Datatables;

class PutusanXsim extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('xsim.putusan.index');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //dd(PutusanCat::all());
        //redirecting
        return view('xsim.putusan.create')
            ->with('putusancat', PutusanCat::select('id', 'judul','status')->get());
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
        $putusan = Putusan::create([
            'judul'=>$request->judul,
            'putusan_cat_id'=>$request->category,
            'putusan_jenis_id'=>$request->putusan_jenis_id,
            'tahun'=>$request->tahun,
            'info'=>$request->info,
            'isi'=>$request->isi,
            'views'=>'0',
            'status'=>'0',
            'published_at'=>$request->published_at,
            'create_by'=> Auth::user()->name,
            'update_by'=> ''
        ]);

        //splash message
        session() -> flash('success','Data berhasil disimpan');
        //redirecting
        return redirect(route('putusanxsim.index'));
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
        $putusan=Putusan::find($id);
        return view('xsim.putusan.create')
            ->with('putusan', $putusan)
            ->with('putusancat', PutusanCat::select('id', 'judul','status')->get());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, Putusan $putusanxsim)
    {
        $data = $request->only(['putusan_cat_id','putusan_jenis_id','judul','tahun','info','isi','published_at']);
        //dd($request->category);

        $data['putusan_cat_id']=$request->category;
        $data['update_by']=Auth::user()->name;

        $putusanxsim->update($data);
          
        //splash message
        session() -> flash('success','Data berhasil disimpan');
        //redirecting
        return redirect(route('putusanxsim.index'));
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
        $putusan=Putusan::find($id);
        if($putusan->status=='0'){
                //SoftDelete
                $putusan->delete();
                //splash message
                session() -> flash('success','Data berhasil dialihkan ke Trash');
        }else{
                //splash message
                session() -> flash('warning','Status Data masih aktif');
        }

        //redirecting
        return redirect(route('putusanxsim.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Putusan $Putusanxsim)
    {
        if($id=='0'){
            //Restore Proses
            $putusan = Putusan::onlyTrashed()->get();
            //dd($Putusan);
            foreach ($putusan as $putusans)
                {
                    $putusans->forceDelete();
                }
            //splash message
            session() -> flash('success','Semua Data berhasil dihapus permanen');
        }else{
            //Restore Proses
            $putusan = Putusan::onlyTrashed()->where('id',$id)->first();
            //dd($Putusan->splash);
            $putusan->forceDelete();
            //splash message
            session() -> flash('success','Data berhasil dihapus permanen');
        }
        
        //redirecting
        return redirect(route('putusanxsim.trashed'));
    }

    /**
     * Display a listing of the Trashed.
     *
     * @return \Illuminate\Http\Response
     */
    public function trashed()
    {
        //dd();
        return view('xsim.putusan.trash');
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
            $Putusan = Putusan::onlyTrashed();
            $Putusan->restore();
            //splash message
            session() -> flash('success','Semua Data berhasil dialihkan ke Production');
        }else{
            //Restore Proses
            $Putusan = Putusan::onlyTrashed()->where('id',$id);
            $Putusan->restore();
            //splash message
            session() -> flash('success','Data berhasil dialihkan ke Production');
        }
        
        //redirecting
        return redirect(route('putusanxsim.trashed'));
    }
    /**
     * Display a listing of the resource in Json.
     *
     */
    public function dataPutusan()
    {
        return Datatables::of(Putusan::select('id', 'judul','putusan_cat_id','putusan_jenis_id','published_at','status'))
        ->addColumn('category', function ($putusan)
        { //change over here 
            $putusancatxsim=PutusanCat::find($putusan->putusan_cat_id);
            $category = $putusancatxsim->judul;
            return $category;
        })
        ->addColumn('putusan_jenis', function ($putusan) 
        { //change over here 
            if($putusan->putusan_jenis_id=='1'){
                $putusan_jenis='Pengadilan Pajak';
            }else{
                $putusan_jenis='Mahkamah Agung';
            }

            return $putusan_jenis;
        })
        ->editColumn('published_at', function ($putusan) 
        { //change over here 
            return date('d M Y', strtotime($putusan->published_at) );
        })
        ->make(true);
    }
    /**
     * Display Trashed List in Json.
     *
     */
    public function trashedPutusan()
    {
        //dd(Putusan::query());
        return Datatables::of(Putusan::onlyTrashed()->select('id', 'judul','putusan_cat_id','putusan_jenis_id','published_at','status'))
        ->addColumn('category', function ($putusan)
        { //change over here 
            $putusancatxsim=PutusanCat::find($putusan->putusan_cat_id);
            $category = $putusancatxsim->judul;
            return $category;
        })
        ->addColumn('putusan_jenis', function ($putusan) 
        { //change over here 
            if($putusan->putusan_jenis_id=='1'){
                $putusan_jenis='Pengadilan Pajak';
            }else{
                $putusan_jenis='Mahkamah Agung';
            }

            return $putusan_jenis;
        })
        ->editColumn('published_at', function ($putusan) 
        { //change over here 
            return date('d M Y', strtotime($putusan->published_at) );
        })
        ->make(true);
    }

    /**
     * Update Status.
     *
     */
    public function complete($id){
        //dd($todoId);
        $putusanxsim=Putusan::find($id);

        $putusanxsim->update(['status'=>1]);

        //splash
        session() -> flash('success','Status Berhasil di aktifkan');
        //redirecting
        return redirect(route('putusanxsim.index'));
    }

    /**
     * Un-Update Status.
     *
     */
    public function uncomplete($id){
        //dd($todoId);
        $putusanxsim=Putusan::find($id);

        $putusanxsim->update(['status'=>0]);
        
        //splash
        session() -> flash('success','Status Berhasil di non-aktifkan');
        //redirecting
        return redirect(route('putusanxsim.index'));
    }
}
