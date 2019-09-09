<?php

namespace App\Http\Controllers\Xsim;

use Auth;
use App\TreatyInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Http\Requests\Xsim\TreatyInfo\CreateRequest;
use App\Http\Requests\Xsim\TreatyInfo\UpdateRequest;
use Yajra\Datatables\Datatables;

class TreatyInfoXsim extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('xsim.treatyinfo.index');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //dd(TreatyInfoCat::all());
        //redirecting
        return view('xsim.treatyinfo.create');
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
        //upload image
        if($request->splash!=''){
            $image = $request->splash->store('treaty');
        }else{
            $image = '';
        }

        //Create Post
        $treatyinfo= TreatyInfo::create([
            'kode'=>$request->kode,
            'indonesia'=>$request->indonesia,
            'english'=>$request->english,
            'status'=>'0',
            'splash'=>$image,
            'create_by'=> Auth::user()->name,
            'update_by'=> ''
        ]);

        //splash message
        session() -> flash('success','Data berhasil disimpan');
        //redirecting
        return redirect(route('treatyinfoxsim.index'));
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
        $treatyinfo=TreatyInfo::find($id);
        return view('xsim.treatyinfo.create')
            ->with('treatyinfo', $treatyinfo);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, TreatyInfo $treatyinfoxsim)
    {
        $data = $request->only(['kode','indonesia','english','splash']);
        //dd($request->category);
        // cek new image
        if($request->hasFile('splash')){
            //upload image
            $image = $request->splash->store('treaty');

            // delete old image
            Storage::delete($treatyinfoxsim->splash);
            $data['splash']=$image;

        }

        $data['update_by']=Auth::user()->name;

        $treatyinfoxsim->update($data);
          
        //splash message
        session() -> flash('success','Data berhasil disimpan');
        //redirecting
        return redirect(route('treatyinfoxsim.index'));
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
        $treatyinfo=TreatyInfo::find($id);
        if($treatyinfo->status=='0'){
                //SoftDelete
                $treatyinfo->delete();
                //splash message
                session() -> flash('success','Data berhasil dialihkan ke Trash');
        }else{
                //splash message
                session() -> flash('warning','Status Data masih aktif');
        }

        //redirecting
        return redirect(route('treatyinfoxsim.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, TreatyInfo $treatyinfoxsim)
    {
        if($id=='0'){
            //Restore Proses
            $treatyinfo= TreatyInfo::onlyTrashed()->get();
            //dd($treatyinfo);
            foreach ($treatyinfo as $treatyinfos)
                {
                    // delete old image
                    Storage::delete($treatyinfos->splash);
                    $treatyinfos->forceDelete();
                }
            //splash message
            session() -> flash('success','Semua Data berhasil dihapus permanen');
        }else{
            //Restore Proses
            $treatyinfo= TreatyInfo::onlyTrashed()->where('id',$id)->first();
            // delete old image
            Storage::delete($treatyinfo->splash);
            //dd($treatyinfo->splash);
            $treatyinfo->forceDelete();
            //splash message
            session() -> flash('success','Data berhasil dihapus permanen');
        }
        
        //redirecting
        return redirect(route('treatyinfoxsim.trashed'));
    }

    /**
     * Display a listing of the Trashed.
     *
     * @return \Illuminate\Http\Response
     */
    public function trashed()
    {
        //dd();
        return view('xsim.treatyinfo.trash');
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
            $treatyinfo= TreatyInfo::onlyTrashed();
            $treatyinfo->restore();
            //splash message
            session() -> flash('success','Semua Data berhasil dialihkan ke Production');
        }else{
            //Restore Proses
            $treatyinfo= TreatyInfo::onlyTrashed()->where('id',$id);
            $treatyinfo->restore();
            //splash message
            session() -> flash('success','Data berhasil dialihkan ke Production');
        }
        
        //redirecting
        return redirect(route('treatyinfoxsim.trashed'));
    }
    /**
     * Display a listing of the resource in Json.
     *
     */
    public function dataTreatyInfo()
    {
        return Datatables::of(TreatyInfo::select('id', 'kode','indonesia','english','created_at','status'))
        ->addColumn('treaties', function ($treatyinfo) 
        { //change over here 
            return $treatyinfo->treaties->count();
        })
        ->editColumn('created_at', function ($treatyinfo) 
        { //change over here 
            return date('d M Y', strtotime($treatyinfo->created_at) );
        }
        )->make(true);
    }
    /**
     * Display Trashed List in Json.
     *
     */
    public function trashedTreatyInfo()
    {
        //dd(TreatyInfo::query());
        return Datatables::of(TreatyInfo::onlyTrashed()->select('id', 'kode','indonesia','english','created_at','status'))
        ->addColumn('treaties', function ($treatyinfo) 
        { //change over here 
            return $treatyinfo->treaties->count();
        })
        ->editColumn('created_at', function ($treatyinfo) 
        { //change over here 
            return date('d M Y', strtotime($treatyinfo->created_at) );
        }
        )->make(true);
    }

    /**
     * Update Status.
     *
     */
    public function complete($id){
        //dd($todoId);
        $treatyinfoxsim=TreatyInfo::find($id);

        $treatyinfoxsim->update(['status'=>1]);

        //splash
        session() -> flash('success','Status Berhasil di aktifkan');
        //redirecting
        return redirect(route('treatyinfoxsim.index'));
    }

    /**
     * Un-Update Status.
     *
     */
    public function uncomplete($id){
        //dd($todoId);
        $treatyinfoxsim=TreatyInfo::find($id);

        $treatyinfoxsim->update(['status'=>0]);
        
        //splash
        session() -> flash('success','Status Berhasil di non-aktifkan');
        //redirecting
        return redirect(route('treatyinfoxsim.index'));
    }

}
