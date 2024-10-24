<!-- Navigation-->
<nav class="navbar navbar-expand-lg navbar-light fixed-top py-3" id="mainNav">
    <div class="container px-4 px-lg-5">
        <a class="navbar-brand" href="#page-top"><img src="./assets/img/Logo-PLN.png" alt="PLN Nusantara" class="lytzd-logo"><span> SDM,UMUM, & CSR</span></a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ms-auto my-2 my-lg-0">
                <li class="nav-item"><a class="nav-link" href="{{ url('') }}">Beranda</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ url('permohonan') }}">Permohonan</a></li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Profil
                    </a>
                    <ul class="dropdown-menu" style="border: 0 !important; border-radius: 0; font-family:Arial, Helvetica, sans-serif;">
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
                    <ul class="dropdown-menu " style="border: 0 !important; border-radius: 0; font-family:Arial, Helvetica, sans-serif;">
                        <li><a class="dropdown-item fw-bolder text-muted" href="{{ url('unit') }}">Kantor UP Kapuas </a></li>
                        <li><a class="dropdown-item fw-bolder text-muted" href="{{ url('unit') }}">ULPLTD/G Siantan</a></li>
                        <li><a class="dropdown-item fw-bolder text-muted" href="{{ url('unit') }}">UPLTD SEI RAYA</a></li>
                        <li><a class="dropdown-item fw-bolder text-muted" href="{{ url('unit') }}">UPLTD SANGGAU</a></li>
                        <li><a class="dropdown-item fw-bolder text-muted" href="{{ url('unit') }}">UPTLD KETAPANG</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Media
                    </a>
                    <ul class="dropdown-menu" style="border: 0 !important; border-radius: 0; font-family:Arial, Helvetica, sans-serif;">
                        <li><a class="dropdown-item fw-bolder text-muted" href="{{ url('siaran-pers') }}"><i class="bi bi-collection-play-fill"></i> Siaran Pers</a></li>
                    </ul>
                </li>
                <li class="nav-item"><a class="nav-link" href="{{ url('admin') }}">Login</a></li>

            </ul>
        </div>
    </div>
</nav>
