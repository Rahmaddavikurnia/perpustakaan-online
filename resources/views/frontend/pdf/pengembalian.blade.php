<!DOCTYPE html>
<html>

<head>
    <title>Laporan Pengembalian</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .text-danger {
            color: red;
        }

        .email {
            font-size: 12px;
            color: #666;
        }

        .kop-surat {
            margin-bottom: 30px;
            position: relative;
            padding-top: 20px;
        }

        .logo {
            position: absolute;
            left: 0;
            top: 0;
            width: 100px;
            height: auto;
        }

        .header-text {
            text-align: center;
            margin-left: 120px;
        }

        .header-text h2 {
            font-size: 24px;
            margin: 0 0 10px 0;
            line-height: 1.2;
        }

        .header-text p {
            font-size: 14px;
            margin: 5px 0;
            line-height: 1.4;
        }

        .divider {
            clear: both;
            border-bottom: 3px solid #000;
            margin-top: 20px;
            margin-bottom: 5px;
        }

        .divider-2 {
            border-bottom: 1px solid #000;
            margin-bottom: 20px;
        }

        .footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            text-align: right;
            padding: 20px 0;
        }

        .footer p {
            margin: 3px 0;
        }

        .signature {
            margin-top: 15px;
        }

        .page-break {
            page-break-after: always;
        }

        .periode {
            text-align: center;
            margin-bottom: 20px;
            font-size: 14px;
        }
    </style>
</head>

<body>
    <div class="kop-surat">
        <img src="{{ public_path('log.png') }}" class="logo" alt="Logo">
        <div class="header-text">
            <h2>PERPUSTAKAAN ONLINE</h2>
            <p>Jl. Koto kociak No. 123, Payakumbuh, Sumatera Barat</p>
            <p>Telp: (021) 1234567 | Email: perpustakaan@literalink.com</p>
        </div>
        <div class="divider"></div>
        <div class="divider-2"></div>
    </div>

    <h3 style="text-align: center;">LAPORAN <P>PENGEMBALIAN</P> BUKU</h3>
    <div class="periode">
        @php
            $date = request('date', date('Y-m-d'));
            $period = request('period', 'daily');
            
            switch($period) {
                case 'daily':
                    $periodText = 'Tanggal: ' . date('d F Y', strtotime($date));
                    break;
                case 'weekly':
                    $startWeek = date('d F Y', strtotime('monday this week', strtotime($date)));
                    $endWeek = date('d F Y', strtotime('sunday this week', strtotime($date)));
                    $periodText = "Periode: $startWeek - $endWeek";
                    break;
                case 'monthly':
                    $periodText = 'Periode: ' . date('F Y', strtotime($date));
                    break;
            }
        @endphp
        {{ $periodText }}
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Peminjam</th>
                <th>Buku</th>
                <th>Tanggal Kembali</th>
                <th>Denda</th>
               
            </tr>
        </thead>
        <tbody>
            @foreach($pengembalians as $index => $kembali)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>
                    {{ $kembali->peminjaman->user->name }}
                </td>
                <td>{{ $kembali->peminjaman->buku->judul }}</td>
                <td>{{ \Carbon\Carbon::parse($kembali->tanggal_pengembalian)->format('d/m/Y') }}</td>
                <td>{{ 'Rp. ' . number_format($kembali->denda, 0, ',', '.') }}</td>
                
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        <p>{{ date('d F Y') }}</p>
        <p>Kepala Perpustakaan</p>
        <div class="signature">
            <br>

            <img src="{{ public_path('tdd.png') }}" alt="" width="100px">

            <p>______________</p>
            <p>Yeni Nora Wiwi</p>
            <p>NIP. 123456789</p>
        </div>
    </div>
</body>

</html>