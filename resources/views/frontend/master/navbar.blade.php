<header class="main-header position-fixed w-100">
    <div class="container">
        <nav class="navbar navbar-expand-xl py-0">
            <div class="logo">
                <a class="navbar-brand py-0 me-0" href="{{route('home')}}"><img src="{{asset('storage/logo/4.png')}}" alt="" width="100px"></a>
            </div>
            <a class="d-inline-block d-lg-block d-xl-none d-xxl-none  nav-toggler text-decoration-none"  data-bs-toggle="offcanvas" href="#offcanvasExample" aria-controls="offcanvasExample">
                <i class="ti ti-menu-2 text-warning"></i>
            </a>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">                                             
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link text-capitalize" aria-current="page" href="{{route('home')}}">Beranda</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-capitalize" href="{{route('list_buku')}}">List Buku</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-capitalize" href="{{route('list_peminjaman')}}">info peminjaman</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-capitalize" href="{{route('koleksisaya')}}">Koleksi Buku</a>
                        </li>
                    </ul>
                    <div class="d-flex align-items-center">
                        <div class="input-group  search">
                            <button class="btn border-0 p-0" type="button" id="button-addon1"><i class="ti ti-search text-white"></i></button>
                            <input type="text" class="form-control border-0 bg-transparent ps-2" placeholder="search" aria-label="Example text with button addon" aria-describedby="button-addon1">
                        </div>
                        @if (Auth::check())
                            <form action="{{route('logout')}}" method="POST">
                                @csrf
                            </form>
                            <a class="btn btn-warning btn-hover-secondery text-capitalize " href="{{route('logout')}}">Logout</a>
                        @else
                            <a class="btn btn-warning btn-hover-secondery text-capitalize " href="{{route('login')}}">Login</a>
                        @endif
                        @if(!Auth::check() || Auth::user()->role != 'user')
                            <a class="btn btn-success text-capitalize ml-2" href="{{route('home_admin')}}"><i class="ti ti-user"></i></a>
                        @endif

                       
                    </div>
            </div>
        </nav>
    </div>

    <div class="offcanvas offcanvas-start"  tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
        <div class="offcanvas-header">
            <div class="logo">
                <a class="navbar-brand py-0 me-0" href="#"><img src="../assets/images/Creato-logo.svg" alt=""></a>
            </div> 
            <button type="button" class="btn-close text-reset  ms-auto" data-bs-dismiss="offcanvas" aria-label="Close"><i class="ti ti-x text-warning"></i></button>
        </div>
        <div class="offcanvas-body pt-0">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link text-capitalize" aria-current="page" href="{{route('home')}}">Beranda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-capitalize" href="">List Buku</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-capitalize" href="#">Pricing </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-capitalize" href="#">Elements </a>
                </li>
                </ul>
                <div class="login d-block align-items-center mt-3">
                    <a class="btn btn-warning text-capitalize w-100" href="#">contact us</a>
                </div>
        </div>
    </div>
</header>