@extends('admin.layout')

@section('css')
@endsection

@section('content')
    @if (\Illuminate\Support\Facades\Session::has('success'))
        <script>
            Swal.fire("Berhasil!", '{{\Illuminate\Support\Facades\Session::get('success')}}', "success")
        </script>
    @endif
    <div class="container-fluid pt-3">
        <div class="d-flex align-items-center justify-content-between mb-3">
            <p class="font-weight-bold mb-0" style="font-size: 20px">Halaman Laporan Barang Di Pinjam</p>
            <ol class="breadcrumb breadcrumb-transparent mb-0">
                <li class="breadcrumb-item">
                    <a href="/dashboard">Dashboard</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Laporan Barang Di Pinjam
                </li>
            </ol>
        </div>
        <div class="w-100 p-2">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="text-right">
                    <a href="#" class="btn btn-primary" id="btn-cetak">
                        <i class="fa fa-print mr-2"></i>
                        <span>Cetak</span>
                    </a>
                </div>
            </div>

            <table id="table-data" class="display w-100 table table-bordered">
                <thead>
                <tr>
                    <th width="5%" class="text-center">#</th>
                    <th width="10%">Nama Barang</th>
                    <th width="10%">Qty</th>
                    <th width="10%">No. Peminjaman</th>
                    <th width="20%">Nama</th>
                </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>

@endsection

@section('js')
    <script src="{{ asset('/js/helper.js') }}"></script>
    <script type="text/javascript">
        var table;
        function reload() {
            table.ajax.reload();
        }
        $(document).ready(function () {
            table = DataTableGenerator('#table-data', '/laporan-barang-pinjam/data', [
                {data: 'DT_RowIndex', name: 'DT_RowIndex', searchable: false, orderable: false},
                {data: 'barang.nama'},
                {data: 'qty'},
                {data: 'peminjaman.peminjam.nama'},
                {data: 'peminjaman.no_peminjaman'},
            ], [], function (d) {
            }, {
                dom: 'ltipr',
            });
            $('#tgl1').on('change', function (e) {
                reload();
            });
            $('#tgl2').on('change', function (e) {
                reload();
            });
            $('#btn-cetak').on('click', function (e) {
                e.preventDefault();
                window.open('/laporan-barang-pinjam/cetak', '_blank');
            })
        });
    </script>
@endsection
