@extends('cetak.index')

@section('content')
    <div class="text-center f-bold report-title">LAPORAN PENGEMBALIAN INVENTARIS DESA</div>
    <div class="text-center">Periode Laporan {{ $tgl1 }} - {{ $tgl2 }}</div>
    <hr>
    <br>
    <table id="my-table" class="table display">
        <thead>
        <tr>
            <th width="7%" class="text-center">#</th>
            <th width="15%">Tanggal</th>
            <th width="15%">No. Peminjaman</th>
            <th>Nama Peminjam</th>
            <th>Keterangan</th>
        </tr>
        </thead>
        <tbody>
        @foreach($data as $v)
            <tr>
                <td width="5%" class="text-center">{{ $loop->index + 1 }}</td>
                <td>{{ $v->tanggal }}</td>
                <td>{{ $v->peminjaman->no_peminjaman }}</td>
                <td>{{ $v->peminjaman->nama }}</td>
                <td>{{ $v->keterangan }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <hr>
    <br>
    <div class="row">
        <div class="col-xs-8"></div>
        <div class="col-xs-3">
            <div class="text-center">
                <p class="text-center">Surakarta, {{ date('d-m-Y') }}</p>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-3">
            <div class="text-center">
                <p class="text-center">Pimpinan</p>
            </div>
        </div>
        <div class="col-xs-5"></div>
        <div class="col-xs-3">
            <div class="text-center">
                <p class="text-center">Mengetahui,</p>
                <p class="text-center">Admin</p>
            </div>
        </div>
    </div>
    <br>
    <br>
    <div class="row">
        <div class="col-xs-3">
            <div class="text-center">
                <p class="text-center">(Pimpinan)</p>
            </div>
        </div>
        <div class="col-xs-5"></div>
        <div class="col-xs-3">
            <div class="text-center">
                <p class="text-center">(Admin)</p>
            </div>
        </div>
    </div>
@endsection
