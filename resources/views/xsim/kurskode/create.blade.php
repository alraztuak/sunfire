
@extends('layouts.app')

@push('headerscripts')

@endpush

@section('content')
    <div class="card">
        <div class="card-header">
        <div class="row">
            <div class="col-md-10">
                    <strong>{{ isset($kurskode) ? 'Edit Kurs Kode' : 'Input Kurs Kode' }}</strong>
            </div>
            <div class="col-md-2 ">  @include('xsim.kurskode.menu')</div>
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
        <form action="{{ isset($kurskode) ? route('kurskodexsim.update', $kurskode->id ) : route('kurskodexsim.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @if(isset($kurskode))
                @method('PUT')
            @endif
            <div class="form-group">
            Tambahkan Mata uang ke : &nbsp;&nbsp;&nbsp;
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="kursmk" name="kursmk"
                        @if(isset($kurskode) && $kurskode->kursmk=='1')
                                checked
                        @endif >
                    <label class="form-check-label" for="kursmk">Kurs MK</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="kursbi" name="kursbi"
                        @if(isset($kurskode) && $kurskode->kursbi=='1')
                                checked
                        @endif >
                    <label class="form-check-label" for="kursbi">Kurs BI</label>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-md-4">
                        <label for="kode">Kode</label>
                        <input type="text" class="form-control" id="kode" name="kode"  value="{{ isset($kurskode) ? $kurskode->kode : '' }}">
                    </div>
                    <div class="col-md-4">
                        <label for="judul">Mata Uang</label>
                        <input type="text" class="form-control" id="judul" name="judul"  value="{{ isset($kurskode) ? $kurskode->judul : '' }}">
                    </div>
                    <div class="col-md-4">
                        <label for="satuan">Satuan</label>
                        <input type="text" class="form-control" id="satuan" name="satuan"  value="{{ isset($kurskode) ? $kurskode->satuan : '' }}">
                    </div>
                </div>
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
                    @if(isset($kurskode))
                            <img src="{{ asset('storage/'.$kurskode->splash) }}" alt="" class="responsive" style="width:80%; border:solid 2px #d4d4d4; border-bottom:solid 10px #d6d6d6; border-right:solid 10px #d6d6d6">
                    @endif
                    </div>
                </div>
            </div>
                <div class="form-group">
                    @if(isset($kurskode))
                    <a href="{{ route('kurskodexsim.force', $kurskode->id ) }}" class="btn btn-primary float-right">Delete</a>
                    @endif
                    <button type="submit" class="btn btn-info float-right">{{ isset($kurskode) ? 'Update' : 'Submit' }}</button>
                </div>
            </form>

        </div> <!-- /.portlet-body -->

    </div> <!-- /.portlet -->
@endsection

@push('footerscripts')
       
@endpush