
@extends('layouts.app')

@push('headerscripts')

@endpush

@section('content')
    <div class="card">
        <div class="card-header">
        <div class="row">
            <div class="col-md-10">
                    <strong>{{ isset($aturaninfo) ? 'Edit Info Peraturan' : 'Input Info Peraturan' }}</strong>
            </div>
            <div class="col-md-2 ">  @include('xsim.aturaninfo.menu')</div>
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
        <form action="{{ isset($aturaninfo) ? route('aturaninfoxsim.update', $aturaninfo->id ) : route('aturaninfoxsim.store') }}" method="POST">
            @csrf
            @if(isset($aturaninfo))
                @method('PUT')
            @endif
            <div class="form-group">
                <label for="id">ID Info Peraturan</label>
                <input type="text" class="form-control" id="id" name="id" value="{{ isset($aturaninfo) ? $aturaninfo->id : '' }}">
            </div>
            <div class="form-group">
                <label for="judul">Nama Info Peraturan</label>
                <input type="text" class="form-control" id="judul" name="judul" value="{{ isset($aturaninfo) ? $aturaninfo->judul : '' }}">
            </div>
                <div class="form-group">
                    @if(isset($aturaninfo))
                    <a href="{{ route('aturaninfoxsim.force', $aturaninfo->id ) }}" class="btn btn-primary float-right">Delete</a>
                    @endif
                    <button type="submit" class="btn btn-info float-right">{{ isset($aturaninfo) ? 'Update' : 'Submit' }}</button>
                </div>
            </form>

        </div> <!-- /.portlet-body -->

    </div> <!-- /.portlet -->
@endsection

@push('footerscripts')
       
@endpush