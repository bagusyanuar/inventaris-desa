<?php


namespace App\Http\Controllers\Admin;


use App\Helper\CustomController;
use App\Models\Kategori;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class KategoriController extends CustomController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data = Kategori::all();
        return view('admin.kategori.index')->with(['data' => $data]);
    }

    public function add_page()
    {
        return view('admin.kategori.add');
    }

    public function create()
    {
        try {
            $data = [
                'nama' => $this->postField('nama'),
            ];
            Kategori::create($data);
            return redirect()->back()->with(['success' => 'Berhasil Menambahkan Data...']);
        } catch (\Exception $e) {
            return redirect()->back()->with(['failed' => 'Terjadi Kesalahan ' . $e->getMessage()]);
        }
    }

    public function edit_page($id)
    {
        $data = Kategori::findOrFail($id);
        return view('admin.kategori.edit')->with(['data' => $data]);
    }

    public function patch()
    {
        try {
            $id = $this->postField('id');
            $kategori = Kategori::find($id);
            $data = [
                'nama' => $this->postField('nama'),
            ];
            $kategori->update($data);
            return redirect('/kategori')->with(['success' => 'Berhasil Merubah Data...']);
        }catch (\Exception $e) {
            return redirect()->back()->with(['failed' => 'Terjadi Kesalahan' . $e->getMessage()]);
        }
    }

    public function destroy()
    {
        try {
            $id = $this->postField('id');
            Kategori::destroy($id);
            return $this->jsonResponse('success', 200);
        }catch (\Exception $e) {
            return $this->jsonResponse('failed', 500);
        }
    }
}
