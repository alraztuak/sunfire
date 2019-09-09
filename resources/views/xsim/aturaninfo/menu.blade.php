
         <!-- Menu for Berita -->
            <div class="btn-group float-right">
              <button type="button" class="btn btn-sm btn-secondary dropdown-toggle" data-toggle="dropdown" data-display="static" aria-haspopup="true" aria-expanded="false">
                  <i class="fas fa-md fa-newspaper"></i>&nbsp;&nbsp; Menu Info Peraturan
              </button>
              <div class="dropdown-menu dropdown-menu-lg-right">
                <small>
                  <a href="{{ route('aturaninfoxsim.index') }}" class="dropdown-item">
                      <i class="fas fa-md fa-list"></i>&nbsp;&nbsp;Show List
                  </a>
                </small>
                <small>
                  <a href="{{ route('aturaninfoxsim.create') }}" class="dropdown-item">
                    <i class="fas fa-md fa-clipboard-check"></i>&nbsp;&nbsp;Add New
                  </a>
                </small>
                <hr />
                <small>
                  <a href="{{ route('aturanxsim.index') }}" class="dropdown-item">
                    <i class="fas fa-md fa-book"></i>&nbsp;&nbsp;Kembali ke List Peraturan
                  </a>
                </small>
              </div>
            </div>