@extends('layouts.app')

@push('headerscripts')
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/datatables/1.10.19/css/jquery.dataTables.min.css">

@endpush
@section('content')


    <div class="card">
        <div class="card-header">
        <div class="row">
            <div class="col-md-10">
                <strong>List Trashed Trending</strong>
            </div>
            <div class="col-md-2 ">  @include('xsim.trending.menu')</div>
        </div>
          
        </div>

        <div class="card-body">
            <table class="table table-stripped display" id="content-table">
                <thead>
                    <tr>
                    <th width="8%">Id</th>
                    <th>Judul</th>
                    <th width="15%">Contents Count</th>
                    <th width="10%">Created</th>
                    <th width="2%"></th>
                    <th width="5%">Action</th>
                    </tr>
                </thead>
            </table>

            <!-- Delete Modal -->
            <div class="modal fade" id="deletemodal" tabindex="-1" role="dialog" aria-labelledby="deletemodal" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <form action="" method="GET" id="DeleteCategoryForm">
                    @csrf
                    <div class="modal-content">
                    <div class="modal-body">
                    Are you sure want to permanently delete ?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger">Yes Delete</button>
                    </div>
                    </div>
                </form>
            </div>
            </div>

            <!-- Restore Modal -->
            <div class="modal fade" id="restoremodal" tabindex="-1" role="dialog" aria-labelledby="restoremodal" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <form action="" method="GET" id="RestoreCategoryForm">
                    @csrf
                    <div class="modal-content">
                    <div class="modal-body">
                    Are you sure want to Restore This Data ?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-info">Yes Restore</button>
                    </div>
                    </div>
                </form>
            </div>
            </div>
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
        ajax: { url : '{{ url("/json/trashedTrending") }}'},
        columns: [
            {data: 'id' },
            {data: 'judul' },
            {data: 'content_count' },
            {data: 'created_at' },
            {data: 'status',searchable: false,orderable: false,targets: [-1, 1],
                render : function ( data, type, row ) 
                {   
                    return '<div class="text-center"><i style="color:red" class="fas fa-lg fa-cloud-upload-alt" data-toggle="tooltip" data-placement="bottom" title="UnPublished"></i></div>';   
                }
            },
            {data: 'id',searchable: false,orderable: false,targets: [-1, 1],
                render : function ( data, type, row ) 
                {
                    return '<div class="text-center"><a href="#" onclick="handleRestore('+data+')" style="color:blue" data-toggle="modal" data-target="#restoremodal" title="Restore"><i class="fas fa-trash-restore"></i></a>&nbsp;&nbsp;<a href="#" onclick="handleDelete('+data+')" style="color:red" data-toggle="modal" data-target="#deletemodal" title="Permantly Delete"><i class="fas fa-times-circle"></i></a></div>';
                }
            }
        ]
    });
});

function handleDelete(id){
   // console.log('deleting'.id)
    var form = document.getElementById('DeleteCategoryForm')
    form.action = "./"+id+"/force"
    $('#DeleteModal').modal('show')
}
function handleRestore(id){
   // console.log('restore'.id)
    var form = document.getElementById('RestoreCategoryForm')
    form.action = "./"+id+"/restore"
    $('#RestoreModal').modal('show')
}
</script>
@endpush
