<?php


namespace App\Http\Controllers\Admin;


use App\Helper\CustomController;
use App\Models\Barang;
use App\Models\Peminjaman;
use App\Models\PeminjamanDetail;
use App\Models\Pengembalian;
use Illuminate\Support\Facades\DB;

class PengembalianController extends CustomController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data = Pengembalian::with('peminjaman')->orderBy('id', 'DESC')->get();
        return view('admin.pengembalian.index')->with(['data' => $data]);
    }

    public function add_page()
    {
        $peminjaman = Peminjaman::where('status', '=', 'pinjam')->get();
        return view('admin.pengembalian.add')->with(['peminjaman' => $peminjaman]);
    }

    public function create()
    {
        try {
            DB::beginTransaction();
            $peminjaman_id = $this->postField('peminjaman');
            $peminjaman = Peminjaman::with('detail.barang')->where('id', $peminjaman_id)->first();
            $peminjaman->update([
                'status' => 'kembali'
            ]);

            foreach ($peminjaman->detail as $v) {
                $qty_pinjam = $v->qty;
                $qty_barang = $v->barang->qty;
                $qty = $qty_barang + $qty_pinjam;
                $v->barang()->update([
                    'qty' => $qty
                ]);
            }
            $data = [
                'peminjaman_id' => $peminjaman->id,
                'keterangan' => $this->postField('keterangan'),
                'tanggal' => date('Y-m-d')
            ];
            Pengembalian::create($data);
            DB::commit();
            return redirect()->back()->with(['success' => 'Berhasil Menambahkan Data...']);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with(['failed' => 'Terjadi Kesalahan ' . $e->getMessage()]);
        }
    }

    public function detail_page($id)
    {
        $data = Pengembalian::with(['peminjaman.detail.barang'])->findOrFail($id);
        return view('admin.pengembalian.detail')->with(['data' => $data]);
    }

    public function cetak($id)
    {
        $data = Pengembalian::with(['peminjaman.detail.barang'])->findOrFail($id);
        return $this->convertToPdf('cetak.nota-pengembalian', ['data' => $data]);
    }
}
