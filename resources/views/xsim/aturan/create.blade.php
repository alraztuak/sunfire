
@extends('layouts.app')

@push('headerscripts')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/css/select2.min.css" rel="stylesheet" />
@endpush

@section('content')
    <div class="card">
        <div class="card-header">
        <div class="row">
            <div class="col-md-10">
                    <strong>{{ isset($aturan) ? 'Edit aturan' : 'Input aturan' }}</strong>
            </div>
            <div class="col-md-2 ">  @include('xsim.aturan.menu')</div>
        </div>
          
        </div>

        <div class="card-body">
        @if($errors->any())
            <div class="alert alert-danger">
            <ul >
                @foreach($errors->all() as $error)
                  <li >
                    {{ $error }}
                  </li>
                @endforeach
            </ul>
            </div>
        @endif
        <form action="{{ isset($aturan) ? route('aturanxsim.update', $aturan->id ) : route('aturanxsim.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @if(isset($aturan))
                @method('PUT')
            @endif
                <div class="form-group">
                    <label for="aturan_topik">Topik Peraturan</label>
                    
                    <select name="aturan_topik[]" id="aturan_topik[]" class="aturan-topiks-selector form-control" multiple>
                        @foreach($aturan_topik as $aturan_topiks)
                            @if($aturan_topiks->status=='1')
                            <option value="{{ $aturan_topiks->id }}"
                                @if(isset($aturan))
                                    @if($aturan->hasAturanTopiks($aturan_topiks->id))
                                        selected
                                    @endif
                                @endif

                            >{{ $aturan_topiks->judul }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="aturan_jenis">Jenis Peraturan</label>
                    <select name="aturan_jenis" id="aturan_jenis" class="form-control" >
                        @foreach($aturan_jenis as $aturan_jeniss)
                            @if($aturan_jeniss->status=='1')
                            <option value="{{ $aturan_jeniss->id }}"

                                @if(isset($aturan) && $aturan_jeniss->id == $aturan->aturan_jenis_id)
                                    selected
                                @endif

                            >{{ $aturan_jeniss->judul }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>

                
            <div class="form-group">
                    <label for="aturan_info">Info Status Peraturan</label>
                    <select name="aturan_info" id="aturan_info" class="form-control" >
                        @foreach($aturan_info as $aturan_infos)
                            @if($aturan_infos->status=='1')
                            <option value="{{ $aturan_infos->id }}"

                                @if(isset($aturan) && $aturan_infos->id == $aturan->aturan_info_id)
                                    selected
                                @endif

                            >{{ $aturan_infos->judul }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            <div class="form-group">
                <label for="judul">Tanggal Terbit</label>
                <input type="text" class="form-control" id="published_at" name="published_at" value="{{ isset($aturan) ? $aturan->published_at : date('Y-m-d H:i:s') }}"/>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-md-6">
                        <label for="nomor">Nomor</label>
                        <input type="text" class="form-control" id="nomor" name="nomor" value="{{ isset($aturan) ? $aturan->nomor : '' }}">
                    </div>
                    <div class="col-md-6">
                        <label for="nomor_index">Nomor Indexing</label>
                        <input type="text" class="form-control" id="nomor_index" name="nomor_index" value="{{ isset($aturan) ? $aturan->nomor_index : '' }}">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="perihal">Perihal</label>
                <textarea name="perihal" id="perihal" class="form-control" rows="5">{{ isset($aturan) ? $aturan->perihal : '' }}</textarea>
            
            </div>
            <div class="form-group">
                <label for="isi">Peraturan</label>
                <textarea name="isi" id="isi" class="form-control my-editor" rows="15">{{ isset($aturan) ? $aturan->isi : '' }}</textarea>
            </div>
            
            <div class="form-group">
                <div class="row">
                    <div class="col-md-6 form-group files">
                        <label for="lampiran">Lampiran HTML</label>
                        <input type="file" class="form-control" id="lampiran" name="lampiran">
                        <hr />
                        <label for="lampiran">File Lampiran HTML</label>
                        @if(isset($aturan))
                            <br /><span>
                                <a href="{{ asset('storage/'.$aturan->lampiran) }}">
                                    {{ asset('storage/'.$aturan->lampiran) }}
                                </a>
                        @else
                            <br /><span>File Belum ter-upload</span>
                        @endif
                    </div>
                    <div class="col-md-6 form-group files">
                        <label for="pdf">Lampiran PDF</label>
                        <input type="file" class="form-control" id="pdf" name="pdf">
                        <hr />
                        <label for="lampiran">File Lampiran PDF</label>
                        @if(isset($aturan))
                            <br /><span>
                                <a href="{{ asset('storage/'.$aturan->pdf) }}">
                                    {{ asset('storage/'.$aturan->pdf) }}
                                </a>
                        @else
                            <br /><span>File Belum ter-upload</span>
                        @endif
                    </div>
                </div>
            </div>
                
                <div class="form-group">
                    @if(isset($aturan))
                    <a href="{{ route('aturanxsim.delete', $aturan->id ) }}" class="btn btn-primary float-right" style="margin-left:10px">Delete</a>
                    @endif
                    <button type="submit" class="btn btn-info float-right">{{ isset($aturan) ? 'Update' : 'Submit' }}</button>
                </div>
            </form>

        </div> <!-- /.portlet-body -->

    </div> <!-- /.portlet -->
@endsection

@push('footerscripts')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/js/select2.min.js"></script>
        <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>


        <script>
        $(document).ready(function() {
            $('.aturan-topiks-selector').select2();
        });

        var editor_config = {
            path_absolute : "/",
            selector: "textarea.my-editor",
            plugins: [
            "advlist autolink lists link image charmap print preview hr anchor pagebreak",
            "searchreplace wordcount visualblocks visualchars code fullscreen",
            "insertdatetime media nonbreaking save table contextmenu directionality",
            "emoticons template paste textcolor colorpicker textpattern"
            ],
            toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
            relative_urls: false,
            file_browser_callback : function(field_name, url, type, win) {
            var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByaturan_topikName('body')[0].clientWidth;
            var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByaturan_topikName('body')[0].clientHeight;

            var cmsURL = editor_config.path_absolute + 'laravel-filemanager?field_name=' + field_name;
            if (type == 'image') {
                cmsURL = cmsURL + "&type=Images";
            } else {
                cmsURL = cmsURL + "&type=Files";
            }

            tinyMCE.activeEditor.windowManager.open({
                file : cmsURL,
                title : 'Filemanager',
                width : x * 0.8,
                height : y * 0.8,
                resizable : "yes",
                close_previous : "no"
            });
            }
        };

        tinymce.init(editor_config);
        </script>
@endpush