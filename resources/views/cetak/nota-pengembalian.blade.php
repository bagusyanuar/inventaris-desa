@extends('cetak.index')

@section('content')
    <div class="text-center f-bold report-title">TANDA BUKTI PENGEMBALAN INVENTARIS DESA</div>
    <hr>
    <div class="row">
        <div class="col-xs-2 f-bold">No. Transaksi</div>
        <div class="col-xs-3 f-bold">: {{ $data->peminjaman->no_peminjaman }}</div>
        <div class="col-xs-2">Tanggal Di Kembalikan</div>
        <div class="col-xs-3">: {{ $data->tanggal }}</div>
    </div>
    <div class="row">
        <div class="col-xs-2 f-bold">Nama Peminjam</div>
        <div class="col-xs-3 f-bold">: {{ $data->peminjaman->nama }}</div>
        <div class="col-xs-2">Keterangan</div>
        <div class="col-xs-3">: {{ $data->keterangan }}</div>
    </div>
    <div class="row">
        <div class="col-xs-2 f-bold">Tanggal Pinjam</div>
        <div class="col-xs-3 f-bold">: {{ $data->peminjaman->tanggal_pinjam }}</div>
        <div class="col-xs-2"></div>
        <div class="col-xs-3"></div>
    </div>
    <div class="row">
        <div class="col-xs-2 f-bold">Tanggal Kembali</div>
        <div class="col-xs-3 f-bold">: {{ $data->peminjaman->tanggal_kembali }}</div>
        <div class="col-xs-2"></div>
        <div class="col-xs-3"></div>
    </div>
    <div class="row">
        <div class="col-xs-2 f-bold">Keterangan</div>
        <div class="col-xs-3 f-bold">: {{ $data->peminjaman->keterangan }}</div>
        <div class="col-xs-2"></div>
        <div class="col-xs-3"></div>
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
        @foreach($data->peminjaman->detail as $v)
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
                <p class="text-center">({{ $data->peminjaman->nama }})</p>
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
