@include('frontend.master.header')
<body>
    @include('frontend.master.navbar')


    <section class="our-service position-relative overflow-hidden mt-5">
        <div class="container">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Judul Buku</th>
                    <th>Tanggal Pinjam</th>
                    <th>Tanggal Kembali</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($peminjamans as $peminjaman)
                <tr>
                    <td>{{ $peminjaman->id }}</td>
                    <td>{{ $peminjaman->buku->judul }}</td>
                    <td>{{ $peminjaman->tanggal_pinjam }}</td>
                    <td>{{ $peminjaman->tanggal_kembali }}</td>
                    <td>{{ $peminjaman->status }}</td>
                    <td> 
                    @if(!$peminjaman->pengembalian && $peminjaman->status == 'dipinjam')
                        <form action="{{route('pengembalian.store', $peminjaman->id)}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <button class="btn btn-warning btn-hover-secondery text-capitalize" type="submit">Kembalikan</button>
                        </form>
                    @elseif ($peminjaman->pengembalian && $peminjaman->pengembalian->status == 'Menunggu Persetujuan')
                        <i class="text-capitalize">Menunggu Konfirmasi</i>    
                    @elseif ($peminjaman->pengembalian && $peminjaman->pengembalian->status == 'Dikembalikan')
                        <i class="text-capitalize">Buku Telah Dikembalikan</i>
                    @endif</td>
                </tr>
                @endforeach
            </tbody>
        </table>
</div>

    </section>


    @include('frontend.master.footer')
    @include('frontend.master.foot')
</body>
</html>