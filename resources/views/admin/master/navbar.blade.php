 <!-- Navbar Header -->
 <nav
 class="navbar navbar-header navbar-header-transparent navbar-expand-lg border-bottom"
>
 <div class="container-fluid">
   <nav
     class="navbar navbar-header-left navbar-expand-lg navbar-form nav-search p-0 d-none d-lg-flex"
   >
     <div class="input-group">
       <div class="input-group-prepend">
         <button type="submit" class="btn btn-search pe-1">
           <i class="fa fa-search search-icon"></i>
         </button>
       </div>
       <input
         type="text"
         placeholder="Search ..."
         class="form-control"
       />
     </div>
   </nav>

   <ul class="navbar-nav topbar-nav ms-md-auto align-items-center">
     <li
       class="nav-item topbar-icon dropdown hidden-caret d-flex d-lg-none"
     >
       <a
         class="nav-link dropdown-toggle"
         data-bs-toggle="dropdown"
         href="#"
         role="button"
         aria-expanded="false"
         aria-haspopup="true"
       >
         <i class="fa fa-search"></i>
       </a>
       <ul class="dropdown-menu dropdown-search animated fadeIn">
         <form class="navbar-left navbar-form nav-search">
           <div class="input-group">
             <input
               type="text"
               placeholder="Search ..."
               class="form-control"
             />
           </div>
         </form>
       </ul>
     </li>
     

     <li class="nav-item topbar-user dropdown hidden-caret">
       <a
         class="dropdown-toggle profile-pic"
         data-bs-toggle="dropdown"
         href="#"
         aria-expanded="false"
       >
         <div class="avatar-sm">
           <img
             src="https://ui-avatars.com/api/?name={{urlencode(Auth::user()->name)}}&background=random"
             alt="{{Auth::user()->name}}"
             class="avatar-img rounded-circle"
           />
         </div>
         <span class="profile-username">
           <span class="op-7">Hi,</span>
           <span class="fw-bold">{{Auth::user()->name}}</span>
         </span>
       </a>
       <ul class="dropdown-menu dropdown-user animated fadeIn">
         <div class="dropdown-user-scroll scrollbar-outer">
           <li>
             <div class="user-box">
               <div class="avatar-lg">
                 <img
                   src="https://ui-avatars.com/api/?name={{urlencode(Auth::user()->name)}}&background=random"
                   alt="image profile"
                   class="avatar-img rounded"
                 />
               </div>
               <div class="u-text">
                 <h4>{{Auth::user()->name}}</h4>
                 <p class="text-muted">{{Auth::user()->email}}</p>
               </div>
             </div>
           </li>
           <li>
             <div class="dropdown-divider"></div>
             @if (Auth::check())
                <form action="{{route('logout')}}" method="POST">
                    @csrf
                </form>
                <a class="dropdown-item" href="{{route('logout')}}"><i class="fas fa-sign-out-alt me-4"></i>Logout</a>
            @endif
           </li>
         </div>
       </ul>
     </li>
   </ul>
 </div>
</nav>
<!-- End Navbar -->