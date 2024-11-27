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
            <div class="row">
              <div class="col-md-12">
                <div class="card">
                  <div class="card-header">
                    <div class="card-title">Form Buku</div>
                  </div>
                <form action="{{route('buku.update',$buku )}}" method="POST" enctype="multipart/form-data">
                    @method('patch')
                    @csrf
                  <div class="card-body"> 
                    <div class="row">
                      <div class="col-md-6 col-lg-6">
                        <div class="form-group">
                          <label for="judul">Judul Buku</label>
                          <input
                            type="text"
                            class="form-control form-control"
                            id="judul"
                            placeholder="Masukkan Judul Buku"
                            name="judul" value="{{$buku->judul}}"/>
                        </div>
                        <div class="form-group">
                          <label for="kategori">Kategori Buku</label>
                          <select  class="form-control form-control" name="kategori_id" id="kategori">
                            <option value="{{$buku->kategori_id}}">{{$buku->kategoribuku->nama_kategori}}</option>
                          </select>
                      </div>
                        <div class="form-group">
                          <label for="stok">Stok Buku</label>
                          <input
                            type="number"
                            class="form-control form-control"
                            id="stok"
                            placeholder="Masukkan Stok Buku"
                            name="stok" value="{{$buku->stok}}"/>
                        </div>
                        <div class="form-group">
                          <label for="terbit">Tahun Terbit</label>
                          <input
                            type="date"
                            class="form-control form-control"
                            id="terbit"
                            placeholder="Masukkan Tahun Terbit"
                            name="tahun_terbit" value="{{$buku->tahun_terbit}}"/>
                        </div>
                        <div class="form-group">
                          <label for="penerbit">Penerbit</label>
                          <input
                            type="text"
                            class="form-control form-control"
                            id="penerbit"
                            placeholder="Masukkan Nama Penerbit"
                            name="penerbit" value="{{$buku->penerbit}}"/>
                        </div>
                       
                      </div>
                      <div class="col-md-6 col-lg-6">
                        <div class="form-group">
                          <label for="penulis">Penulis</label>
                          <input
                            type="text"
                            class="form-control form-control"
                            id="penulis"
                            placeholder="Masukkan Nama Penulis"
                            name="penulis" value="{{$buku->penulis}}"/>
                        </div>
                        <div class="form-group">
                          <label for="gambar">Foto Buku</label>
                          <input
                            type="file"
                            class="form-control form-control"
                            id="gambar"
                            placeholder="Masukkan Foto Buku"
                            name="gambar"/>
                        </div>
                        <div class="form-group">
                            <label for="isi">Deskripsi Buku</label>
                            <textarea class="form-control" id="isi" rows="5" name="deskripsi">{{$buku->deskripsi}}
                            </textarea>
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
       
        $('#kategori').select2({
            placeholder: "Select kategori",
            minimumInputLength: 2,
            ajax: {
                url: '/kategoribuku/search',
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
                            return { text: item.nama_kategori, id: item.id };
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

