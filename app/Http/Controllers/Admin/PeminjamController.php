<?php


namespace App\Http\Controllers\Admin;


use App\Helper\CustomController;
use App\Models\Peminjam;

class PeminjamController extends CustomController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data = Peminjam::all();
        return view('admin.peminjam.index')->with(['data' => $data]);
    }

    public function add_page()
    {
        return view('admin.peminjam.add');
    }

    public function create()
    {
        try {
            $data = [
                'nama' => $this->postField('nama'),
                'no_hp' => $this->postField('no_hp'),
                'alamat' => $this->postField('alamat'),
            ];
            Peminjam::create($data);
            return redirect()->back()->with(['success' => 'Berhasil Menambahkan Data...']);
        } catch (\Exception $e) {
            return redirect()->back()->with(['failed' => 'Terjadi Kesalahan ' . $e->getMessage()]);
        }
    }

    public function edit_page($id)
    {
        $data = Peminjam::findOrFail($id);
        return view('admin.peminjam.edit')->with(['data' => $data]);
    }

    public function patch()
    {
        try {
            $id = $this->postField('id');
            $user = Peminjam::find($id);

            $data = [
                'nama' => $this->postField('nama'),
                'no_hp' => $this->postField('no_hp'),
                'alamat' => $this->postField('alamat'),
            ];
            $user->update($data);
            return redirect('/peminjam')->with(['success' => 'Berhasil Merubah Data...']);
        }catch (\Exception $e) {
            return redirect()->back()->with(['failed' => 'Terjadi Kesalahan' . $e->getMessage()]);
        }
    }

    public function destroy()
    {
        try {
            $id = $this->postField('id');
            Peminjam::destroy($id);
            return $this->jsonResponse('success', 200);
        }catch (\Exception $e) {
            return $this->jsonResponse('failed', 500);
        }
    }
}
