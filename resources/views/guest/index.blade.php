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
        <div class="carousel-inner" style="height:900px">
            <div class="carousel-item active">
                <img src="./assets/img/UP-Kapuas.png" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block"
                    style="color: white; padding: 1rem; left: 10%; top: 50%; transform: translateY(-50%); text-align: left; width: auto;">
                    <h1 style="font-size: 2.5rem;">Selamat datang di My PMUM Kapuas</h1>
                    <p style="font-size: 1.25rem;">Membangun Masa Depan Bersama Listrik yang Handal dan Berkelanjutan</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="{{ url('storage/' . 'thumbnail/pltd-siantan.jpg') }}" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block"
                    style="color: white; padding: 1rem; left: 10%; top: 50%; transform: translateY(-50%); text-align: left; width: auto;">
                    <h1 style="font-size: 2.5rem;" style="">Optimis dengan Mengoptimalkan <br>Potensi yang ada, Membuka
                        diri,<br> Serta peka terhadap perubahan agar <br>selalu exist</h1>
                    <small style="font-size:1rem;">Edi Hariyanto</small>
                </div>
            </div>
            <div class="carousel-item">
                <img src="{{ url('storage/' . 'thumbnail/pltd-teluk-malino.jpg') }}" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block"
                    style="color: white; padding: 1rem; left: 10%; top: 50%; transform: translateY(-50%); text-align: left; width: auto;">
                    <h1 style="font-size: 2.5rem;">PLTD Teluk Melano</h1>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying"
            data-bs-slide="next">
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
                        <a href="{{ url('admin/login') }}" style="text-decoration:none; color:black;">
                            <div class="mb-2"><i class="bi-list fs-1 text-primary"></i></div>
                            <h3 class="h4 mb-2">Pengajuan Kegiatan</h3>
                            <!-- <p class="text-muted mb-0">Our themes are updated regularly to keep them bug free!</p> -->
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 text-center">
                    <div class="mt-5">
                        <a href="{{ url('admin/login') }}" style="text-decoration:none; color:black;">
                            <div class="mb-2"><i class="bi-envelope fs-1 text-primary"></i></div>
                            <h3 class="h4 mb-2">Permohonan Nomor Surat</h3>
                        </a>
                        <!-- <p class="text-muted mb-0">Our themes are updated regularly to keep them bug free!</p> -->
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 text-center">
                    <div class="mt-5">
                        <a href="{{ url('admin/login') }}" style="text-decoration:none; color:black;">
                            <div class="mb-2"><i class="bi-arrow-repeat fs-1 text-primary"></i></div>
                            <h3 class="h4 mb-2">Pengajuan SPPD</h3>
                            <!-- <p class="text-muted mb-0">All dependencies are kept current to keep things fresh.</p> -->
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 text-center">
                    <div class="mt-5">
                        <a href="{{ url('admin/login') }}" style="text-decoration:none; color:black;">
                            <div class="mb-2"><i class="bi-people fs-1 text-primary"></i></div>
                            <h3 class="h4 mb-2">Permohonan Kendaraan Dinas</h3>
                            <!-- <p class="text-muted mb-0">You can use this design as is, or you can make changes!</p> -->
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 text-center mx-auto">
                    <div class="mt-5">
                        <a href="{{ url('admin/login') }}" style="text-decoration:none; color:black;">
                            <div class="mb-2"><i class="bi-people-fill fs-1 text-primary"></i></div>
                            <h3 class="h4 mb-2">Permohonan Rapat dan Konsumsi Rapat</h3>
                            <!-- <p class="text-muted mb-0">Is it really open source if it's not made with love?</p> -->
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection