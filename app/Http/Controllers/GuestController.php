<?php

namespace App\Http\Controllers;

use App\Models\GuestPage;
use App\Models\NomorSurat;
use App\Models\PengajuanKendaraanDinas;
use App\Models\PengajuanRapatKonsumsi;
use App\Models\PengajuanSPPD;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Yajra\DataTables\DataTables;

class GuestController extends Controller
{
    protected $units;
    protected $pages;
    
    protected function getUnits()
    {
        if ($this->units === null) {
            $this->units = Unit::all();
        }
        return $this->units;
    }
    
    public function __construct()
    {
        // Lazy load units only when needed via getUnits()
    }
    public function index()
    {
        return view('guest.index');
    }
    public function siaran_pers_page($slug)
    {
        $post = GuestPage::where('slug', $slug)->where('active', '1')->firstOrFail();
        $popular = GuestPage::where('active', '1')->latest()->limit(3)->get(['id', 'thumbnail', 'slug', 'title', 'active', 'created_at']);

        return view('guest.siaran_pers-detail', compact('popular', 'post'));
    }

    public function berita()
    {
        $data = GuestPage::where('active', '1')->select('id', 'thumbnail', 'slug', 'title', 'active', 'created_at')->paginate(12);
        return view('guest.berita', compact('data'));
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
        $query = PengajuanSPPD::with('pegawai', 'kota_tujuan', 'kota_asal'); // Assuming you want to join with pegawai
        return DataTables::of($query)
            ->make(true);
    }
    public function datatable_pengajuan_kendaraan_dinas(Request $request)
    {
        $query = PengajuanKendaraanDinas::with('pegawai', 'driver', 'kendaraan'); // Assuming you want to join with pegawai
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
    public function unit_get($unit)
    {
        $unit = Unit::where('nama', $unit)->firstOrFail();
        if ($unit->page_unit == null)
            return abort(404);
        return view('guest.unit', compact('unit'));
    }
    public function login()
    {
        if (!auth()->user())
            return view('guest.login');
        if (auth()->user() && auth()->user()->is_admin)
            return redirect()->to('/admin');
        if (auth()->user() && !auth()->user()->is_admin)
            return redirect()->to('/pegawai');
        return view('guest.login'); // Fallback
    }
    public function login_proses(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $credentials = [
            'username' => $request->input('username'),
            'password' => $request->input('password'),
        ];

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Redirect to intended or a specific page after login
            return redirect()->intended('/admin');
        }

        return back()->withErrors([
            'login' => 'The provided credentials do not match our records.',
        ]);
    }

    public function siaran_pers()
    {
        $slides = GuestPage::where('active', '1')->latest()->limit(3)->get(['id', 'thumbnail', 'slug', 'title', 'active', 'created_at']);
        $popular = GuestPage::where('active', '1')->latest()->limit(3)->offset(3)->get(['id', 'thumbnail', 'slug', 'title', 'active', 'created_at']);
        $data = GuestPage::where('active', '1')->select('id', 'thumbnail', 'slug', 'title', 'active', 'created_at')->paginate(12);
        return view('guest.siaran_pers', compact('data', 'slides', 'popular'));
    }
}
