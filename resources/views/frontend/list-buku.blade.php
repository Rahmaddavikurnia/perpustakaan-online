@include('frontend.master.header')
<body>
    @include('frontend.master.navbar')
    <section class="pricing position-relative overflow-hidden"> 
        <div class="container position-relative">
            <div class="row justify-content-center">
                <div class="col-xxl-6 col-xl-6 col-lg-12 col-md-12 col-sm-12 col-12 text-center">
                    <small class="fs-7 d-block">List Buku</small>
                    <h2 class="fs-3 pricing-head text-black mb-0 position-relative">Daftar Buku perpustakaan online</h2>
                </div>
            </div>
            <div class="row justify-content-center price-plan">
                @foreach ($kategoris as $kategori)
                    {{-- <div class="col-xxl-6 col-xl-6 col-lg-12 col-md-12 col-sm-12 col-12 text-center"> --}}
                        <h2 class="fs-4 pricing-head text-black mb-0 position-relative text-center mt-4 mb-3">{{ucfirst($kategori->nama_kategori)}}</h2>
                    {{-- </div> --}}

                    @foreach ($kategori->buku as $item)
                        <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12">
                            <div class="card position-relative shadow border-0 h-100">
                                <div class="card-body pb-4">
                                    <small class="fs-7 d-block text-warning text-center">{{ucfirst($item->judul)}}</small>
                                    
                                        <div class="item">
                                            <a href="{{route('detail_buku',$item->id)}}"><img src="{{asset('storage/images/buku/'.$item->gambar)}}" class="w-100"></a>
                                        </div>
                                    <small class="fs-7 d-block text-center mt-3">Kategori : {{$item->kategoribuku->nama_kategori}}</small>
                                    <small class="fs-7 d-block text-center">Penulis : {{$item->penulis}}</small>
                                </div>
                                <div class="card-action text-center pb-xxl-5 pb-xl-5 pb-lg-5 pb-md-4 pb-sm-4 pb-4">
                                    <a href="{{route('detail_buku',$item->id)}}" class="btn btn-warning btn-hover-secondery text-capitalize">Lihat</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endforeach
            
               
            </div>
        </div>
    </section>
    
@include('frontend.master.footer')

@include('frontend.master.foot')

</body>
</html>