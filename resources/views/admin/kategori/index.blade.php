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
                  src="admin/assets/img/kaiadmin/logo_light.svg"
                  alt="navbar brand"
                  class="navbar-brand"
                  height="20"
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
          <!-- Navbar Header -->
        @include('admin.master.navbar')
        </div>

        <div class="container">
          <div class="page-inner">
            <div class="page-header">
              <h3 class="fw-bold mb-3">Data Kategori</h3>
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
                  <a href="#">Table</a>
                </li>
                <li class="separator">
                  <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                  <a href="#">kategori buku</a>
                </li>
              </ul>
            </div>
            <div class="row">
              <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Data Kategori</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <div id="basic_datatables_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap-4">
                                <div class="row">
                                <div class="col-sm-10 col-md-6">
                                    <div class="dataTables_length" id="basic_datatables_length">
                                    <label>Show
                                        <select name="basic_datatables_length" aria-controls="basic-datatables" class="form-control form-control-sm">
                                        <option value="10">10</option>
                                        <option value="25">25</option>
                                        <option value="50">50</option>
                                        <option value="100">100</option>
                                        </select>
                                        entries
                                    </label>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <div class="dataTables_filter" id="basic-datatables_filter">
                                        <label>
                                            Search:
                                            <input type="search" class="form-control form-control-sm" placeholder aria-controls="basic-datatables">
                                        </label>
                                    </div>
                                </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <table
                                        id="basic-datatables"
                                        class="display table table-striped table-hover dataTable" role="grid" aria-describedby="basic-datatables_info">
                                        <thead>
                                        <tr role="row">
                                            <th class="sorting" tabindex="0" aria-controls="multi-filter-select" rowspan="1" 
                                            colspan="1" aria-sort="ascending" aria-label="Nama Jurusan: active to sort column descending" style="width: 50.125px;">Id</th>
                                            <th class="sorting" tabindex="0" aria-controls="multi-filter-select" rowspan="1" 
                                            colspan="1" aria-sort="ascending" aria-label="Nama Jurusan: active to sort column descending" style="width: 570.125px;">Nama Kategori</th>
                                            <th class="sorting_asc" tabindex="0" aria-controls="multi-filter-select" rowspan="1" 
                                            colspan="1" aria-label="Foto: active to sort column ascending" style="width: 200px">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($kategoribuku as $item)
                                            <tr role="row">
                                                <td>{{$item->id}}</td>
                                                <td>{{$item->nama_kategori}}</td>
                                                <td>
                                                    <div class="form-button-action">
                                                        <form action="{{route('kategoribuku.update', $item->id)}}" method="get">
                                                            @csrf
                                                            <button
                                                            type="submit"
                                                            class="btn btn-link btn-warning"
                                                            >
                                                            <i class="fa fa-edit"></i>
                                                            </button>
                                                        </form>
                                                        <form action="{{route('kategoribuku.destroy',$item->id)}}" method="POST">
                                                            @method('delete')
                                                            @csrf
                                                            <button
                                                            type="submit"
                                                            data-bs-toggle="tooltip"
                                                            class="btn btn-link btn-danger"
                                                            data-original-title="Remove"
                                                            >
                                                            <i class="fa fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-md-5">
                                    <div class="dataTables_info" id="basic-datatables_info" role="status" aria-live="polite">Showing 1 to 10</div>
                                </div>
                                <div class="col-sm-12 col-md-7">
                                    <div class="demo">
                                      {{-- {{ $jurusans->links('admin.pagination') }} --}}
                                      </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      @include('admin.master.skin')
    </div>
  @include('admin.master.foot')
  </body>
</html>
