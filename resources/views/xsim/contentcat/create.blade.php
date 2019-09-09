
@extends('layouts.app')

@push('headerscripts')

@endpush

@section('content')
    <div class="card">
        <div class="card-header">
        <div class="row">
            <div class="col-md-10">
                    <strong>{{ isset($contentcat) ? 'Edit Content Categories' : 'Input Content Categories' }}</strong>
            </div>
            <div class="col-md-2 ">  @include('xsim.contentcat.menu')</div>
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
        <form action="{{ isset($contentcat) ? route('contentcatxsim.update', $contentcat->id ) : route('contentcatxsim.store') }}" method="POST">
            @csrf
            @if(isset($contentcat))
                @method('PUT')
            @endif
            <div class="form-group">
                <label for="judul">Nama Kategori</label>
                <input type="text" class="form-control" id="judul" name="judul" value="{{ isset($contentcat) ? $contentcat->judul : '' }}">
            </div>
                <div class="form-group">
                    @if(isset($contentcat))
                    <a href="{{ route('contentcatxsim.force', $contentcat->id ) }}" class="btn btn-primary float-right">Delete</a>
                    @endif
                    <button type="submit" class="btn btn-info float-right">{{ isset($contentcat) ? 'Update' : 'Submit' }}</button>
                </div>
            </form>

        </div> <!-- /.portlet-body -->

    </div> <!-- /.portlet -->
@endsection

@push('footerscripts')
       
@endpush