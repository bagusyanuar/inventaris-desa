@extends('admin.layout')

@section('css')
@endsection

@section('content')
    @if (\Illuminate\Support\Facades\Session::has('success'))
        <script>
            Swal.fire("Berhasil!", '{{\Illuminate\Support\Facades\Session::get('success')}}', "success")
        </script>
    @endif

    @if (\Illuminate\Support\Facades\Session::has('failed'))
        <script>
            Swal.fire("Gagal", '{{\Illuminate\Support\Facades\Session::get('failed')}}', "error")
        </script>
    @endif
    <div class="container-fluid pt-3">
        <div class="d-flex align-items-center justify-content-between mb-3">
            <p class="font-weight-bold mb-0" style="font-size: 20px">Halaman Pengembalian Barang</p>
            <ol class="breadcrumb breadcrumb-transparent mb-0">
                <li class="breadcrumb-item">
                    <a href="/dashboard">Dashboard</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="/pengembalian">Pengembalian Barang</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Tambah
                </li>
            </ol>
        </div>
        <div class="w-100 p-2">
            <div class="card">
                <div class="card-body">
                    <form method="post" action="/pengembalian/create" >
                        @csrf
                        <div class="form-group w-100 mb-1">
                            <label for="peminjaman">No. Peminjaman</label>
                            <select class="form-control" id="peminjaman" name="peminjaman">
                                @foreach($peminjaman as $v)
                                    <option value="{{ $v->id }}">{{ $v->no_peminjaman }} ({{$v->peminjam->nama}})</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="w-100 mb-1">
                            <label for="keterangan" class="form-label">Keterangan</label>
                            <textarea rows="3" class="form-control" id="keterangan" placeholder="Keterangan"
                                      name="keterangan"></textarea>
                        </div>
                        <div class="w-100 mb-2 mt-2 text-right">
                            <button type="submit" class="btn btn-success"><i
                                    class="fa fa-save mr-2"></i>Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
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
            table = DataTableGenerator('#table-data', '/peminjaman/list', [
                {data: 'DT_RowIndex', name: 'DT_RowIndex', searchable: false, orderable: false},
                {data: 'barang.nama'},
                {data: 'qty'},
                {
                    data: null, render: function (data, type, row, meta) {
                        return '<a href="#" class="btn btn-danger btn-delete-list" data-id="' + data['id'] + '"><i class="fa fa-trash"></i></a>';
                    }
                },
            ], [], function (d) {
            }, {
                dom: 'ltipr',
                "fnDrawCallback": function (oSettings) {
                    $('.btn-delete-list').on('click', function (e) {
                        e.preventDefault();
                        let id = this.dataset.id;
                        AlertConfirm('Apakah anda yakin menghapus?', 'Data yang dihapus tidak dapat dikembalikan!', function () {
                            destroy(id);
                        });
                    })
                }
            });

            $('#btn-append').on('click', function (e) {
                e.preventDefault();
                AjaxPost('/peminjaman/append-list', {
                    barang: $('#barang').val(),
                    qty: $('#qty').val(),
                }, function () {
                    $('#qty').val(0);
                    SuccessAlert('Berhasil', 'Berhasil Menambahkan Data');
                    reload();
                })
            });
            $('.btn-delete').on('click', function (e) {
                e.preventDefault();
                let id = this.dataset.id;
                AlertConfirm('Yakin Ingin Menghapus?', 'Data yang sudah dihapus tidak dapat dikembalikan', function () {
                })
            });
        });
    </script>
@endsection
