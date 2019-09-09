
@extends('layouts.app')

@push('headerscripts')

@endpush

@section('content')
    <div class="card">
        <div class="card-header">
        <div class="row">
            <div class="col-md-10">
                    <strong>{{ isset($tag) ? 'Edit Content Tag' : 'Input Content Tag' }}</strong>
            </div>
            <div class="col-md-2 ">  @include('xsim.tag.menu')</div>
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
        <form action="{{ isset($tag) ? route('tagxsim.update', $tag->id ) : route('tagxsim.store') }}" method="POST">
            @csrf
            @if(isset($tag))
                @method('PUT')
            @endif
            <div class="form-group">
                <label for="judul">Tags</label>
                <input type="text" class="form-control" id="judul" name="judul" value="{{ isset($tag) ? $tag->judul : '' }}">
            </div>
                <div class="form-group">
                    @if(isset($tag))
                    <a href="{{ route('tagxsim.force', $tag->id ) }}" class="btn btn-primary float-right" style="margin-left:10px">Delete</a>
                    @endif
                    <button type="submit" class="btn btn-info float-right">{{ isset($tag) ? 'Update' : 'Submit' }}</button>
                </div>
            </form>

        </div> <!-- /.portlet-body -->

    </div> <!-- /.portlet -->
@endsection

@push('footerscripts')
       
@endpush