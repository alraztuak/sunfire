
@extends('layouts.app')

@push('headerscripts')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/css/select2.min.css" rel="stylesheet" />
@endpush

@section('content')
    <div class="card">
        <div class="card-header">
        <div class="row">
            <div class="col-md-10">
                    <strong>{{ isset($putusan) ? 'Edit Putusan' : 'Input Putusan' }}</strong>
            </div>
            <div class="col-md-2 ">  @include('xsim.putusan.menu')</div>
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
        <form action="{{ isset($putusan) ? route('putusanxsim.update', $putusan->id ) : route('putusanxsim.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @if(isset($putusan))
                @method('PUT')
            @endif
            <div class="form-group">
                <label for="category">Jenis Putusan</label>
                <br />
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio"  name="putusan_jenis_id" id="putusan_jenis_id1" autocomplete="off" value="1"
                        @if(isset($putusan) && $putusan->putusan_jenis_id=='1')
                                checked
                         @endif >
                    <label class="form-check-label" for="putusan_jenis_id1">Pengadilan Pajak</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio"  name="putusan_jenis_id" id="putusan_jenis_id2" autocomplete="off" value="2"
                        @if(isset($putusan) && $putusan->putusan_jenis_id=='2')
                                checked
                         @endif >
                    <label class="form-check-label" for="putusan_jenis_id2">Mahkamah Agung</label>
                </div>
            </div>
                <div class="form-group">
                    <label for="category">Putusan Categories</label>
                    <select name="category" id="category" class="form-control" >
                        @foreach($putusancat as $putusancats)
                            @if($putusancats->status=='1')
                            <option value="{{ $putusancats->id }}"

                                @if(isset($putusan) && $putusancats->id == $putusan->putusan_cat_id)
                                    selected
                                @endif

                            >{{ $putusancats->judul }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            <div class="form-group">
                <label for="judul">Judul</label>
                <input type="text" class="form-control" id="judul" name="judul" value="{{ isset($putusan) ? $putusan->judul : '' }}">
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-md-6">
                        <label for="tahun">Tahun</label>
                        <input type="text" class="form-control" id="tahun" name="tahun"  value="{{ isset($putusan) ? $putusan->tahun : '' }}">
                    </div>
                    <div class="col-md-6">
                        <label for="judul">Tanggal Terbit</label>
                        <input type="text" class="form-control" id="published_at" name="published_at" value="{{ isset($putusan) ? $putusan->published_at : date('Y-m-d H:i:s') }}"/>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="info">Pokok Sengketa</label> 
                <textarea name="info" id="info" class="form-control" rows="5">{{ isset($putusan) ? $putusan->info : '' }}</textarea>
            </div>
            <div class="form-group">
                <label for="isi">Putusan</label>
                <textarea name="isi" id="isi" class="form-control my-editor" rows="15">{{ isset($putusan) ? $putusan->isi : '' }}</textarea>
            </div>
                <div class="form-group">
                    @if(isset($putusan))
                    <a href="{{ route('putusanxsim.delete', $putusan->id ) }}" class="btn btn-primary float-right" style="margin-left:10px">Delete</a>
                    @endif
                    <button type="submit" class="btn btn-info float-right">{{ isset($putusan) ? 'Update' : 'Submit' }}</button>
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
            $('.tags-selector').select2();
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
            var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
            var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;

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