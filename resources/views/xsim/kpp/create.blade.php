
@extends('layouts.app')

@push('headerscripts')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/css/select2.min.css" rel="stylesheet" />
@endpush

@section('content')
    <div class="card">
        <div class="card-header">
        <div class="row">
            <div class="col-md-10">
                    <strong>{{ isset($kpp) ? 'Edit Kpp' : 'Input Kpp' }}</strong>
            </div>
            <div class="col-md-2 ">  @include('xsim.kpp.menu')</div>
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
        <form action="{{ isset($kpp) ? route('kppxsim.update', $kpp->id ) : route('kppxsim.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @if(isset($kpp))
                @method('PUT')
            @endif
                <div class="form-group">
                    <label for="kpp_jenis_id">kpp Categories</label>
                    <select name="kpp_jenis_id" id="kpp_jenis_id" class="form-control" >
                        @foreach($kppjenis as $kppjeniss)
                            @if($kppjeniss->status=='1')
                            <option value="{{ $kppjeniss->id }}"

                                @if(isset($kpp) && $kppjeniss->id == $kpp->kpp_jenis_id)
                                    selected
                                @endif

                            >{{ $kppjeniss->judul }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            <div class="form-group">
                <label for="nama">Nama KPP</label>
                <input type="text" class="form-control" id="nama" name="nama" value="{{ isset($kpp) ? $kpp->nama : '' }}">
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-md-6">
                        <label for="kodekpp">KodeKPP</label>
                        <input type="text" class="form-control" id="kodekpp" name="kodekpp"  value="{{ isset($kpp) ? $kpp->kodekpp : '' }}">
                    </div>
                    <div class="col-md-6">
                        <label for="kodewil">KodeWil</label>
                        <input type="text" class="form-control" id="kodewil" name="kodewil" value="{{ isset($kpp) ? $kpp->kodewil : '' }}"/>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="alamat">Alamat Lengkap</label> 
                <textarea name="alamat" id="alamat" class="form-control" rows="3">{{ isset($kpp) ? $kpp->alamat : '' }}</textarea>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-md-4">
                        <label for="kota">Kota</label>
                        <input type="text" class="form-control" id="kota" name="kota"  value="{{ isset($kpp) ? $kpp->kota : '' }}">
                    </div>
                    <div class="col-md-4">
                        <label for="lurah">Kelurahan</label>
                        <input type="text" class="form-control" id="lurah" name="lurah" value="{{ isset($kpp) ? $kpp->lurah : '' }}"/>
                    </div>
                    <div class="col-md-4">
                        <label for="camat">Kecamatan</label>
                        <input type="text" class="form-control" id="camat" name="camat" value="{{ isset($kpp) ? $kpp->camat : '' }}"/>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-md-6">
                        <label for="telepon">Telepon</label>
                        <input type="text" class="form-control" id="telepon" name="telepon"  value="{{ isset($kpp) ? $kpp->telepon : '' }}">
                    </div>
                    <div class="col-md-6">
                        <label for="fax">Fax</label>
                        <input type="text" class="form-control" id="fax" name="fax" value="{{ isset($kpp) ? $kpp->fax : '' }}"/>
                    </div>
                </div>
            </div>
                <div class="form-group">
                    @if(isset($kpp))
                    <a href="{{ route('kppxsim.delete', $kpp->id ) }}" class="btn btn-primary float-right" style="margin-left:10px">Delete</a>
                    @endif
                    <button type="submit" class="btn btn-info float-right">{{ isset($kpp) ? 'Update' : 'Submit' }}</button>
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