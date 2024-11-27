@include('frontend.master.header')
<body>
    @include('frontend.master.navbar')

    <section class="our-service position-relative overflow-hidden mt-5">
        <div class="container">
            <div class="row d-flex align-items-center">
                <h3 class="fs-3 text-black mb-5 text-center">{{ucfirst($bukus->judul)}}</h3>
                <div class="col-xxl-6 col-xl-4 col-lg-4 col-md-8 col-sm-8 col-8">
                    <img src="{{asset('storage/images/buku/'.$bukus->gambar)}}" class="img-fluid">
                </div>
                {{-- <div class="col-xxl-4 col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 ps-xxl-0 ps-xl-0 ps-lg-3 ps-md-3 ps-sm-3 ps-3"> --}}
                <div class="col-xxl-4 col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12" style="padding-left: 80px;">
                    <small class="fs-7 d-block">Perpustakaan Online</small>
                    <h2 class="fs-2 text-black mb-4">Detail Buku</h2>
                    <small class="fs-7 d-block">Penulis : {{$bukus->penulis}}</small>
                    <small class="fs-7 d-block">Penerbit : {{$bukus->penerbit}}</small>
                    <small class="fs-7 d-block">Tahun Terbit : {{$bukus->tahun_terbit}}</small>

                    <p class="mb-0 fw-500 fs-7">
                        {{ $bukus->deskripsi }}.
                    </p>

                    @if (auth()->user()->role === 'user')
                        
                    @if ($bukus->peminjamans && $bukus->peminjamans->status === 'menunggu')
                        <i class="btn btn-warning btn-hover-secondery text-capitalize mb-5">Menunggu Konfirmasi</i>
                    @elseif ($bukus->peminjamans && $bukus->peminjamans->status === 'ditolak')
                        <form action="{{route('peminjaman', $bukus->id)}}" method="POST">
                            @csrf
                            <button class="btn btn-warning btn-hover-secondery text-capitalize mb-5" type="submit">Pinjam Ulang Buku</button>
                        </form>
                    @elseif ($bukus->peminjamans && $bukus->peminjamans->status === 'dipinjam')
                        <i class="btn btn-warning btn-hover-secondery text-capitalize mb-5">Sedang Dipinjam</i>
                    @else
                        <form action="{{route('peminjaman', $bukus->id)}}" method="POST">
                            @csrf
                            <button class="btn btn-info btn-hover-secondery text-capitalize mb-5" type="submit">Pinjam Buku</button>
                        </form>
                    @endif
                        
                    @endif

                   

                    @if ($bukus->sudahDiKoleksi(Auth::id()))
                        <i class="btn btn-warning btn-hover-secondery text-capitalize mb-5">Sudah ada di koleksi</i>
                    @else
                    <form action="{{route('tambahkoleksi', $bukus->id)}}" method="POST">
                        @csrf
                        <button class="btn btn-primary btn-hover-secondery text-capitalize mb-5" type="submit">Tambah Koleksi</button>
                    </form>                    @endif
                    
                </div>                   
            </div>
        </div>
    </section> 
    <section class="portofolio position-relative overflow-hidden mb-5">
        <div class="container">
            <div class="row d-flex align-items-center">
                <div class="col-xxl-6 col-xl-4 col-lg-4 col-md-8 col-sm-8 col-8">
                    <form action="{{ route('ulasan.store',$bukus->id) }}" method="POST" class="">
                        @csrf
                        <div class="card shadow-sm p-4">
                            <h5 class="mb-3">Review</h5>
                    
                            <!-- Rating -->
                            <div class="rating d-flex align-items-center mb-3">
                                @for ($i = 5; $i >= 1; $i--)
                                    <input type="radio" name="rating" id="star{{ $i }}" value="{{ $i }}">
                                    <label for="star{{ $i }}" class="fa fa-star"></label>
                                @endfor
                            </div>
                    
                            <!-- Comment -->
                            <div class="form-group mb-3">
                                <textarea name="ulasan" class="form-control" placeholder="Comment" rows="4" required></textarea>
                            </div>
                    
                            <!-- Submit Button -->
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form> 
                </div>
                {{-- <div class="col-xxl-4 col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 ps-xxl-0 ps-xl-0 ps-lg-3 ps-md-3 ps-sm-3 ps-3"> --}}
                <div class="col-xxl-4 col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12" style="padding-left: 80px;">
                    <div class="ulasan-section mt-5">
                        <h4 class="fs-4 text-black mt-2">Ulasan</h4>
                        @forelse ($bukus->ulasan as $ulasan)
                            <div class="review">
                                <!-- Rating -->
                                <ul>
                                    <li>
                                        <h5>{{ $ulasan->user->name }}</h5>
                                        <div class="stars">
                                            @for ($i = 1; $i <= 5; $i++)
                                                <span class="fa fa-star  {{ $i <= $ulasan->rating ? 'checked' : '' }}"></span>
                                            @endfor
                                        </div>
                                        <!-- Komentar -->
                                        <p>{{ $ulasan->ulasan }}</p>
                                    </li>
                                </ul>
                                
                            </div>
                        @empty
                            <p>Belum ada ulasan untuk buku ini.</p>
                        @endforelse
                    </div>
                    
                    
                </div>
            </div>
        </div>
    </section> 

    @include('frontend.master.footer')

    <script>
        document.querySelectorAll('.rating input').forEach(input => {
            input.addEventListener('change', function () {
                console.log(`Rating selected: ${this.value}`);
            });
        });
    </script>
    @include('frontend.master.foot')
</body>
</html>
