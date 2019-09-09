
@extends('layouts.app')

@push('headerscripts')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/css/select2.min.css" rel="stylesheet" />
@endpush

@section('content')
    <div class="card">
        <div class="card-header">
        <div class="row">
            <div class="col-md-10">
                    <strong>{{ isset($treaty) ? 'Edit Treaty' : 'Input Treaty' }}</strong>
            </div>
            <div class="col-md-2 ">  @include('xsim.treaty.menu')</div>
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
        <form action="{{ isset($treaty) ? route('treatyxsim.update', $treaty->id ) : route('treatyxsim.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @if(isset($treaty))
                @method('PUT')
            @endif
                <div class="form-group">
                    <label for="treaty_info_id">treaty Categories</label>
                    <select name="treaty_info_id" id="treaty_info_id" class="form-control" >
                        @foreach($treatyinfo as $treatyinfos)
                            @if($treatyinfos->status=='1')
                            <option value="{{ $treatyinfos->id }}"

                                @if(isset($treaty) && $treatyinfos->id == $treaty->treaty_info_id)
                                    selected
                                @endif

                            >[{{ $treatyinfos->kode }}] {{ $treatyinfos->indonesia }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="treaty_jenis_id">Jenis Status Treaty</label>
                    <select name="treaty_jenis_id" id="treaty_jenis_id" class="form-control" >
                        @foreach($treatyjenis as $treatyjeniss)
                            @if($treatyjeniss->status=='1')
                            <option value="{{ $treatyjeniss->id }}"

                                @if(isset($treaty) && $treatyjeniss->id == $treaty->treaty_jenis_id)
                                    selected
                                @endif

                            >{{ $treatyjeniss->judul }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            <div class="form-group">
                <label for="judul">Judul</label>
                <input type="text" class="form-control" id="judul" name="judul" value="{{ isset($treaty) ? $treaty->judul : '' }}">
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-md-6">
                        <label for="judul">Tanggal Terbit</label>
                        <input type="text" class="form-control" id="published_at" name="published_at" value="{{ isset($treaty) ? $treaty->published_at : date('Y-m-d H:i:s') }}"/>
                    </div>
                    <div class="col-md-6">
                        <label for="judul">Tanggal Signed</label>
                        <input type="text" class="form-control" id="signed_at" name="signed_at" value="{{ isset($treaty) ? $treaty->signed_at : date('Y-m-d H:i:s') }}"/>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="isi_id">Isi Indonesia</label> 
                <textarea name="isi_id" id="isi_id" class="form-control my-editor" rows="15">{{ isset($treaty) ? $treaty->isi_id : '' }}</textarea>
            </div>
            <div class="form-group">
                <label for="isi_en">Isi English</label>
                <textarea name="isi_en" id="isi_en" class="form-control my-editor" rows="15">{{ isset($treaty) ? $treaty->isi_en : '' }}</textarea>
            </div>
                <div class="form-group">
                    @if(isset($treaty))
                    <a href="{{ route('treatyxsim.delete', $treaty->id ) }}" class="btn btn-primary float-right" style="margin-left:10px">Delete</a>
                    @endif
                    <button type="submit" class="btn btn-info float-right">{{ isset($treaty) ? 'Update' : 'Submit' }}</button>
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