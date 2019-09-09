
@extends('layouts.app')

@push('headerscripts')

@endpush

@section('content')
    <div class="card">
        <div class="card-header">
        <div class="row">
            <div class="col-md-10">
                    <strong>{{ isset($treatyjenis) ? 'Edit Treaty Categories' : 'Input Treaty Categories' }}</strong>
            </div>
            <div class="col-md-2 ">  @include('xsim.treatyjenis.menu')</div>
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
        <form action="{{ isset($treatyjenis) ? route('treatyjenisxsim.update', $treatyjenis->id ) : route('treatyjenisxsim.store') }}" method="POST">
            @csrf
            @if(isset($treatyjenis))
                @method('PUT')
            @endif
            <div class="form-group">
                <label for="judul">Nama Kategori</label>
                <input type="text" class="form-control" id="judul" name="judul" value="{{ isset($treatyjenis) ? $treatyjenis->judul : '' }}">
            </div>
                <div class="form-group">
                    @if(isset($treatyjenis))
                    <a href="{{ route('treatyjenisxsim.force', $treatyjenis->id ) }}" class="btn btn-primary float-right">Delete</a>
                    @endif
                    <button type="submit" class="btn btn-info float-right">{{ isset($treatyjenis) ? 'Update' : 'Submit' }}</button>
                </div>
            </form>

        </div> <!-- /.portlet-body -->

    </div> <!-- /.portlet -->
@endsection

@push('footerscripts')
       
@endpush