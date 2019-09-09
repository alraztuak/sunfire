
         <!-- Menu for Berita -->
            <div class="btn-group float-right">
              <button type="button" class="btn btn-sm btn-secondary dropdown-toggle" data-toggle="dropdown" data-display="static" aria-haspopup="true" aria-expanded="false">
                  <i class="fas fa-md fa-newspaper"></i>&nbsp;&nbsp; Menu Peraturan
              </button>
              <div class="dropdown-menu dropdown-menu-lg-right">
                <small>
                  <a href="{{ route('aturanxsim.index') }}" class="dropdown-item">
                      <i class="fas fa-md fa-list"></i>&nbsp;&nbsp;Show List
                  </a>
                </small>
                <small>
                  <a href="{{ route('aturanxsim.create') }}" class="dropdown-item">
                    <i class="fas fa-md fa-clipboard-check"></i>&nbsp;&nbsp;Add New
                  </a>
                </small>
                <hr />
                <small>
                  <a href="{{ route('aturanxsim.trashed') }}" class="dropdown-item">
                      <i class="fas fa-md fa-trash"></i>&nbsp;&nbsp;Trash List
                  </a>
                </small>
                <hr />
                <small>
                  <a href="#" onclick="handleAllRestore()" data-toggle="modal" data-target="#restoreallmodal" class="dropdown-item">
                      <i class="fas fa-md fa-trash-restore"></i>&nbsp;&nbsp;Restore All List
                  </a>
                </small>
                <small>
                  <a href="#" onclick="handleAllDelete()" data-toggle="modal" data-target="#deleteallmodal" class="dropdown-item">
                      <i class="fas fa-md fa-times-circle"></i>&nbsp;&nbsp;Delete All List
                  </a>
                </small>
              </div>
            </div>

            <!-- Delete Modal -->
            <div class="modal fade" id="deleteallmodal" tabindex="-1" role="dialog" aria-labelledby="deleteallmodal" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <form action="" method="GET" id="DeleteAllCategoryForm">
                    @csrf
                    <div class="modal-content">
                    <div class="modal-body">
                    Are you sure want to permanently delete All data in Trash List  ?
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
            <div class="modal fade" id="restoreallmodal" tabindex="-1" role="dialog" aria-labelledby="restoreallmodal" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <form action="" method="GET" id="RestoreAllCategoryForm">
                    @csrf
                    <div class="modal-content">
                    <div class="modal-body">
                    Are you sure want to Restore All data in Trash List?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-info">Yes Restore</button>
                    </div>
                    </div>
                </form>
            </div>
            </div>

@push('footerscripts')
<script>
function handleAllDelete(){
   // console.log('deleting'.id)
    var form = document.getElementById('DeleteAllCategoryForm')
    form.action = "/xsim/aturanxsim/0/force"
    $('#DeleteAllModal').modal('show')
}
function handleAllRestore(){
   // console.log('restore'.id)
    var form = document.getElementById('RestoreAllCategoryForm')
    form.action = "/xsim/aturanxsim/0/restore"
    $('#RestoreAllModal').modal('show')
}
</script>
@endpush