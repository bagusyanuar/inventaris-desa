<?php


namespace App\Http\Controllers\Admin;


use App\Helper\CustomController;
use App\Models\Barang;
use App\Models\Kategori;
use App\Models\Peminjam;
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
        $data = Peminjaman::with('peminjam')->orderBy('id', 'DESC')->get();
        return view('admin.peminjaman.index')->with(['data' => $data]);
    }

    public function add_page()
    {
        $barang = Barang::all();
        $peminjam = Peminjam::all();
        return view('admin.peminjaman.add')->with(['barang' => $barang, 'peminjam' => $peminjam]);
    }

    public function create()
    {
        try {
            DB::beginTransaction();
            $data = [
                'tanggal_pinjam' => $this->postField('tanggal_pinjam'),
                'tanggal_kembali' => $this->postField('tanggal_kembali'),
                'peminjam_id' => $this->postField('peminjam'),
                'keterangan' => $this->postField('keterangan'),
                'status' => 'pinjam',
                'no_peminjaman' => 'TR-' . \date('YmdHis')
            ];
            $peminjaman = Peminjaman::create($data);
            $detail = PeminjamanDetail::with('barang')->whereNull('peminjaman_id')
                ->get();
            foreach ($detail as $v) {
                $v->update([
                    'peminjaman_id' => $peminjaman->id
                ]);
                $qty_pinjam = $v->qty;
                $qty_barang = $v->barang->qty;
                if ($qty_barang < $qty_pinjam) {
                    DB::rollBack();
                    return redirect()->back()->with(['failed' => 'Stok Barang ' . $v->barang->nama . ' Kurang']);
                }
                $qty = $qty_barang - $qty_pinjam;
                $v->barang()->update([
                    'qty' => $qty
                ]);
            }
            DB::commit();
            return redirect()->back()->with(['success' => 'Berhasil Menambahkan Data...']);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with(['failed' => 'Terjadi Kesalahan ' . $e->getMessage()]);
        }
    }

    public function detail_page($id)
    {
        $data = Peminjaman::with(['detail.barang', 'peminjam'])->findOrFail($id);
        return view('admin.peminjaman.detail')->with(['data' => $data]);
    }

    public function cetak($id)
    {
        $data = Peminjaman::with(['detail.barang', 'peminjam'])->findOrFail($id);
        return $this->convertToPdf('cetak.nota', ['data' => $data]);
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
            $qty = (int)$this->postField('qty');
            $data = [
                'peminjaman_id' => null,
                'barang_id' => $this->postField('barang'),
                'qty' => $qty
            ];

            $barang = Barang::find($this->postField('barang'));
            if ($barang->qty < $qty) {
                return $this->jsonResponse('Persediaan Barang Kurang', 202);
            }
            PeminjamanDetail::create($data);
            return $this->jsonResponse('success', 200);
        } catch (\Exception $e) {
            return $this->jsonFailedResponse('success');
        }
    }

    public function destroy_detail() {
        try {
            $id = $this->postField('id');
            PeminjamanDetail::destroy($id);
            return $this->jsonResponse('success', 200);
        }catch (\Exception $e) {
            return $this->jsonResponse('failed', 500);
        }
    }
}
