
         <!-- Menu for Berita -->
            <div class="btn-group float-right">
              <button type="button" class="btn btn-sm btn-secondary dropdown-toggle" data-toggle="dropdown" data-display="static" aria-haspopup="true" aria-expanded="false">
                  <i class="fas fa-md fa-newspaper"></i>&nbsp;&nbsp; Menu Categories Putusan
              </button>
              <div class="dropdown-menu dropdown-menu-lg-right">
                <small>
                  <a href="{{ route('putusancatxsim.index') }}" class="dropdown-item">
                      <i class="fas fa-md fa-list"></i>&nbsp;&nbsp;Show List
                  </a>
                </small>
                <small>
                  <a href="{{ route('putusancatxsim.create') }}" class="dropdown-item">
                    <i class="fas fa-md fa-clipboard-check"></i>&nbsp;&nbsp;Add New
                  </a>
                </small>
              </div>
            </div>