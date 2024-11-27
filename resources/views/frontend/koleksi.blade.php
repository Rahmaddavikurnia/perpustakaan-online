@include('frontend.master.header')
<body>
    @include('frontend.master.navbar')


    <section class="our-service position-relative overflow-hidden mt-5">
        <div class="container">
        <table class="table table-hover">
            <thead>
                <tr>
                        <th>Judul Buku</th>
                    <th>Penulis</th>
                    <th>Deskripsi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($koleksi as $item)
                <tr>
                    <td>{{ $item->buku->judul }}</td>
                    <td>{{ $item->buku->penulis }}</td>
                    <td>{{ $item->buku->deskripsi }}</td>
                    <td class="d-flex">
                        <form action="{{route('detail_buku', $item->id)}}" method="GET" enctype="multipart/form-data">
                            @csrf
                            <button class="btn-kecil btn-primary text-capitalize" style="margin-right: 4px" type="submit"><i class="ti ti-eye"></i></button>
                        </form>
                        <form action="{{route('hapuskoleksi', $item)}}" method="POST" enctype="multipart/form-data">
                            @method('DELETE')
                            @csrf
                            <button class="btn-kecil btn-warning text-capitalize" type="submit"><i class="ti ti-trash"></i></button>
                        </form>
                    </td>
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