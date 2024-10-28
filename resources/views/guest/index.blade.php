@extends('guest.partials.main', ['units'=>$units ?? null])
@section('header')
<!-- Masthead-->

<div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="./assets/img/UP-Kapuas.png" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
            <img src="./assets/img/4FdcqeD7beOO16vFy0i49ZglHtehdKitkeWGQSRm8akC8Hgmm571Er2zLfOv6xioK1NDp2KwOprMdM7AeWrPSms=w16383.jpg" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
            <img src="./assets/img/DYwVmcACoEfKcuhTEICaqlvqwnvFyMU2Vs_868x2TerQuabnisOVCeiEL_HKGGMoD0gr2vrF3vJyiftwIPRg49M=w16383.jpg" class="d-block w-100" alt="...">
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
<section class="page-section">
    <div class="row justify-content-center">
        <div class="col-lg-2 px-lg-5">
            <p>PLNNP ULPLTG/D Siantan merupakan salah satu Unit Layanan Pembangkitan Listrik Tenaga Gas dan Diesel yang terletak di Jl. Khatulistiwa Km 2,7, Siantan Hilir, Kecamatan Pontianak Hilir, Kalimantan Barat.</p>
        </div>
        <div class="col-lg-2">
            <div class="row ">
                <div class="col-lg-12">
                    <h4> <i class="bi bi-geo-alt-fill"></i> Alamat</h4>
                    <p class="text-muted">Jl. Khatulistiwa km 2,7 , Siantan Hilir, Kec Pontianak Hilir, Kalimantan Barat</p>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <h4><i class="bi bi-stopwatch-fill"></i>Jam Kerja</h4>
                    <p>Senin s/d Jumat<br>
                        <span class="text-muted">08:00 - 16:30</span>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-lg-2">
            <h4><i class="bi bi-person-lines-fill"></i> Kontak</h4>
            <p><i class="bi bi-telephone-fill"></i> Phone<br>
                <span class="text-muted">0823482349</span>
            </p>
            <p><i class="bi bi-mailbox-flag"></i> Fax<br>
                <span class="text-muted">(000)-123456</span>
            </p>
            <p><i class="bi bi-envelope-fill"></i> Email<br>
                <span class="text-muted">upltg.kapuas@gmail.com</span>
            </p>
        </div>
        <div class="col-lg-2">
            <h4><i class="bi bi-pin-map"></i> Kantor Pusat</h4>
            <h4>Jl. Khatulistiwa km 2,7</h4>
            <p class="text-muted">Lorem ipsum dolor sit amet.</p>
            <h4>Kantor Perwakilan</h4>
            <p class="text-muted">Lorem ipsum dolor sit amet consectetur adipisicing elit. Consequuntur, tenetur?</p>
        </div>
    </div>
</section>

@endsection
