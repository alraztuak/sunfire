<?php

namespace App\Http\Controllers\Xsim;

use Auth;
use App\Content;
use App\ContentCat;
use App\Tag;
use App\Highlight;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Http\Requests\Xsim\Content\CreateRequest;
use App\Http\Requests\Xsim\Content\UpdateRequest;
use Yajra\Datatables\Datatables;

class ContentXsim extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('xsim.content.index');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //dd(ContentCat::all());
        //redirecting
        return view('xsim.content.create')
            ->with('contentcat', ContentCat::select('id', 'judul','status')->get())
            ->with('tag', Tag::select('id', 'judul','status')->get());
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
            $image = $request->splash->store('content');
        }else{
            $image = '';
        }

        //Create Post
        $content = Content::create([
            'judul'=>$request->judul,
            'content_cat_id'=>$request->category,
            'sumber'=>$request->sumber,
            'url'=>$request->url,
            'info'=>$request->info,
            'isi'=>$request->isi,
            'views'=>'0',
            'status'=>'0',
            'splash'=>$image,
            'create_by'=> Auth::user()->name,
            'update_by'=> ''
        ]);

        if($request->tag){
            $content->tags()->attach($request->tag);
        }
          
        //splash message
        session() -> flash('success','Data berhasil disimpan');
        //redirecting
        return redirect(route('contentxsim.index'));
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
        $content=Content::find($id);
        return view('xsim.content.create')
            ->with('content', $content)
            ->with('contentcat', ContentCat::select('id', 'judul','status')->get())
            ->with('tag', Tag::select('id', 'judul','status')->get());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, Content $contentxsim)
    {
        $data = $request->only(['content_cat_id','judul','sumber','info','url','isi','splash']);
        //dd($request->category);
        // cek new image
        if($request->hasFile('splash')){
            //upload image
            $image = $request->splash->store('content');

            // delete old image
            Storage::delete($contentxsim->splash);
            $data['splash']=$image;

        }

        if($request->tag){
            $contentxsim->tags()->sync($request->tag);
        }

        $data['content_cat_id']=$request->category;
        $data['update_by']=Auth::user()->name;

        $contentxsim->update($data);
          
        //splash message
        session() -> flash('success','Data berhasil disimpan');
        //redirecting
        return redirect(route('contentxsim.index'));
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
        $content=Content::find($id);
        if($content->status=='0'){
                //SoftDelete
                $content->delete();
                //splash message
                session() -> flash('success','Data berhasil dialihkan ke Trash');
        }else{
                //splash message
                session() -> flash('warning','Status Data masih aktif');
        }

        //redirecting
        return redirect(route('contentxsim.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Content $contentxsim)
    {
        if($id=='0'){
            //Restore Proses
            $content = Content::onlyTrashed()->get();
            //dd($content);
            foreach ($content as $contents)
                {
                    // delete old image
                    Storage::delete($contents->splash);
                    $contents->forceDelete();
                    $contents->tags()->sync([]);
                }
            //splash message
            session() -> flash('success','Semua Data berhasil dihapus permanen');
        }else{
            //Restore Proses
            $content = Content::onlyTrashed()->where('id',$id)->first();
            // delete old image
            Storage::delete($content->splash);
            //dd($content->splash);
            $content->forceDelete();
            $content->tags()->sync([]);
            //splash message
            session() -> flash('success','Data berhasil dihapus permanen');
        }
        
        //redirecting
        return redirect(route('contentxsim.trashed'));
    }

    /**
     * Display a listing of the Trashed.
     *
     * @return \Illuminate\Http\Response
     */
    public function trashed()
    {
        //dd();
        return view('xsim.content.trash');
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
            $content = Content::onlyTrashed();
            $content->restore();
            //splash message
            session() -> flash('success','Semua Data berhasil dialihkan ke Production');
        }else{
            //Restore Proses
            $content = Content::onlyTrashed()->where('id',$id);
            $content->restore();
            //splash message
            session() -> flash('success','Data berhasil dialihkan ke Production');
        }
        
        //redirecting
        return redirect(route('contentxsim.trashed'));
    }
    /**
     * Display a listing of the resource in Json.
     *
     */
    public function dataContent()
    {
        return Datatables::of(Content::select('id', 'judul','content_cat_id','sumber','created_at','status'))
        ->addColumn('category', function ($content)
        { //change over here 
            $contentcatxsim=ContentCat::find($content->content_cat_id);
            $category = $contentcatxsim->judul;
            return $category;
        })
        ->editColumn('created_at', function ($content) 
        { //change over here 
            return date('d M Y', strtotime($content->created_at) );
        }
        )->make(true);
    }
    /**
     * Display Trashed List in Json.
     *
     */
    public function trashedContent()
    {
        //dd(Content::query());
        return Datatables::of(Content::onlyTrashed()->select('id', 'judul','content_cat_id','sumber','created_at','status'))
        ->addColumn('category', function ($content)
        { //change over here 
            $contentcatxsim->contentcats->find($content->content_cat_id);
            $category = $contentcatxsim->judul;
            return $category;
        })
        ->editColumn('created_at', function ($content) 
        { //change over here 
            return date('d M Y', strtotime($content->created_at) );
        }
        )->make(true);
    }

    /**
     * Update Status.
     *
     */
    public function complete($id){
        //dd($todoId);
        $contentxsim=Content::find($id);

        $contentxsim->update(['status'=>1]);

        //count jumlah content yang sudah masuk highlight
        $highlightxsim=Highlight::where('idref', '=', $contentxsim->id)->count();
        //dd($highlightxsim);
        
            if($highlightxsim=='1'){
                //dd($todoId);
                $highlight=Highlight::where('idref', '=', $contentxsim->id)->first();
                $highlight->update(['status'=>1]);
            }

        //splash
        session() -> flash('success','Status Berhasil di aktifkan');
        //redirecting
        return redirect(route('contentxsim.index'));
    }

    /**
     * Un-Update Status.
     *
     */
    public function uncomplete($id){
        //dd($todoId);
        $contentxsim=Content::find($id);

        $contentxsim->update(['status'=>0]);

        //count jumlah content yang sudah masuk highlight
        $highlightxsim=Highlight::where('idref', '=', $contentxsim->id)->count();
        //dd($highlightxsim);
        
            if($highlightxsim=='1'){
                //dd($todoId);
                $highlight=Highlight::where('idref', '=', $contentxsim->id)->first();
                $highlight->update(['status'=>0]);
            }
        
        //splash
        session() -> flash('success','Status Berhasil di non-aktifkan');
        //redirecting
        return redirect(route('contentxsim.index'));
    }

    /**
     * Highlight
     *
     */
    public function highlight($id){
        //dd($todoId);
        $contentxsim=Content::find($id);
        //Create Post

        if($contentxsim->status=='0'){
            
            //splash
            session() -> flash('warning','Content status belum aktif');
        }else{

            $contentcatxsim=ContentCat::find($contentxsim->content_cat_id);
            //count jumlah content yang sudah masuk highlight
            $highlightxsim=Highlight::where('idref', '=', $contentxsim->id)->count();
            //dd($highlightxsim);
            
                if($highlightxsim=='1'){
            
                    //splash
                    session() -> flash('warning','Content sudah di Highlight');
                }else{

                    $highlight = Highlight::create([
                        'idref'=>$contentxsim->id,
                        'modul'=>$contentcatxsim->judul,
                        'judul'=>$contentxsim->judul,
                        'isi'=>Str::words($contentxsim->isi, 25,'...'),
                        'views'=>'0',
                        'status'=>'1',
                        'splash'=>$contentxsim->splash,
                        'create_by'=> Auth::user()->name,
                        'update_by'=> ''
                    ]);
            
                    //splash
                    session() -> flash('success','Content berhasil dijadikan sebagai Highlight');
                
                }
        }

        //redirecting
        return redirect(route('contentxsim.index'));
    }
}
