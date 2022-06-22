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
            <p class="font-weight-bold mb-0" style="font-size: 20px">Halaman Peminjaman Barang</p>
            <ol class="breadcrumb breadcrumb-transparent mb-0">
                <li class="breadcrumb-item">
                    <a href="/dashboard">Dashboard</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="/peminjaman">Peminjaman Barang</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Tambah
                </li>
            </ol>
        </div>
        <div class="w-100 p-2">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="w-100 mb-1">
                                <label for="nama" class="form-label">Nama Peminjam</label>
                                <input type="text" class="form-control" id="nama" placeholder="Nama"
                                       name="nama">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="w-100 mb-1">
                                <label for="tanggal_pinjam" class="form-label">Tanggal Pinjam</label>
                                <input type="date" class="form-control" id="tanggal_pinjam" placeholder="Nama"
                                       name="tanggal_pinjam" value="{{ date('Y-m-d') }}">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="w-100 mb-1">
                                <label for="tanggal_kembali" class="form-label">Tanggal Kembali</label>
                                <input type="date" class="form-control" id="tanggal_kembali" placeholder="Nama"
                                       name="tanggal_kembali" value="{{ date('Y-m-d') }}">
                            </div>
                        </div>
                    </div>
                    <div class="w-100 mb-1">
                        <label for="keterangan" class="form-label">Keterangan</label>
                        <textarea rows="3" class="form-control" id="keterangan" placeholder="Keterangan"
                                  name="keterangan"></textarea>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <p class="font-weight-bold">Data Peminjaman</p>
                            <form method="post" action="/peminjaman/create">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-9">
                                        <div class="form-group w-100 mb-1">
                                            <label for="barang">Barang</label>
                                            <select class="form-control" id="barang" name="barang">
                                                @foreach($barang as $v)
                                                    <option value="{{ $v->id }}">{{ $v->nama }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="w-100 mb-1">
                                            <label for="qty" class="form-label">Qty</label>
                                            <input type="number" class="form-control" id="qty" placeholder="Qty"
                                                   name="qty" value="0">
                                        </div>
                                    </div>
                                </div>
                                <div class="w-100 mb-2 mt-2 text-right">
                                    <a href="#" class="btn btn-primary"><i class="fa fa-plus mr-2"></i>Tambah</a>
                                </div>
                            </form>

                            <table id="table-data" class="display w-100 table table-bordered">
                                <thead>
                                <tr>
                                    <th width="5%" class="text-center">#</th>
                                    <th>Nama barang</th>
                                    <th width="15%">qty</th>
                                    <th width="12%" class="text-center">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                            <div class="w-100 mb-2 mt-2 text-right">
                                <a href="#" class="btn btn-success"><i class="fa fa-save mr-2"></i>Simpan</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('/js/helper.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#table-data').DataTable();
            $('.btn-delete').on('click', function (e) {
                e.preventDefault();
                let id = this.dataset.id;
                AlertConfirm('Yakin Ingin Menghapus?', 'Data yang sudah dihapus tidak dapat dikembalikan', function () {
                })
            });
        });
    </script>
@endsection
