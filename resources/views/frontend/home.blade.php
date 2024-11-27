@include('frontend.master.header')
<body>
    @include('frontend.master.navbar')

    <section class="hero-banner position-relative overflow-hidden">
        <div class="container">
            <div class="row d-flex flex-wrap align-items-center">
                <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="position-relative left-hero-color">
                        <h2 class="mb-0 fw-bold">
                            Selamat Datang di Perpustakaan Digital! Temukan, Pinjam, dan Nikmati Pengetahuan Tanpa Batas.
                        </h2>
                        <p>Temukan, Pinjam, dan Nikmati Pengetahuan Tanpa Batas.</p>
                        <a href="{{route('home')}}" class="btn btn-warning btn-hover-secondery"><span class="d-inline-block me-2"><i class="ti ti-playstation-triangle"></i></span> Pelajari selengkapnya</a>
                    </div>
                </div>
                <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="position-relative right-hero-color">
                        <img src="{{asset('storage/logo/1.png')}}" class="img-fluid"> 
                    </div>          
                </div>
            </div>
        </div>
    </section>

    <section class="our-service position-relative overflow-hidden">
        <div class="container">
            <div class="row">
                <div class="col-xxl-8 col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                    <img src="{{asset('storage/logo/3.png')}}" class="img-fluid"> 
                </div>
                <div class="col-xxl-4 col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 ps-xxl-0 ps-xl-0 ps-lg-3 ps-md-3 ps-sm-3 ps-3">
                    <small class="fs-7 d-block">Perpustakaan online</small>
                    <h2 class="fs-2 text-black mb-0">Tentang Perpustakaan Online</h2>
                    <p class="mb-0 fw-500 fs-7">
                        Website Perpustakaan Online adalah platform digital yang dirancang untuk mempermudah akses ke berbagai koleksi buku, jurnal, dan bahan bacaan lainnya.
                    </p>
                    <ul class="list-unstyled mb-0 pl-0">
                        <li class="d-flex flex-wrap align-items-start">
                            <i class="ti ti-circle-check fs-4 pe-2"></i>
                            <span class="fs-7 text-black">Temukan berbagai buku, jurnal, dan bahan bacaan lainnya </span>
                        </li>
                        <li class="d-flex flex-wrap align-items-start">
                            <i class="ti ti-circle-check fs-4 pe-2"></i>
                            <span class="fs-7 text-black">Pinjam buku secara digital dengan proses yang sederhana dan transparan.</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section> 

    <section class="portfolio position-relative bg-primary">
        <div class="container position-relative">
            <div class="row">
                <div class="col-12"><small class="fs-7 d-block text-warning">Daftar buku</small></div>
                <div class="col-12 d-xxl-flex d-xl-flex d-lg-flex d-md-flex d-sm-block d-block align-items-center justify-content-xxl-between justify-content-xl-between justify-content-lg-between justify-content-md-between justify-content-sm-between justify-content-sm-center ">
                    <h2 class="fs-3 text-white mb-0">Temui Buku-buku<br> Menarik.</h2>
                    <a href="{{route('list_buku')}}" class="btn btn-warning btn-hover-secondery section-btn">List Buku</a>
                </div>
            </div>
        </div>
        <div class="container position-relative mt-5" >
            <div class="portfolio-wrap">
                <div class="owl-carousel owl-theme portfolio-slider">
                    @foreach ($bukus as $item)
                        <div class="item"><a href="{{route('detail_buku',$item->id)}}"><img src="{{asset('storage/images/buku/'.$item->gambar)}}" class="w-100"></a></div>
                    @endforeach
                        
                </div>
            </div>    
        </div>    
    </section>

    <section class="faq position-relative overflow-hidden">
        <div class="container position-relative">
            <div class="row justify-content-center">
                <div class="col-12 text-center">
                    <small class="fs-7 d-block">Frequently Asked Questions</small>
                    <h2 class="fs-3 text-black mb-0">Want to ask something from us?</h2>
                </div>
            </div>
            <div class="accordion-block">
                    <div class="accordion row" id="accordionPanelsStayOpenExample">
                        <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                            <div class="accordion-item mb-3">
                                <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                                  <button class="accordion-button text-black fs-7" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
                                      Letraset sheets containing sum passages ?
                                  </button>
                                </h2>
                                <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show" aria-labelledby="panelsStayOpen-headingOne">
                                  <div class="accordion-body fs-7 fw-500 pt-0">
                                      Seamlessly see the tasks that need your attention, check when your next meeting is coming up, and keep up with your progress.
                                  </div>
                                </div>
                            </div>
                            <div class="accordion-item mb-3">
                                <h2 class="accordion-header" id="panelsStayOpen-headingTwo">
                                  <button class="accordion-button collapsed text-black fs-7" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false" aria-controls="panelsStayOpen-collapseTwo">
                                      There are many variations ?
                                  </button>
                                </h2>
                                <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingTwo">
                                  <div class="accordion-body fs-7 fw-500 pt-0">
                                      Seamlessly see the tasks that need your attention, check when your next meeting is coming up, and keep up with your progress.
                                  </div>
                                </div>
                            </div>
                            <div class="accordion-item mb-3">
                                <h2 class="accordion-header" id="panelsStayOpen-headingThree">
                                  <button class="accordion-button collapsed text-black fs-7" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseThree" aria-expanded="false" aria-controls="panelsStayOpen-collapseThree">
                                      Lorem Ipsum generators on the Internet tend ?
                                  </button>
                                </h2>
                                <div id="panelsStayOpen-collapseThree" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingThree">
                                  <div class="accordion-body fs-7 fw-500 pt-0">
                                      Seamlessly see the tasks that need your attention, check when your next meeting is coming up, and keep up with your progress.
                                  </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                            <div class="accordion-item mb-3">
                                <h2 class="accordion-header" id="panelsStayOpen-headingfour">
                                  <button class="accordion-button collapsed text-black fs-7" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapsefour" aria-expanded="false" aria-controls="panelsStayOpen-collapsefour">
                                    Various versions have evolved over the ?
                                  </button>
                                </h2>
                                <div id="panelsStayOpen-collapsefour" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingfour">
                                  <div class="accordion-body fs-7 fw-500 pt-0">
                                      Seamlessly see the tasks that need your attention, check when your next meeting is coming up, and keep up with your progress.
                                  </div>
                                </div>
                            </div>
                            <div class="accordion-item mb-3">
                                <h2 class="accordion-header" id="panelsStayOpen-headingfive">
                                  <button class="accordion-button collapsed text-black fs-7" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapsefive" aria-expanded="false" aria-controls="panelsStayOpen-collapsefive">
                                    Finibus bonorum et malorum ?
                                  </button>
                                </h2>
                                <div id="panelsStayOpen-collapsefive" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingfour">
                                  <div class="accordion-body fs-7 fw-500 pt-0">
                                      Seamlessly see the tasks that need your attention, check when your next meeting is coming up, and keep up with your progress.
                                  </div>
                                </div>
                            </div>
                            <div class="accordion-item mb-3">
                                <h2 class="accordion-header" id="panelsStayOpen-headingsix">
                                  <button class="accordion-button collapsed text-black fs-7" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapsesix" aria-expanded="false" aria-controls="panelsStayOpen-collapsesix">
                                    Many desktop publishing packages ?
                                  </button>
                                </h2>
                                <div id="panelsStayOpen-collapsesix" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingsix">
                                  <div class="accordion-body fs-7 fw-500 pt-0">
                                      Seamlessly see the tasks that need your attention, check when your next meeting is coming up, and keep up with your progress.
                                  </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </section>
    @include('frontend.master.footer')

    
   @include('frontend.master.foot')
</body>
</html>