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
            <p class="font-weight-bold mb-0" style="font-size: 20px">Halaman Barang</p>
            <ol class="breadcrumb breadcrumb-transparent mb-0">
                <li class="breadcrumb-item">
                    <a href="/dashboard">Dashboard</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="/barang">Barang</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Edit
                </li>
            </ol>
        </div>
        <div class="w-100 p-2">
            <div class="row justify-content-center">
                <div class="col-lg-5 col-md-6 col-sm-11">
                    <div class="card">
                        <div class="card-body">
                            <form method="post" action="/barang/patch" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id" value="{{ $data->id }}">
                                <div class="form-group w-100 mb-1">
                                    <label for="kategori">Kategori</label>
                                    <select class="form-control" id="kategori" name="kategori">
                                        @foreach($kategori as $v)
                                            <option
                                                value="{{ $v->id }}" {{ $data->kategori_id == $v->id ? 'selected' : '' }}>{{ $v->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="w-100 mb-1">
                                    <label for="nama" class="form-label">Nama</label>
                                    <input type="text" class="form-control" id="nama" placeholder="Nama"
                                           name="nama" value="{{ $data->nama }}">
                                </div>
                                <div class="w-100 mb-1">
                                    <label for="qty" class="form-label">Qty</label>
                                    <input type="number" class="form-control" id="qty" placeholder="Qty"
                                           name="qty" value="{{ $data->qty }}">
                                </div>
                                <div class="w-100 mb-1">
                                    <label for="deskripsi" class="form-label">Deskripsi</label>
                                    <textarea rows="3" class="form-control" id="deskripsi" placeholder="Deskripsi"
                                              name="deskripsi">{{ $data->deskripsi }}</textarea>
                                </div>
                                <div class="w-100 mb-1 {{ $data->gambar === null ? 'd-none' : '' }}" id="panel-gambar">
                                    <label for="gambar" class="form-label d-block">Gambar Barang</label>
                                    <div class="d-flex align-items-end justify-content-between">
                                        @if($data->gambar != null)
                                            <a target="_blank"
                                               href="{{ asset('assets/barang') .'/'. $data->gambar }}">
                                                <img
                                                    class="mr-2"
                                                    src="{{ asset('assets/barang') .'/'. $data->gambar }}"
                                                    alt="Gambar Barang"
                                                    style="width: 100px; height: 100px; object-fit: cover"/>
                                            </a>
                                        @else
                                            <span class="mr-2">Belum Ada Gambar</span>
                                        @endif
                                        <a href="#" class="btn-ganti" id="btn-ganti">Ganti</a>
                                    </div>
                                </div>
                                <div class="w-100 mb-1 {{ $data->gambar === null ? '' : 'd-none' }}"
                                     id="panel-input-gambar">
                                    <label for="gambar" class="form-label">Gambar Menu</label>
                                    <input type="file" class="form-control" id="gambar" placeholder="Gambar Menu"
                                           name="gambar">
                                    <a href="#" class="btn-batal" id="btn-batal">Batal</a>
                                </div>
                                <div class="w-100 mb-2 mt-3 text-right">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script type="text/javascript">
        $(document).ready(function () {
            $('#btn-ganti').on('click', function (e) {
                e.preventDefault();
                $('#panel-gambar').addClass('d-none');
                $('#panel-input-gambar').removeClass('d-none');
            });
            $('#btn-batal').on('click', function (e) {
                e.preventDefault();
                $('#gambar').val('');
                $('#panel-input-gambar').addClass('d-none');
                $('#panel-gambar').removeClass('d-none');
            })
        });
    </script>
@endsection
