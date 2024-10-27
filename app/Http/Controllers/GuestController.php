<?php

namespace App\Http\Controllers;

use App\Models\NomorSurat;
use App\Models\PengajuanKendaraanDinas;
use App\Models\PengajuanRapatKonsumsi;
use App\Models\PengajuanSPPD;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Yajra\DataTables\DataTables;

class GuestController extends Controller
{
    protected $units;
    public function __construct(){
        $this->units = Unit::all();
        View::share('units', $this->units);
    }
    public function index()
    {
        return view('guest.index');
    }
    public function datatable_nomor_surat(Request $request)
    {
        $query = NomorSurat::with('pegawai'); // Assuming you want to join with pegawai
        return DataTables::of($query)
            ->addColumn('action', function ($nomorSurat) {
                return '<button class="btn btn-sm btn-primary edit" data-id="' . $nomorSurat->id . '">Edit</button>
                        <button class="btn btn-sm btn-danger delete" data-id="' . $nomorSurat->id . '">Delete</button>';
            })
            ->make(true);
    }

    public function datatable_pengajuan_sppd(Request $request)
    {
        $query = PengajuanSPPD::with('pegawai'); // Assuming you want to join with pegawai
        return DataTables::of($query)
            ->make(true);
    }
    public function datatable_pengajuan_kendaraan_dinas(Request $request)
    {
        $query = PengajuanKendaraanDinas::with('pegawai', 'driver','kendaraan'); // Assuming you want to join with pegawai
        return DataTables::of($query)
            ->make(true);
    }
    public function datatable_pengajuan_rapat_konsumsi(Request $request)
    {
        $query = PengajuanRapatKonsumsi::with('pegawai'); // Assuming you want to join with pegawai
        return DataTables::of($query)
            ->make(true);
    }
    public function permohonan()
    {
        return view('guest.permohonan');
    }
    public function kontak()
    {
        return view('guest.kontak');
    }
    public function penghargaan()
    {
        return view('guest.penghargaan');
    }
    public function tentang_kami()
    {
        return view('guest.tentang_kami');
    }
    public function struktur_organisasi()
    {
        return view('guest.struktur_organisasi');
    }
    public function budaya_perusahaan()
    {
        return view('guest.budaya_perusahaan');
    }
    public function sertifikasi()
    {
        return view('guest.sertifikasi');
    }
    public function unit()
    {
        return view('guest.unit');
    }

    public function siaran_pers()
    {
        return view('guest.siaran_pers');
    }
}
