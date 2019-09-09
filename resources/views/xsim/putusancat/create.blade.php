
@extends('layouts.app')

@push('headerscripts')

@endpush

@section('content')
    <div class="card">
        <div class="card-header">
        <div class="row">
            <div class="col-md-10">
                    <strong>{{ isset($putusancat) ? 'Edit Putusan Categories' : 'Input Putusan Categories' }}</strong>
            </div>
            <div class="col-md-2 ">  @include('xsim.putusancat.menu')</div>
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
        <form action="{{ isset($putusancat) ? route('putusancatxsim.update', $putusancat->id ) : route('putusancatxsim.store') }}" method="POST">
            @csrf
            @if(isset($putusancat))
                @method('PUT')
            @endif
            <div class="form-group">
                <label for="judul">Nama Kategori</label>
                <input type="text" class="form-control" id="judul" name="judul" value="{{ isset($putusancat) ? $putusancat->judul : '' }}">
            </div>
                <div class="form-group">
                    @if(isset($putusancat))
                    <a href="{{ route('putusancatxsim.force', $putusancat->id ) }}" class="btn btn-primary float-right">Delete</a>
                    @endif
                    <button type="submit" class="btn btn-info float-right">{{ isset($putusancat) ? 'Update' : 'Submit' }}</button>
                </div>
            </form>

        </div> <!-- /.portlet-body -->

    </div> <!-- /.portlet -->
@endsection

@push('footerscripts')
       
@endpush