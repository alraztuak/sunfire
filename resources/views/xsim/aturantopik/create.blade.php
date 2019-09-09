
@extends('layouts.app')

@push('headerscripts')

@endpush

@section('content')
    <div class="card">
        <div class="card-header">
        <div class="row">
            <div class="col-md-10">
                    <strong>{{ isset($aturantopik) ? 'Edit Topik Peraturan' : 'Input Topik Peraturan' }}</strong>
            </div>
            <div class="col-md-2 ">  @include('xsim.aturantopik.menu')</div>
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
        <form action="{{ isset($aturantopik) ? route('aturantopikxsim.update', $aturantopik->id ) : route('aturantopikxsim.store') }}" method="POST">
            @csrf
            @if(isset($aturantopik))
                @method('PUT')
            @endif
            <div class="form-group">
                <label for="id">ID Topik Peraturan</label>
                <input type="text" class="form-control" id="id" name="id" value="{{ isset($aturantopik) ? $aturantopik->id : '' }}">
            </div>
            <div class="form-group">
                <label for="judul">Nama Topik Peraturan</label>
                <input type="text" class="form-control" id="judul" name="judul" value="{{ isset($aturantopik) ? $aturantopik->judul : '' }}">
            </div>
                <div class="form-group">
                    @if(isset($aturantopik))
                    <a href="{{ route('aturantopikxsim.force', $aturantopik->id ) }}" class="btn btn-primary float-right">Delete</a>
                    @endif
                    <button type="submit" class="btn btn-info float-right">{{ isset($aturantopik) ? 'Update' : 'Submit' }}</button>
                </div>
            </form>

        </div> <!-- /.portlet-body -->

    </div> <!-- /.portlet -->
@endsection

@push('footerscripts')
       
@endpush