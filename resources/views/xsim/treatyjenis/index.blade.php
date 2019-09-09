@extends('layouts.app')

@push('headerscripts')
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/datatables/1.10.19/css/jquery.dataTables.min.css">

@endpush
@section('content')


    <div class="card">
        <div class="card-header">
        <div class="row">
            <div class="col-md-10">
                <strong>List Categories Treaty</strong>
            </div>
            <div class="col-md-2 ">  @include('xsim.treatyjenis.menu')</div>
        </div>
          
        </div>

        <div class="card-body">
            <table class="table table-stripped display" id="content-table">
                <thead>
                    <tr>
                    <th width="8%">Id</th>
                    <th>Kategori</th>
                    <th width="15%">Treaty Related</th>
                    <th width="10%">Created</th>
                    <th width="2%"></th>
                    <th width="5%">Action</th>
                    </tr>
                </thead>
            </table>

        </div> <!-- /.portlet-body -->

    </div> <!-- /.portlet -->
@endsection

@push('footerscripts')
<!-- DataTables -->
<script src="//cdnjs.cloudflare.com/ajax/libs/datatables/1.10.7/js/jquery.dataTables.min.js"></script>
        
<script>
$(function() {
    $('#content-table').DataTable({
        order: [[ 0, "desc" ]],
        processing: true,
        language: {
            processing: '<i class="fas fa-sync fa-spin fa-2x fa-fw"></i><span class="sr-only">Loading...</span> ',
            info: "Menampilkan Halaman _PAGE_ dari _PAGES_",
            lengthMenu: "Tampilkan _MENU_ data per halaman",
            zeroRecords: "Data Belum Tersedia",
            search: "Pencarian :",
            paginate: {
                first:      "<i class='fa fa-angle-double-left'></i>",
                last:       "<i class='fa fa-angle-double-right'></i>",
                next:       "<i class='fa fa-angle-right'></i>",
                previous:   "<i class='fa fa-angle-left'></i>"
            },
        },
        serverSide: true,
        ajax: { url : '{{ url("/json/dataTreatyJenis") }}'},
        columns: [
            {data: 'id' },
            {data: 'judul' },
            {data: 'treaties' },
            {data: 'created_at' },
            {target:0, data: 'status',
                render :  function( data, type, row ) 
                {   
                    if(data=='1') {
                        return '<div class="text-center"><a style="color:green" href="./treatyjenisxsim/'+row['id']+'/uncomplete" data-toggle="tooltip" data-placement="bottom" title="Published"><i class="fas fa-lg fa-clipboard-check"></i></a></div>';
                    }else{
                        return '<div class="text-center"><a style="color:red" href="./treatyjenisxsim/'+row['id']+'/complete" data-toggle="tooltip" data-placement="bottom" title="UnPublished"><i class="fas fa-lg fa-cloud-upload-alt"></i></a></div>';
                    }
                }
            },
            { data: function ( data, type, full, meta ) 
                {
                    return '<div class="text-center"><a href="./treatyjenisxsim/'+data.id+'/edit" data-toggle="tooltip" data-placement="bottom" title="Edit"><i class="fas fa-edit"></i></a>&nbsp;&nbsp;<a href="./treatyjenisxsim/'+data.id+'/force" style="color:red" data-toggle="tooltip" data-placement="bottom" title="Move to Trash"><i class="fas fa-trash"></i></a></div>';
                },searchable: false,orderable: false,targets: [-1, 1]
            }
        ]
    });
});
</script>
@endpush
