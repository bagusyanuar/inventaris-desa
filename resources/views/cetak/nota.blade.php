@extends('cetak.index')

@section('content')
    <div class="text-center f-bold report-title">TANDA BUKTI PENYEWAAN INVENTARIS DESA</div>
    <hr>
    <div class="row">
        <div class="col-xs-2 f-bold">No. Transaksi</div>
        <div class="col-xs-3 f-bold">: {{ $data->no_peminjaman }}</div>
        <div class="col-xs-2">Tanggal Pinjam</div>
        <div class="col-xs-3">: {{ $data->tanggal_pinjam }}</div>
    </div>
    <div class="row">
        <div class="col-xs-2 f-bold">Nama Peminjam</div>
        <div class="col-xs-3 f-bold">: {{ $data->nama }}</div>
        <div class="col-xs-2">Tanggal Kembali</div>
        <div class="col-xs-3">: {{ $data->tanggal_kembali }}</div>
    </div>
    <hr>
    <br>
    <table id="my-table" class="table display">
        <thead>
        <tr>
            <th width="5%" class="text-center">#</th>
            <th>Nama Barang</th>
            <th width="15%">Qty</th>
        </tr>
        </thead>
        <tbody>
        @foreach($data->detail as $v)
            <tr>
                <td class="text-center">{{ $loop->index + 1 }}</td>
                <td>{{ $v->barang->nama }}</td>
                <td>{{ $v->qty }}</td>
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
                <p class="text-center">Peminjam</p>
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
                <p class="text-center">({{ $data->nama }})</p>
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
