<div class="medsos">
    <a href="">
        <div class="ms ms-ig"></div>
    </a>
    <a href="">
        <div class="ms ms-fb"></div>
    </a>
    <a href="">
        <div class="ms ms-tiktok"></div>
    </a>
    <a href="">
        <div class="ms ms-yt"></div>
    </a>
</div>
<section class="top-h" style="background-color: #14a2ba !important;">
    <div class="row justify-content-center p-2">
        <div class="col-lg-4 d-flex justify-content-between align-items-center text-white" style="font-family:Arial, Helvetica, sans-serif; font-size: 12px;">
            <span><i class="bi bi-telephone-fill"></i> 0823482349</span>
            <span><i class="bi bi-envelope-fill"></i> upltg.kapuas@gmail.com </span>
            <span><i class="bi bi-geo-alt-fill"></i> Jl. Khatulistiwa km 2,7.</span>
        </div>
        <div class="col-lg-3 d-flex justify-content-end align-items-center text-white" style="font-family:Arial, Helvetica, sans-serif; font-size: 10px;">
            <form class="d-flex" role="search">
                <input class="me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="myBtn" type="submit"><i class="bi bi-search"></i></button>
            </form>
            <a class="nav-link ms-3 myBtna" href="{{ url('admin') }}">Login</a>
        </div>
    </div>
</section>
<nav class="navbar mt-1 navbar-expand-lg navbar-light sticky-top bg-white" id="mainNav">
    <div class="container px-4 px-lg-5">
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav my-lg-0">
                <li class="nav-item"><a class="nav-link" href="{{ url('') }}">Beranda</a></li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Profil
                    </a>
                    <ul class="dropdown-menu animate slideIn" style="border: 0 !important; border-radius: 0; font-family:Arial, Helvetica, sans-serif;" data-aos="fade-down">
                        <li><a class="dropdown-item fw-bolder text-muted" href="{{ url('tentang-kami') }}">Tentang Kami</a></li>
                        <li><a class="dropdown-item fw-bolder text-muted" href="{{ url('struktur-organisasi') }}">Struktur Organisasi</a></li>
                        <li><a class="dropdown-item fw-bolder text-muted" href="{{ url('penghargaan') }}">Penghargaan</a></li>
                        <li><a class="dropdown-item fw-bolder text-muted" href="{{ url('budaya-perusahaan') }}">Budaya Perusahaan</a></li>
                        <li><a class="dropdown-item fw-bolder text-muted" href="{{ url('sertifikasi') }}">Sertifikasi</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Unit Pembangkit
                    </a>
                    <ul class="dropdown-menu animate slideIn" style="border: 0 !important; border-radius: 0; font-family:Arial, Helvetica, sans-serif;">
                        @foreach ($units as $unit)
                        <li><a class="dropdown-item fw-bolder text-muted" href="{{ url('unit') }}">{{ $unit->nama_lengkap }}</a></li>
                        <!-- <li><a class="dropdown-item fw-bolder text-muted" href="{{ url('unit') }}">ULPLTD/G Siantan</a></li>
                        <li><a class="dropdown-item fw-bolder text-muted" href="{{ url('unit') }}">UPLTD SEI RAYA</a></li>
                        <li><a class="dropdown-item fw-bolder text-muted" href="{{ url('unit') }}">UPLTD SANGGAU</a></li>
                        <li><a class="dropdown-item fw-bolder text-muted" href="{{ url('unit') }}">UPTLD KETAPANG</a></li> -->
                        @endforeach
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Media
                    </a>
                    <ul class="dropdown-menu animate slideIn" style="border: 0 !important; border-radius: 0; font-family:Arial, Helvetica, sans-serif;">
                        <li><a class="dropdown-item fw-bolder text-muted" href="#"><i class="bi bi-collection-play-fill"></i> Siaran Pers</a></li>
                    </ul>
                </li>
                <li class="nav-item"><a class="nav-link" href="{{ url('kontak') }}">Kontak</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ url('permohonan') }}">Aplikasi</a></li>
            </ul>
        </div>
        <a class="navbar-brand" href="#page-top"><img src="./assets/img/Logo-PLN.png" alt="PLN Nusantara" class="lytzd-logo"></a>
        <button class="navbar-toggler navbar-toggler-left" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
    </div>
</nav>
