@extends('guest.partials.main')
@section('header')
<!-- Masthead-->
<style>
    .carousel-item img {
        width: 2114px;
        /* Set consistent width */
        height: auto;
        /* Maintain aspect ratio */
    }
</style>
<div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="./assets/img/UP-Kapuas.png" class="d-block w-100" alt="...">
            <div class="carousel-caption d-none d-md-block" style="color: white; padding: 1rem; left: 10%; top: 50%; transform: translateY(-50%); text-align: left; width: auto;">
                <h1 style="font-size: 2.5rem;">Selamat datang di My PMUM Kapuas</h1>
                <p style="font-size: 1.25rem;">Membangun Masa Depan Bersama Listrik yang Handal dan Berkelanjutan</p>
            </div>
        </div>
        <div class="carousel-item">
            <img src="{{ url('storage/'.'thumbnail/pltd-siantan.jpg') }}" class="d-block w-100" alt="...">
            <div class="carousel-caption d-none d-md-block" style="color: white; padding: 1rem; left: 10%; top: 50%; transform: translateY(-50%); text-align: left; width: auto;">
                <h1 style="font-size: 2.5rem;">PLTD Siantan</h1>
            </div>
        </div>
        <div class="carousel-item">
            <img src="{{ url('storage/'.'thumbnail/pltd-teluk-malino.jpg') }}" class="d-block w-100" alt="...">
            <div class="carousel-caption d-none d-md-block" style="color: white; padding: 1rem; left: 10%; top: 50%; transform: translateY(-50%); text-align: left; width: auto;">
                <h1 style="font-size: 2.5rem;">PLTD Teluk Malino</h1>
            </div>
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>
<!-- jadwal-->
@endsection
@section('container')
<!-- Services-->
<section class="page-section" id="services">
    <div class="container px-4 px-lg-5">
        <h2 class="text-center mt-0" data-aos="fade-up">Layanan</h2>
        <hr class="divider" />
        <div class="row gx-4 gx-lg-5" data-aos="flip-left">
            <div class="col-lg-3 col-md-6 text-center">
                <div class="mt-5">
                    <div class="mb-2"><i class="bi-list fs-1 text-primary"></i></div>
                    <h3 class="h4 mb-2">Pengajuan Kegiatan</h3>
                    <!-- <p class="text-muted mb-0">Our themes are updated regularly to keep them bug free!</p> -->
                </div>
            </div>
            <div class="col-lg-3 col-md-6 text-center">
                <div class="mt-5">
                    <div class="mb-2"><i class="bi-envelope fs-1 text-primary"></i></div>
                    <h3 class="h4 mb-2">Permohonan Nomor Surat</h3>
                    <!-- <p class="text-muted mb-0">Our themes are updated regularly to keep them bug free!</p> -->
                </div>
            </div>
            <div class="col-lg-3 col-md-6 text-center">
                <div class="mt-5">
                    <div class="mb-2"><i class="bi-arrow-repeat fs-1 text-primary"></i></div>
                    <h3 class="h4 mb-2">Pengajuan SPPD</h3>
                    <!-- <p class="text-muted mb-0">All dependencies are kept current to keep things fresh.</p> -->
                </div>
            </div>
            <div class="col-lg-3 col-md-6 text-center">
                <div class="mt-5">
                    <div class="mb-2"><i class="bi-people fs-1 text-primary"></i></div>
                    <h3 class="h4 mb-2">Permohonan Kendaraan Dinas</h3>
                    <!-- <p class="text-muted mb-0">You can use this design as is, or you can make changes!</p> -->
                </div>
            </div>
            <div class="col-lg-3 col-md-6 text-center mx-auto">
                <div class="mt-5">
                    <div class="mb-2"><i class="bi-people-fill fs-1 text-primary"></i></div>
                    <h3 class="h4 mb-2">Permohonan Rapat dan Konsumsi Rapat</h3>
                    <!-- <p class="text-muted mb-0">Is it really open source if it's not made with love?</p> -->
                </div>
            </div>
        </div>
    </div>
</section>
<section class="page-section" data-aos="fade-up" style="background-image:none;background-color:white;">
    <div class="row justify-content-center">
        <div class="col-lg-4 px-lg-5">
            <p>Sehubungan dengan Keputusan Direksi PT PLN Nusantara Power di Luar Rapat Direksi (Sirkuler) Nomor 046/DIR/2023 tanggal 27 November 2023 tentang Perubahan Organisasi Unit PT PLN Nusantara Power Tahun 2023. Berdasarkan surat Legal dan Manajemen Human Capital PT PLN (Persero) Nomor 0030/ORG.00.02/F01080000/2024-R tanggal 2 Januari 2024 tentang Persetujuan Perubahan Struktur Organisasi dan Position Grade Unit Pembangkitan PT PLN Nusantara Power.</p>
        </div>
        <div class="col-lg-2">
            <div class="row ">
                <div class="col-lg-12">
                    <h4> <i class="bi bi-geo-alt-fill"></i> Alamat</h4>
                    <p class="text-muted">Jl. Adi Sucipto No.2, Sungai Raya, Kec. Sungai Raya, Kabupaten Kubu Raya, Kalimantan Barat 78117</p>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <h4><i class="bi bi-stopwatch-fill"></i> Jam Kerja</h4>
                    <p>Senin s/d Jumat<br>
                        <span class="text-muted"> 07:30 sd 16:00 WIB</span>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-lg-2">
            <h4><i class="bi bi-person-lines-fill"></i> Kontak</h4>
            <p><i class="bi bi-telephone-fill"></i> Phone<br>
                <span class="text-muted">(0561) 723472 ext. 723449</span>
            </p>
            <p><i class="bi bi-envelope-fill"></i> Email<br>
                <span class="text-muted">lorem@mail.com</span>
            </p>
        </div>
        <div class="col-lg-2">
            <h4><i class="bi bi-pin-map"></i>Kantor Pusat</h4>
            <h4>PT PLN Nusantara Power Kantor Pusat</h4>
            <p class="text-muted">Jl. Ketintang Baru No. 11,
                Surabaya, Indonesia</p>
            <h4>Kantor Strategis</h4>
            <p class="text-muted">PT PLN Nusantara Power Office Strategis, 18 Office Park, Lt.2 ABCD
                Jl. TB Simatupang No.18 Jakarta Selatan, DKI Jakarta Indonesia</p>
        </div>
    </div>
</section>

@endsection
