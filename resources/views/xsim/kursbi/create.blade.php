
@extends('layouts.app')

@push('headerscripts')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/css/select2.min.css" rel="stylesheet" />
@endpush

@section('content')
    <div class="card">
        <div class="card-header">
        <div class="row">
            <div class="col-md-10">
                    <strong>{{ isset($kursbi) ? 'Edit Kurs Bank Indonesia' : 'Input Kurs Bank Indonesia' }}</strong>
            </div>
            <div class="col-md-2 ">  @include('xsim.kursbi.menu')</div>
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
        <form action="{{ isset($kursbi) ? route('kursbixsim.update', $kursbi->id ) : route('kursbixsim.store') }}" method="POST">
            @csrf
            @if(isset($kursbi))
                @method('PUT')
            @endif
            <div class="form-group">
                <div class="row">
                    <div class="col-md-6">
                        <label for="start_at">Tanggal Awal</label>
                        <input type="text" class="form-control" id="start_at" name="start_at"  value="{{ isset($kursbi) ? $kursbi->start_at : date('Y-m-d H:i:s') }}">
                    </div>
                    <div class="col-md-6">
                        <label for="end_at">Tanggal Akhir</label>
                        <input type="text" class="form-control" id="end_at" name="end_at" value="{{ isset($kursbi) ? $kursbi->end_at : date('Y-m-d H:i:s', strtotime('+ 7 day')) }}"/>
                    </div>
                </div>
            </div>
            <div class="form-group">
                    <div class="row">
                        <div class="col-md-4">     
                            <label for="kurskode">Panduan Mata Uang</label> 
                            <table class="table table-striped">
                                <tbody>
                                    @foreach($kurskode as $kurskodes)
                                    <tr>
                                        <td style="padding:5px;width:23%;text-align:center">[ {!! $kurskodes->kode !!} ]</td>
                                        <td style="padding:5px">{!! $kurskodes->judul !!}</td>
                                        <td style="padding:5px;width:20%;text-align:center">{!! $kurskodes->satuan !!}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="col-md-8"> 
                            <div class="row">
                                @if(isset($kursbi))
                                    <div class="col-md-4">     
                                        <label for="{{ $kurskodes->kode }}_add">Mata Uang</label> 
                                        @foreach($kurskode as $kurskodes)
                                        <input type="text" class="form-control" style="margin-bottom:3px" disabled id="{{ $kurskodes->kode }}_add" name="{{ $kurskodes->kode }}_add" value="{{ $kurskodes->kode }}"/>
                                        @endforeach
                                    </div>
                                    <div class="col-md-2">
                                        <label for="{{ $kurskodes->kode }}">Nilai Jual</label> 
                                        @foreach($kurskode as $kurskodes)
                                        <input type="text" class="form-control" style="margin-bottom:3px" id="{!! $kurskodes->kode.'_jual' !!}" name="{!! $kurskodes->kode.'_jual' !!}" value="{{ $kursbi->{$kurskodes->kode.'_jual'} }}"/>
                                        @endforeach
                                    </div>
                                    <div class="col-md-2">
                                        <label for="{{ $kurskodes->kode }}">Nilai Beli</label> 
                                        @foreach($kurskode as $kurskodes)
                                        <input type="text" class="form-control" style="margin-bottom:3px" id="{!! $kurskodes->kode.'_beli' !!}" name="{!! $kurskodes->kode.'_beli' !!}" value="{{ $kursbi->{$kurskodes->kode.'_beli'} }}"/>
                                        @endforeach
                                    </div>
                                    <div class="col-md-2">
                                        <label for="{{ $kurskodes->kode }}">Nilai Jual</label> 
                                        @foreach($kurskode as $kurskodes)
                                        <input type="text" class="form-control" style="margin-bottom:3px" id="{!! $kurskodes->kode.'_k_jual' !!}" name="{!! $kurskodes->kode.'_k_jual' !!}" value="{{ $kursbi->{$kurskodes->kode.'_k_jual'} }}"/>
                                        @endforeach
                                    </div>
                                    <div class="col-md-2">
                                        <label for="{{ $kurskodes->kode }}">Nilai Beli</label> 
                                        @foreach($kurskode as $kurskodes)
                                        <input type="text" class="form-control" style="margin-bottom:3px" id="{!! $kurskodes->kode.'_k_beli' !!}" name="{!! $kurskodes->kode.'_k_beli' !!}" value="{{ $kursbi->{$kurskodes->kode.'_k_beli'} }}"/>
                                        @endforeach
                                    </div>
                                @else
                                    <div class="col-md-4">     
                                        <label for="kurskode">Mata Uang</label> 
                                        <textarea name="kurskode" id="kurskode" class="form-control" rows="25" readonly="readonly">@foreach($kurskode as $kurskodes){!! $kurskodes->kode."\n" !!}@endforeach</textarea>
                                    </div>
                                    <div class="col-md-2">
                                        <label for="kursbi_jual">Nilai Jual</label> 
                                        <textarea name="kursbi_jual" id="kursbi_jual" class="form-control" rows="25"></textarea>
                                    </div>
                                    <div class="col-md-2">
                                        <label for="kursbi_beli">Nilai Beli</label> 
                                        <textarea name="kursbi_beli" id="kursbi_beli" class="form-control" rows="25"></textarea>
                                    </div>
                                    <div class="col-md-2">
                                        <label for="kursbi_k_jual">Kertas Jual</label> 
                                        <textarea name="kursbi_k_jual" id="kursbi_k_jual" class="form-control" rows="25"></textarea>
                                    </div>
                                    <div class="col-md-2">
                                        <label for="kursbi_k_beli">Kertas Beli</label> 
                                        <textarea name="kursbi_k_beli" id="kursbi_k_beli" class="form-control" rows="25"></textarea>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
            </div>
                <div class="form-group">
                    @if(isset($kursbi))
                    <a href="{{ route('kursbixsim.delete', $kursbi->id ) }}" class="btn btn-primary float-right" style="margin-left:10px">Delete</a>
                    @endif
                    <button type="submit" class="btn btn-info float-right">{{ isset($kursbi) ? 'Update' : 'Submit' }}</button>
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