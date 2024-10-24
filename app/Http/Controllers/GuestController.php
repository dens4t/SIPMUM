<?php

namespace App\Http\Controllers;

use App\Models\NomorSurat;
use Illuminate\Http\Request;
use DataTables;

class GuestController extends Controller
{
    public function index()
    {
        return view('guest.index');
    }
    public function datatable_nomor_surat(Request $request)
    {
        $data = NomorSurat::latest()->get();
        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $actionBtn = '<button onclick="edit(event)" class="edit btn btn-success btn-sm"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-edit" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"></path>
                <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z"></path>
                <path d="M16 5l3 3"></path>
             </svg>Edit</button>
                            <button onclick="destroy(event)" class="delete btn btn-danger btn-sm"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <line x1="4" y1="7" x2="20" y2="7"></line>
                            <line x1="10" y1="11" x2="10" y2="17"></line>
                            <line x1="14" y1="11" x2="14" y2="17"></line>
                            <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"></path>
                            <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path>
                         </svg>Delete</button>
                            <button onclick="cekJabatan(event)" class="cekjabatan btn btn-primary btn-sm"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-briefcase" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <rect x="3" y="7" width="18" height="13" rx="2"></rect>
                            <path d="M8 7v-2a2 2 0 0 1 2 -2h4a2 2 0 0 1 2 2v2"></path>
                            <line x1="12" y1="12" x2="12" y2="12.01"></line>
                            <path d="M3 13a20 20 0 0 0 18 0"></path>
                         </svg>Jabatan</button>';
                return $actionBtn;
            })
            ->rawColumns(['action', 'aktif'])
            ->setRowId('id')
            ->make(true);
    }
    public function permohonan()
    {
        return view('guest.permohonan');
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
