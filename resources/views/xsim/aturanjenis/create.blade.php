
@extends('layouts.app')

@push('headerscripts')

@endpush

@section('content')
    <div class="card">
        <div class="card-header">
        <div class="row">
            <div class="col-md-10">
                    <strong>{{ isset($aturanjenis) ? 'Edit Jenis Peraturan' : 'Input Jenis Peraturan' }}</strong>
            </div>
            <div class="col-md-2 ">  @include('xsim.aturanjenis.menu')</div>
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
        <form action="{{ isset($aturanjenis) ? route('aturanjenisxsim.update', $aturanjenis->id ) : route('aturanjenisxsim.store') }}" method="POST">
            @csrf
            @if(isset($aturanjenis))
                @method('PUT')
            @endif
            <div class="form-group">
                <label for="id">ID Jenis Peraturan</label>
                <input type="text" class="form-control" id="id" name="id" value="{{ isset($aturanjenis) ? $aturanjenis->id : '' }}">
            </div>
            <div class="form-group">
                <label for="judul">Nama Jenis Peraturan</label>
                <input type="text" class="form-control" id="judul" name="judul" value="{{ isset($aturanjenis) ? $aturanjenis->judul : '' }}">
            </div>
                <div class="form-group">
                    @if(isset($aturanjenis))
                    <a href="{{ route('aturanjenisxsim.force', $aturanjenis->id ) }}" class="btn btn-primary float-right">Delete</a>
                    @endif
                    <button type="submit" class="btn btn-info float-right">{{ isset($aturanjenis) ? 'Update' : 'Submit' }}</button>
                </div>
            </form>

        </div> <!-- /.portlet-body -->

    </div> <!-- /.portlet -->
@endsection

@push('footerscripts')
       
@endpush