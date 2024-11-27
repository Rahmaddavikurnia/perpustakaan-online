<div class="sidebar" data-background-color="dark">
    <div class="sidebar-logo">
      <!-- Logo Header -->
      <div class="logo-header" data-background-color="dark">
        <a href="{{route('home')}}" class="logo">
          <img
            src="{{asset('storage/logo/4.png')}}"
            alt="navbar brand"
            class="navbar-brand"
            width="150"
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
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
      <div class="sidebar-content">
        <ul class="nav nav-secondary">
          <li class="nav-item">
            <a href="{{route('home_admin')}}">
              <i class="fas fa-home"></i>
              <p>Dashboard</p>
            </a>
          </li>
          <li class="nav-section">
            <span class="sidebar-mini-icon">
              <i class="fa fa-ellipsis-h"></i>
            </span>
            <h4 class="text-section">Data Website</h4>
          </li>
          <li class="nav-item">
            <a data-bs-toggle="collapse" href="#kategori_buku">
              <i class="fas fa-layer-group"></i>
              <p>Kategori Buku</p>
              <span class="caret"></span>
            </a>
            <div class="collapse" id="kategori_buku">
              <ul class="nav nav-collapse">
                <li>
                  <a href="{{route('kategoribuku.create')}}">
                    <span class="sub-item">Tambah kategori</span>
                  </a>
                </li>
                <li>
                  <a href="{{route('kategoribuku.index')}}">
                    <span class="sub-item">Data Kategori</span>
                  </a>
                </li>
              </ul>
            </div>
          </li>
          @if(Auth::user()->role === 'admin')
          <li class="nav-item">
            <a data-bs-toggle="collapse" href="#user">
              <i class="fas fa-user"></i>
              <p>Data User</p>
              <span class="caret"></span>
            </a>
            <div class="collapse" id="user">
              <ul class="nav nav-collapse">
                <li>
                  <a href="{{route('createuser')}}">
                    <span class="sub-item">Tambah User</span>
                  </a>
                </li>
                <li>
                  <a href="{{route('user.index')}}">
                    <span class="sub-item">Data User</span>
                  </a>
                </li>
              </ul>
            </div>
          </li>
          @endif
          <li class="nav-item">
            <a data-bs-toggle="collapse" href="#buku">
              <i class="fas fa-book"></i>
              <p>Daftar Buku</p>
              <span class="caret"></span>
            </a>
            <div class="collapse" id="buku">
              <ul class="nav nav-collapse">
                <li>
                  <a href="{{route('buku.create')}}">
                    <span class="sub-item">Tambah buku</span>
                  </a>
                </li>
                <li>
                  <a href="{{route('buku.index')}}">
                    <span class="sub-item">Data buku</span>
                  </a>
                </li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a data-bs-toggle="collapse" href="#permintaan">
              <i class="fas fa-book"></i>
              <p>Data Peminjaman Buku</p>
              <span class="caret"></span>
            </a>
            <div class="collapse" id="permintaan">
              <ul class="nav nav-collapse">
                <li>
                  <a href="{{route('permintaan')}}">
                    <span class="sub-item">Data Permintaan buku</span>
                  </a>
                </li>
                <li>
                  <a href="{{route('formpinjaman')}}">
                    <span class="sub-item">Tambah Peminjam buku</span>
                  </a>
                </li>
                <li>
                  <a href="{{route('allpeminjaman')}}">
                    <span class="sub-item">Data Peminjam buku</span>
                  </a>
                </li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a data-bs-toggle="collapse" href="#pengembalian">
              <i class="fas fa-book"></i>
              <p>Pengembalian Buku</p>
              <span class="caret"></span>
            </a>
            <div class="collapse" id="pengembalian">
              <ul class="nav nav-collapse">
                <li>
                  <a href="{{route('pengembalian.index')}}">
                    <span class="sub-item">Data Kembali buku</span>
                  </a>
                </li>
                <li>
                  <a href="{{route('pengembalian.all')}}">
                    <span class="sub-item">Data Pengembalian buku</span>
                  </a>
                </li>
              </ul>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </div>
  <!-- End Sidebar -->