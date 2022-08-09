<?php


namespace App\Http\Controllers\Admin;


use App\Helper\CustomController;
use App\Models\Barang;
use App\Models\Peminjaman;
use App\Models\PeminjamanDetail;
use App\Models\Pengembalian;

class LaporanController extends CustomController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function peminjaman_page()
    {
        return view('admin.laporan.peminjaman.index');
    }

    public function peminjaman_data()
    {
        try {
            $tgl1 = $this->field('tgl1');
            $tgl2 = $this->field('tgl2');
            $data = Peminjaman::with(['detail', 'peminjam'])
                ->whereBetween('tanggal_pinjam', [$tgl1, $tgl2])
                ->orderBy('id', 'DESC')->get();
            return $this->basicDataTables($data);
        } catch (\Exception $e) {
            return $this->basicDataTables([]);
        }
    }

    public function peminjaman_cetak()
    {
        $tgl1 = $this->field('tgl1');
        $tgl2 = $this->field('tgl2');
        $data = Peminjaman::with(['detail', 'peminjam'])
            ->whereBetween('tanggal_pinjam', [$tgl1, $tgl2])
            ->orderBy('id', 'DESC')->get();
        return $this->convertToPdf('admin.laporan.peminjaman.cetak', [
            'tgl1' => $tgl1,
            'tgl2' => $tgl2,
            'data' => $data,
        ]);
    }

    public function pengembalian_page()
    {
        return view('admin.laporan.pengembalian.index');
    }

    public function pengembalian_data()
    {
        try {
            $tgl1 = $this->field('tgl1');
            $tgl2 = $this->field('tgl2');
            $data = Pengembalian::with('peminjaman')
                ->whereBetween('tanggal', [$tgl1, $tgl2])
                ->orderBy('id', 'DESC')->get();
            return $this->basicDataTables($data);
        } catch (\Exception $e) {
            return $this->basicDataTables([]);
        }
    }

    public function pengembalian_cetak()
    {
        $tgl1 = $this->field('tgl1');
        $tgl2 = $this->field('tgl2');
        $data = Pengembalian::with('peminjaman')
            ->whereBetween('tanggal', [$tgl1, $tgl2])
            ->orderBy('id', 'DESC')->get();
        return $this->convertToPdf('admin.laporan.pengembalian.cetak', [
            'tgl1' => $tgl1,
            'tgl2' => $tgl2,
            'data' => $data,
        ]);
    }

    public function barang_page()
    {
        return view('admin.laporan.barang.index');
    }

    public function barang_data()
    {
        try {
            $data = Barang::with('kategori')->get();
            return $this->basicDataTables($data);
        } catch (\Exception $e) {
            return $this->basicDataTables([]);
        }
    }

    public function barang_cetak()
    {
        $data = Barang::with('kategori')->get();
        return $this->convertToPdf('admin.laporan.barang.cetak', [
            'data' => $data,
        ]);
    }

    public function barang_dipinjam_page()
    {
        return view('admin.laporan.barang-dipinjam.index');
    }

    public function barang_dipinjam_data()
    {
        try {
            $data = PeminjamanDetail::with(['peminjaman.peminjam', 'barang'])
                ->whereHas('peminjaman', function ($q) {
                    return $q->where('status', '=', 'pinjam');
                })
                ->orderBy('id', 'DESC')->get();
            return $this->basicDataTables($data);
        } catch (\Exception $e) {
            return $this->basicDataTables([]);
        }
    }

    public function barang_dipinjam_cetak()
    {
        $data = PeminjamanDetail::with(['peminjaman.peminjam', 'barang'])
            ->whereHas('peminjaman', function ($q) {
                return $q->where('status', '=', 'pinjam');
            })
            ->orderBy('id', 'DESC')->get();
        return $this->convertToPdf('admin.laporan.barang-dipinjam.cetak', [
            'data' => $data,
        ]);
    }
}
