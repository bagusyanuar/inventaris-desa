<?php


namespace App\Http\Controllers\Admin;


use App\Helper\CustomController;
use App\Models\Barang;
use App\Models\Kategori;
use App\Models\Peminjaman;

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
            $data = [
                'kategori_id' => $this->postField('kategori'),
                'nama' => $this->postField('nama'),
                'qty' => $this->postField('qty'),
                'deskripsi' => $this->postField('deskripsi'),
            ];
            Barang::create($data);
            return redirect()->back()->with(['success' => 'Berhasil Menambahkan Data...']);
        } catch (\Exception $e) {
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
        }catch (\Exception $e) {
            return redirect()->back()->with(['failed' => 'Terjadi Kesalahan' . $e->getMessage()]);
        }
    }

    public function destroy()
    {
        try {
            $id = $this->postField('id');
            Barang::destroy($id);
            return $this->jsonResponse('success', 200);
        }catch (\Exception $e) {
            return $this->jsonResponse('failed', 500);
        }
    }
}
