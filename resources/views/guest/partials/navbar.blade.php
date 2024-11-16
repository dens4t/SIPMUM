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
            <span><i class="bi bi-telephone-fill"></i> (0561) 723472 ext. 723449</span>
            <span><i class="bi bi-envelope-fill"></i> ptplnnpupks@gmail.com</span>
            <span><i class="bi bi-geo-alt-fill"></i> Jl. Adi Sucipto No.2</span>
        </div>

        <div class="col-lg-3 d-flex justify-content-end align-items-center text-white" style="font-family:Arial, Helvetica, sans-serif; font-size: 12px;">
            <div style="margin-right: 10px;">
                <i class="bi bi-calendar-event"></i> <span id="tanggalwaktu"></span>
            </div>
            <form class="d-flex" action="{{ url('siaran-pers') }}" method="get" role="search">
                <input class="me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="myBtn" type="submit"><i class="bi bi-search"></i></button>
            </form>
            <a class="nav-link ms-3 myBtna" href="{{ url('guest/login') }}">Login</a>
        </div>
    </div>
</section>
<nav class="navbar navbar-expand-lg navbar-light sticky-top bg-white" id="mainNav">
    <div class="container px-4 px-lg-5">
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav my-lg-0">
                <li class="nav-item"><a class="nav-link" href="{{ url('') }}">Beranda</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ url('permohonan') }}">Permohonan</a></li>
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
                        <!-- <li><a class="dropdown-item fw-bolder text-muted" href="{{ url('unit') }}">ULPLTD/G Siantan</a></li>
                        <li><a class="dropdown-item fw-bolder text-muted" href="{{ url('unit') }}">ULPLTD SEI RAYA</a></li>
                        <li><a class="dropdown-item fw-bolder text-muted" href="{{ url('unit') }}">ULPLTD SANGGAU</a></li>
                        <li><a class="dropdown-item fw-bolder text-muted" href="{{ url('unit') }}">ULPTLD KETAPANG</a></li> -->
                        @foreach ($units as $unit)
                        <li><a class="dropdown-item fw-bolder text-muted" href="{{ url('unit', $unit->nama) }}">{{$unit->nama_lengkap}}</a></li>
                        @endforeach

                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Media
                    </a>
                    <ul class="dropdown-menu animate slideIn" style="border: 0 !important; border-radius: 0; font-family:Arial, Helvetica, sans-serif;">
                        <li><a class="dropdown-item fw-bolder text-muted" href="{{ url('siaran-pers') }}"><i class="bi bi-collection-play-fill"></i> Siaran Pers</a></li>
                    </ul>
                </li>
            </ul>
        </div>
        <a class="navbar-brand" href="#page-top"><img style="background-color: white" src="{{ url('/storage/logo.png')}}" alt="PLN Nusantara" class="lytzd-logo"></a>
        <button class="navbar-toggler navbar-toggler-left" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
    </div>
</nav>
