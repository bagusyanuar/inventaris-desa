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
            <p class="font-weight-bold mb-0" style="font-size: 20px">Halaman Peminjaman Barang</p>
            <ol class="breadcrumb breadcrumb-transparent mb-0">
                <li class="breadcrumb-item">
                    <a href="/dashboard">Dashboard</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Peminjaman Barang
                </li>
            </ol>
        </div>
        <div class="w-100 p-2">
            <div class="text-right mb-2 pr-3">
                <a href="/peminjaman/tambah" class="btn btn-primary"><i class="fa fa-plus mr-1"></i><span
                        class="font-weight-bold">Tambah</span></a>
            </div>
            <table id="table-data" class="display w-100 table table-bordered">
                <thead>
                <tr>
                    <th width="5%" class="text-center">#</th>
                    <th width="10%">No. Peminjaman</th>
                    <th width="20%">Nama</th>
                    <th>Tanggal Pinjam</th>
                    <th>Tanggal Kembali</th>
                    <th>Status</th>
                    <th width="12%" class="text-center">Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($data as $v)
                    <tr>
                        <td width="5%" class="text-center">{{ $loop->index + 1 }}</td>
                        <td>{{ $v->no_peminjaman }}</td>
                        <td>{{ $v->peminjam->nama }}</td>
                        <td>{{ $v->tanggal_pinjam }}</td>
                        <td>{{ $v->tanggal_kembali }}</td>
                        <td>{{ $v->status }}</td>
                        <td class="text-center">
                            <a href="/peminjaman/detail/{{ $v->id }}" class="btn btn-sm btn-info btn-detail"
                               data-id="{{ $v->id }}"><i class="fa fa-info"></i></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection

@section('js')
    <script src="{{ asset('/js/helper.js') }}"></script>
    <script type="text/javascript">
        function destroy(id) {
            AjaxPost('/barang/delete', {id}, function () {
                window.location.reload();
            });
        }
        $(document).ready(function () {
            $('#table-data').DataTable();
            $('.btn-delete').on('click', function (e) {
                e.preventDefault();
                let id = this.dataset.id;
                AlertConfirm('Yakin Ingin Menghapus?', 'Data yang sudah dihapus tidak dapat dikembalikan', function () {
                    destroy(id);
                })
            });
        });
    </script>
@endsection
