@extends('admin.layout')

@section('css')
@endsection

@section('content')
    @if (\Illuminate\Support\Facades\Session::has('success'))
        <script>
            Swal.fire("Berhasil!", '{{\Illuminate\Support\Facades\Session::get('success')}}', "success")
        </script>
    @endif
    <div class="d-flex justify-content-between align-items-center">
        <h4 class="mb-0">Halaman Detail Pengembalian</h4>
        <ol class="breadcrumb breadcrumb-transparent mb-0">
            <li class="breadcrumb-item">
                <a href="/">Dashboard</a>
            </li>
            <li class="breadcrumb-item">
                <a href="/pengembalian">Pengembalian</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Detail
            </li>
        </ol>
    </div>
    <div class="w-100 p-2 mt-3">
        <div class="row">
            <div class="col-lg-6 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <p class="font-weight-bold">Detail Peminjaman</p>
                        <div class="d-flex align-items-center mb-2">
                            <span class="w-50 font-weight-bold">Nama Peminjam</span>
                            <span class="w-50  font-weight-bold">: {{ $data->peminjaman->nama }}</span>
                        </div>
                        <div class="d-flex align-items-center mb-2">
                            <span class="w-50 font-weight-bold">No. Peminjaman</span>
                            <span class="w-50  font-weight-bold">: {{ $data->peminjaman->no_peminjaman }}</span>
                        </div>
                        <div class="d-flex align-items-center mb-2">
                            <span class="w-50 font-weight-bold">Tanggal Pinjam</span>
                            <span class="w-50  font-weight-bold">: {{ $data->peminjaman->tanggal_pinjam }}</span>
                        </div>
                        <div class="d-flex align-items-center mb-2">
                            <span class="w-50 font-weight-bold">Tanggal Kembali</span>
                            <span class="w-50  font-weight-bold">: {{ $data->peminjaman->tanggal_kembali }}</span>
                        </div>
                        <div class="d-flex align-items-center mb-2">
                            <span class="w-50 font-weight-bold">Keterangan</span>
                            <span class="w-50  font-weight-bold">: {{ $data->peminjaman->keterangan }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <p class="font-weight-bold">Detail Pengembalian</p>
                        <div class="d-flex align-items-center mb-2">
                            <span class="w-50 font-weight-bold">Tanggal Di Kembalikan</span>
                            <span class="w-50  font-weight-bold">: {{ $data->tanggal }}</span>
                        </div>
                        <div class="d-flex align-items-center mb-2">
                            <span class="w-50 font-weight-bold">Keterangan</span>
                            <span class="w-50  font-weight-bold">: {{ $data->keterangan }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <table id="table-data" class="display w-100 table table-bordered">
            <thead>
            <tr>
                <th width="5%" class="text-center">#</th>
                <th>Nama Barang</th>
                <th width="15%" class="text-center">Qty</th>
            </tr>
            </thead>
            <tbody>
            @foreach($data->peminjaman->detail as $v)
                <tr>
                    <td width="5%" class="text-center">{{ $loop->index + 1 }}</td>
                    <td>{{ $v->barang->nama }}</td>
                    <td class="text-center">{{ $v->qty}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="text-right mt-3">
            <a href="/pengembalian/cetak/{{ $data->id }}" target="_blank" class="btn btn-success" id="btn-cetak">
                <i class="fa fa-print mr-2"></i>
                <span>Cetak</span>
            </a>
        </div>
    </div>

@endsection

@section('js')
    <script src="{{ asset('/js/helper.js') }}"></script>
    <script type="text/javascript">

        $(document).ready(function () {
            $('#table-data').DataTable();
        });
    </script>
@endsection
