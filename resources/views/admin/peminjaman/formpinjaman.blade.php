@include('admin.master.header')
  <body>
    <div class="wrapper">
      @include('admin.master.sidebar')

      <div class="main-panel">
        <div class="main-header">
          <div class="main-header-logo">
            <!-- Logo Header -->
            <div class="logo-header" data-background-color="dark">
              <a href="../index.html" class="logo">
                <img
                  src="../assets/img/kaiadmin/logo_light.svg"
                  alt="navbar brand"
                  class="navbar-brand"
                />
              </a>
              <div class="nav-toggle">
                <button class="btn btn-toggle toggle-sidebar">
                  <i class="gg-menu-right"></i>
                </button>
                <button class="btn btn-toggle sidenav-toggler">
                  <i class="gg-menu-left"></i>
                </button>
              </div>
              <button class="topbar-toggler more">
                <i class="gg-more-vertical-alt"></i>
              </button>
            </div>
            <!-- End Logo Header -->
          </div>
        @include('admin.master.navbar')
        </div>

        <div class="container">
          <div class="page-inner">
            <div class="page-header">
              <h3 class="fw-bold mb-3">Forms</h3>
              <ul class="breadcrumbs mb-3">
                <li class="nav-home">
                  <a href="#">
                    <i class="icon-home"></i>
                  </a>
                </li>
                <li class="separator">
                  <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                  <a href="#">Forms</a>
                </li>
                <li class="separator">
                  <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                  <a href="#">Basic Form</a>
                </li>
              </ul>
            </div>
            <div class="col-md-8">
              @if ($errors->any())
                  <div class="alert alert-danger">
                      <ul>
                          @foreach ($errors->all() as $error)
                              <li>{{ $error }}</li>
                          @endforeach
                      </ul>
                  </div>
              @endif
            </div>
            <div class="row">
              <div class="col-md-8">
                <div class="card">
                  <div class="card-header">
                    <div class="card-title">Form Peminjaman</div>
                  </div>
                <form action="{{route('manualpeminjaman')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                  <div class="card-body"> 
                    <div class="row">
                      <div class="col-md-12 col-lg-12">
                        <div class="form-group">
                          <label for="bukupilih">Judul Buku</label>
                          <select  class="form-control form-control" name="buku_id" id="bukupilih">
                          </select>
                        </div>
                        <div class="form-group">
                          <label for="userpilih">Nama Peminjam Buku</label>
                          <select  class="form-control form-control" name="user_id" id="userpilih">
                          </select>
                         </div>
                         <div class="form-group">
                            <label for="tanggal_pinjam">Tanggal Pinjam</label>
                            <input
                              type="date"
                              class="form-control form-control"
                              id="tanggal_pinjam"
                              placeholder="Masukkan Tanggal Pinjam"
                              name="tanggal_pinjam" min="{{date('Y-m-d')}}"/>
                          </div>
                         <div class="form-group">
                            <label for="tanggal_kembali">Tanggal Pengembalian</label>
                            <input
                              type="date"
                              class="form-control form-control"
                              id="tanggal_kembali"
                              placeholder="Masukkan Tanggal Kembali"
                              name="tanggal_kembali"/>
                          </div>
                      </div>    
                    </div>
                  </div>
                  <div class="card-action">
                    <button type="submit" class="btn btn-success">Simpan</button>
                    <button class="btn btn-danger">Cancel</button>
                  </div>
                 </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      @include('admin.master.skin')
    </div>
    @include('admin.master.foot')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script>
       
        $('#bukupilih').select2({
            placeholder: "Select Buku",
            minimumInputLength: 2,
            ajax: {
                url: '/bukucari/search',
                dataType: "json",
                data: (params) => {
                    let query = {
                        search: params.term,
                        page: params.page || 1,
                    };
                    return query;
                },
                processResults: function (data) {
                    return {
                        results: data.map(function(item) {
                            return { text: item.judul, id: item.id };
                        }),
                        // pagination: {
                        //     more: data.current_page < data.last_page,
                        // },
                    };
                },
            },
        });
    // </script>
    // <script>
       
        $('#userpilih').select2({
            placeholder: "Select User",
            minimumInputLength: 2,
            ajax: {
                url: '/user/search',
                dataType: "json",
                data: (params) => {
                    let query = {
                        search: params.term,
                        page: params.page || 1,
                    };
                    return query;
                },
                processResults: function (data) {
                    return {
                        results: data.map(function(item) {
                            return { text: item.name, id: item.id };
                        }),
                        // pagination: {
                        //     more: data.current_page < data.last_page,
                        // },
                    };
                },
            },
        });
    </script>
  </body>
</html>

