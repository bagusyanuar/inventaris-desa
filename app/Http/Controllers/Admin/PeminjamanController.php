<?php


namespace App\Http\Controllers\Admin;


use App\Helper\CustomController;
use App\Models\Barang;
use App\Models\Kategori;
use App\Models\Peminjaman;
use App\Models\PeminjamanDetail;
use Illuminate\Support\Facades\DB;

class PeminjamanController extends CustomController
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data = Peminjaman::all();
        return view('admin.peminjaman.index')->with(['data' => $data]);
    }

    public function add_page()
    {
        $barang = Barang::all();
        return view('admin.peminjaman.add')->with(['barang' => $barang]);
    }

    public function create()
    {
        try {
            DB::beginTransaction();
            $data = [
                'tanggal_pinjam' => $this->postField('tanggal_pinjam'),
                'tanggal_kembali' => $this->postField('tanggal_kembali'),
                'nama' => $this->postField('nama'),
                'keterangan' => $this->postField('keterangan'),
                'status' => 'pinjam',
                'no_peminjaman' => 'TR-' . \date('YmdHis')
            ];
            $peminjaman = Peminjaman::create($data);
            PeminjamanDetail::with('barang')->whereNull('peminjaman_id')->update([
                'peminjaman_id' => $peminjaman->id
            ]);
            DB::commit();
            return redirect()->back()->with(['success' => 'Berhasil Menambahkan Data...']);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with(['failed' => 'Terjadi Kesalahan ' . $e->getMessage()]);
        }
    }

    public function edit_page($id)
    {
        $kategori = Kategori::all();
        $data = Barang::with('kategori')->findOrFail($id);
        return view('admin.barang.edit')->with(['data' => $data, 'kategori' => $kategori]);
    }

    public function patch()
    {
        try {
            $id = $this->postField('id');
            $barang = Barang::find($id);
            $data = [
                'kategori_id' => $this->postField('kategori'),
                'nama' => $this->postField('nama'),
                'qty' => $this->postField('qty'),
                'deskripsi' => $this->postField('deskripsi'),
            ];
            $barang->update($data);
            return redirect('/barang')->with(['success' => 'Berhasil Merubah Data...']);
        } catch (\Exception $e) {
            return redirect()->back()->with(['failed' => 'Terjadi Kesalahan' . $e->getMessage()]);
        }
    }

    public function destroy()
    {
        try {
            $id = $this->postField('id');
            Barang::destroy($id);
            return $this->jsonResponse('success', 200);
        } catch (\Exception $e) {
            return $this->jsonResponse('failed', 500);
        }
    }

    public function detail_page($id)
    {
        $data = Peminjaman::with(['detail.barang'])->findOrFail($id);
        return view('admin.peminjaman.detail')->with(['data' => $data]);
    }
    public function detail_data()
    {
        try {
            $data = PeminjamanDetail::with('barang')->whereNull('peminjaman_id')->get();
            return $this->basicDataTables($data);
        } catch (\Exception $e) {
            return $this->basicDataTables([]);
        }
    }

    public function append_detail()
    {
        try {
            $data = [
                'peminjaman_id' => null,
                'barang_id' => $this->postField('barang'),
                'qty' => $this->postField('qty')
            ];

            PeminjamanDetail::create($data);
            return $this->jsonResponse('success', 200);
        } catch (\Exception $e) {
            return $this->jsonFailedResponse('success');
        }
    }
}
