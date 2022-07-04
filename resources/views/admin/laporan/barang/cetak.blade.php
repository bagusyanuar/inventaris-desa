@extends('cetak.index')

@section('content')
    <div class="text-center f-bold report-title">LAPORAN PERSEDIAAN BARANG</div>
    <div class="text-center">Periode Laporan per tanggal  {{ date('d-m-Y') }}</div>
    <hr>
    <br>
    <table id="my-table" class="table display">
        <thead>
        <tr>
            <th width="5%" class="text-center">#</th>
            <th>Kategori</th>
            <th>Nama</th>
            <th>qty</th>
            <th>Deskripsi</th>
        </tr>
        </thead>
        <tbody>
        @foreach($data as $v)
            <tr>
                <td width="5%" class="text-center">{{ $loop->index + 1 }}</td>
                <td>{{ $v->kategori->nama }}</td>
                <td>{{ $v->nama }}</td>
                <td>{{ $v->qty }}</td>
                <td>{{ $v->deskripsi }}</td>
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
