
@extends('layouts.app')

@push('headerscripts')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/css/select2.min.css" rel="stylesheet" />
@endpush

@section('content')
    <div class="card">
        <div class="card-header">
        <div class="row">
            <div class="col-md-10">
                    <strong>{{ isset($trending) ? 'Edit Trending' : 'Input Trending' }}</strong>
            </div>
            <div class="col-md-2 ">  @include('xsim.trending.menu')</div>
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
        <form action="{{ isset($trending) ? route('trendingxsim.update', $trending->id ) : route('trendingxsim.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @if(isset($trending))
                @method('PUT')
            @endif
            <div class="form-group">
                <label for="judul">Judul Trending</label>
                <input type="text" class="form-control" id="judul" name="judul" value="{{ isset($trending) ? $trending->judul : '' }}">
            </div>
                <div class="form-group">
                    <label for="content">Content</label>
                    
                    <select name="content[]" id="content[]" class="contents-selector form-control" multiple>
                        @foreach($content as $contents)
                            @if($contents->status=='1')
                            <option value="{{ $contents->id }}"
                                @if(isset($trending))
                                    @if($trending->hascontents($contents->id))
                                        selected
                                    @endif
                                @endif

                            >{{ $contents->judul }}</option>
                            @endif
                        @endforeach
                    </select>
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
                        @if(isset($trending))
                                <img src="{{ asset('storage/'.$trending->splash) }}" alt="" class="responsive" style="width:80%; border:solid 2px #d4d4d4; border-bottom:solid 10px #d6d6d6; border-right:solid 10px #d6d6d6">
                        @endif
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    @if(isset($trending))
                    <a href="{{ route('trendingxsim.force', $trending->id ) }}" class="btn btn-primary float-right" style="margin-left:10px">Delete</a>
                    @endif
                    <button type="submit" class="btn btn-info float-right">{{ isset($trending) ? 'Update' : 'Submit' }}</button>
                </div>
            </form>

        </div> <!-- /.portlet-body -->

    </div> <!-- /.portlet -->
@endsection

@push('footerscripts')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/js/select2.min.js"></script>

        <script>
        $(document).ready(function() {
            $('.contents-selector').select2();
        });
        </script>
       
@endpush