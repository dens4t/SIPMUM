<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GuestController extends Controller
{
    public function index(){
        return view('guest.index');
    }
    public function permohonan(){
        return view('guest.permohonan');
    }
    public function penghargaan(){
        return view('guest.penghargaan');
    }
    public function tentang_kami(){
        return view('guest.tentang_kami');
    }
    public function struktur_organisasi(){
        return view('guest.struktur_organisasi');
    }
    public function budaya_perusahaan(){
        return view('guest.budaya_perusahaan');
    }
    public function sertifikasi(){
        return view('guest.sertifikasi');
    }
    public function unit(){
        return view('guest.unit');
    }

    public function siaran_pers(){
        return view('guest.siaran_pers');
    }
}
