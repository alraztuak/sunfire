
@extends('layouts.app')

@push('headerscripts')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/css/select2.min.css" rel="stylesheet" />
@endpush

@section('content')
    <div class="card">
        <div class="card-header">
        <div class="row">
            <div class="col-md-10">
                    <strong>{{ isset($content) ? 'Edit Content' : 'Input Content' }}</strong>
            </div>
            <div class="col-md-2 ">  @include('xsim.content.menu')</div>
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
        <form action="{{ isset($content) ? route('contentxsim.update', $content->id ) : route('contentxsim.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @if(isset($content))
                @method('PUT')
            @endif
                <div class="form-group">
                    <label for="category">Content Categories</label>
                    <select name="category" id="category" class="form-control" >
                        @foreach($contentcat as $contentcats)
                            @if($contentcats->status=='1')
                            <option value="{{ $contentcats->id }}"

                                @if(isset($content) && $contentcats->id == $content->content_cat_id)
                                    selected
                                @endif

                            >{{ $contentcats->judul }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            <div class="form-group">
                <label for="judul">Judul</label>
                <input type="text" class="form-control" id="judul" name="judul" value="{{ isset($content) ? $content->judul : '' }}">
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-md-6">
                        <label for="sumber">Sumber</label>
                        <input type="text" class="form-control" id="sumber" name="sumber"  value="{{ isset($content) ? $content->sumber : '' }}">
                    </div>
                    <div class="col-md-6">
                        <label for="url">URL</label>
                        <input type="text" class="form-control" id="url" name="url"  value="{{ isset($content) ? $content->url : '' }}">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="info">Info Tambahan</label>
                <input type="text" class="form-control" id="info" name="info" value="{{ isset($content) ? $content->info : '' }}">
            </div>
            <div class="form-group">
                <label for="isi">Content</label>
                <textarea name="isi" id="isi" class="form-control my-editor" rows="15">{{ isset($content) ? $content->isi : '' }}</textarea>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-md-6"> 
                        <div class="form-group files">
                            <label for="splash">splash</label>
                            <input type="file" class="form-control" id="splash" name="splash">
                        </div>
                    </div>
                    <div class="col-md-6">
                            <label for="splash">preview</label><br />
                    @if(isset($content))
                            <img src="{{ asset('storage/'.$content->splash) }}" alt="" class="responsive" style="width:80%; border:solid 2px #d4d4d4; border-bottom:solid 10px #d6d6d6; border-right:solid 10px #d6d6d6">
                    @endif
                    </div>
                </div>
            </div>
                <div class="form-group">
                    <label for="tag">Tags</label>
                    
                    <select name="tag[]" id="tag[]" class="tags-selector form-control" multiple>
                        @foreach($tag as $tags)
                            @if($tags->status=='1')
                            <option value="{{ $tags->id }}"
                                @if(isset($content))
                                    @if($content->hastags($tags->id))
                                        selected
                                    @endif
                                @endif

                            >{{ $tags->judul }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    @if(isset($content))
                    <a href="{{ route('contentxsim.delete', $content->id ) }}" class="btn btn-primary float-right" style="margin-left:10px">Delete</a>
                    @endif
                    <button type="submit" class="btn btn-info float-right">{{ isset($content) ? 'Update' : 'Submit' }}</button>
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