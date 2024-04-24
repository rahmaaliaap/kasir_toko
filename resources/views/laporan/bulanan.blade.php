@extends('layouts.laporan', ['title' => 'Laporan Bulanan'])
@section('content')
    <h1 class="text-center">Laporan Bulanan</h1>

    <p>Bulan: {{ $bulan }} {{ request()->tahun }}</p>
    <!-- Menampilkan nama peran (role) yang dipilih jika ada -->
    @if(request()->role)
        <p>Nama: {{ ucfirst(request()->role) }}</p>
    @endif

    <table class="table table-bordered table-sm">
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Kasir</th>
                <th>Jumlah Transaksi</th>
                <th>Total</th>
            </tr>
        </thead>

        <tbody>
        @php
        $totalPenjualan = 0;
        $nomor = 1;
        @endphp

        @foreach ($penjualan as $key => $row)
        @if($row->status != 'batal')
        <tr>
            <td>{{ $nomor++ }}</td>
            <td>{{ $row->nomor_transaksi }}</td>
            <td>{{ $row->nama_pelanggan }}</td>
            <td>{{ $row->nama_kasir }}</td>
            <td>

            <td>{{ date('H:i:s', strtotime($row->tanggal)) }}</td>
            <td>{{ number_format($row->total, 0, ',', '.') }}</td>
        </tr>
        @php
        $totalPenjualan += $row->total;
        @endphp
        @endif
        @endforeach
            <!-- @foreach ($penjualan as $key => $row)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $row->tgl }}</td>
                    <td>{{ $row->nama_kasir }}</td>
                    <td>{{ $row->jumlah_transaksi }}</td>
                    <td>{{ number_format($row->jumlah_total, 0, ',', '.') }}</td>
                </tr>
            @endforeach -->
        </tbody>
        
        <tfoot>
            <tr>
                <th colspan="4">Jumlah Total</th>
                <th>{{ number_format($penjualan->sum('jumlah_total'), 0, ',', '.') }}</th>
            </tr>
        </tfoot>

    </table>
@endsection