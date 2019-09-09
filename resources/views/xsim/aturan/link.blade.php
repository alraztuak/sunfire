
@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
        <div class="row">
            <div class="col-md-10">
                    <strong>Input Link Peraturan [ {{ $aturan->nomor }} ]</strong>
            </div>
            <div class="col-md-2 ">  @include('xsim.aturan.menu')</div>
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
        <form action="{{ route('aturanxsim.link', $aturan->id ) }}" method="GET">
            @csrf
            <div class="form-group">
                <label for="judul">input ID Peraturan yang akan di link</label>
                <input type="text" class="form-control" id="id" name="id"/>
            </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-info float-right">Search</button>
                </div>
            </form>
        </div> <!-- /.portlet-body -->
        @if(isset($search))
            @if($search->id!=$aturan->id)
            <div class="card-body">
                <div class="row">
                <div class="col-md-12">
                    <p><b>-== Hasil Pencarian ==-</b></p>
                </div>
                <div class="col-md-8">
                    <b>[{{ $search->id }}]</b> {{ $search->nomor }}
                </div>
                <div class="col-md-4">
                Add to 
                &nbsp;->&nbsp;<a href="{{ route('aturanxsim.addterkait', [$aturan->id, $search->id] ) }}"><i class="fas fa-project-diagram"></i> Terkait</a>
                &nbsp;|&nbsp;<a href="{{ route('aturanxsim.addhistori', [$aturan->id, $search->id] ) }}"><i class="fas fa-history"></i> Histori</a>
                &nbsp;|&nbsp;<a href="{{ route('aturanxsim.addstatus', [$aturan->id, $search->id] ) }}"><i class="fas fa-info-circle"></i> Status</a>
                </div>
                </div>
            </div>
            @endif
        @else
            <div class="card-body">
                <div class="row">
                <div class="col-md-12 alert alert-warning text-center">
                    <h5>ID peraturan tidak ditemukan</h5>
                </div>
                </div>
            </div>
        @endif
        <hr />
        <div class="card-body">
            <div class="row">
            <div class="col-md-4">
                <p>
                <i class="fas fa-project-diagram"></i>&nbsp; List Peraturan Terkait : <strong>{{ $aturan->nomor }}</strong>
                </p>
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                    <tr>
                        <th width="10%">ID</th>
                        <th>Peraturan Terkait</th>
                        <th width="8%">Action</th>
                    </tr>
                    </thead>
                    <tbody style="font-size:12px">
                        @foreach($terkait as $terkaits)
                            <tr >
                                <td>{{ $terkaits->terkait_id }}</td>
                                <td>
                                    {{ $terkaits->nomor }}
                                </td>
                                <td style="text-align:center"><a href="#" onclick="handleDeleteTerkait('{{ $terkaits->id }}')" style="color:red" data-toggle="modal" data-target="#deletemodalTerkait" title="Delete Terkait"><i class="fas fa-trash"></i></a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-md-4">
                <p>
                <i class="fas fa-history"></i>&nbsp; List Histori Peraturan : <strong>{{ $aturan->nomor }}</strong>
                </p>
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                    <tr>
                        <th width="10%">ID</th>
                        <th>Histori Peraturan</th>
                        <th width="8%">Action</th>
                    </tr>
                    </thead>
                    <tbody style="font-size:12px">
                        @foreach($histori as $historis)
                            <tr >
                                <td>{{ $historis->histori_id }}</td>
                                <td>{{ $historis->nomor }}
                                </td>
                                <td style="text-align:center"><a href="#" onclick="handleDeleteHistori('{{ $historis->id }}')" style="color:red" data-toggle="modal" data-target="#deletemodalHistori" title="Delete Histori"><i class="fas fa-trash"></i></a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-md-4">
                <p>
                <i class="fas fa-info-circle"></i>&nbsp; List Status Peraturan : <strong>{{ $aturan->nomor }}</strong>
                </p>
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                    <tr>
                        <th width="10%">ID</th>
                        <th>Status Peraturan</th>
                        <th width="8%">Action</th>
                    </tr>
                    </thead>
                    <tbody style="font-size:12px">
                        @foreach($status as $statuss)
                            <tr >
                                <td>{{ $statuss->status_id }}</td>
                                <td>{{ $statuss->nomor }}
                                </td>
                                <td style="text-align:center"><a href="#" onclick="handleDeleteStatus('{{ $statuss->id }}')" style="color:red" data-toggle="modal" data-target="#deletemodalStatus" title="Delete Status"><i class="fas fa-trash"></i></a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

                <!-- Delete Modal Status -->
                <div class="modal fade" id="deletemodalStatus" tabindex="-1" role="dialog" aria-labelledby="deletemodalStatus" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <form action="" method="GET" id="DeleteStatusForm">
                        @csrf
                        <div class="modal-content">
                        <div class="modal-body">
                        Are you sure want to delete from Status ?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-danger">Yes Delete</button>
                        </div>
                        </div>
                    </form>
                </div>
                </div>

                <!-- Delete Modal Status -->
                <div class="modal fade" id="deletemodalTerkait" tabindex="-1" role="dialog" aria-labelledby="deletemodalTerkait" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <form action="" method="GET" id="DeleteTerkaitForm">
                        @csrf
                        <div class="modal-content">
                        <div class="modal-body">
                        Are you sure want to delete from Terkait ?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-danger">Yes Delete</button>
                        </div>
                        </div>
                    </form>
                </div>
                </div>
                
                <!-- Delete Modal Status -->
                <div class="modal fade" id="deletemodalHistori" tabindex="-1" role="dialog" aria-labelledby="deletemodalHistori" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <form action="" method="GET" id="DeleteHistoriForm">
                        @csrf
                        <div class="modal-content">
                        <div class="modal-body">
                        Are you sure want to delete from Histori ?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-danger">Yes Delete</button>
                        </div>
                        </div>
                    </form>
                </div>
                </div>
                
            </div>
        </div>
    </div> <!-- /.portlet -->
@endsection

@push('footerscripts')
<script>
function handleDeleteTerkait(id){
   // console.log('deleting'.id)
    var form = document.getElementById('DeleteTerkaitForm')
    form.action = "./delterkait/"+id+""
    $('#DeleteModalTerkait').modal('show')
}
function handleDeleteHistori(id){
   // console.log('deleting'.id)
    var form = document.getElementById('DeleteHistoriForm')
    form.action = "./delhistori/"+id+""
    $('#DeleteModalHistori').modal('show')
}
function handleDeleteStatus(id){
   // console.log('deleting'.id)
    var form = document.getElementById('DeleteStatusForm')
    form.action = "./delstatus/"+id+""
    $('#DeleteModalStatus').modal('show')
}
</script>
@endpush