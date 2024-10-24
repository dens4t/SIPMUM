@extends('guest.partials.main')
@section('header')
<!-- Masthead-->
<header class="masthead">
    <div class="container px-4 px-lg-5 h-100">
        <div class="row gx-4 gx-lg-5 h-100 align-items-center justify-content-center text-center">
            <div class="col-lg-8 align-self-end">
                <h1 class="text-white fw-bolder">SI P-MUMA</h1>
                <hr class="divider" />
            </div>
            <div class="col-lg-8 align-self-baseline">
                <p class="text-white fw-bolder mb-5 fs-2" style="font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;">(SISTEM PENGELOLAAN SDM DAN UMUM)</p>
            </div>
        </div>
    </div>
</header>
<!-- jadwal-->
@endsection
@section('container')
<section class="page-section bg-primary" id="about">
    <div class="container px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-lg-8 text-center" data-aos="fade-up">
                <h2 class="text-white mt-0">JADWAL AGENDA RUTIN</h2>
                <h2 class="text-white mt-0">PT PLN NUSANTARA POWER</h2>
                <h2 class="text-white mt-0">UNIT PEMBANGKIT KAPUAS DAN UNIT LAYANAN</h2>
                <hr class="divider divider-light" />
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div id="carouselExampleIndicators" class="carousel slide">
                        <div class="carousel-indicators">
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                        </div>
                        <div class="carousel-inner " data-aos="fade-up">
                            <div class="carousel-item active">
                                <img src="./assets/img/4FdcqeD7beOO16vFy0i49ZglHtehdKitkeWGQSRm8akC8Hgmm571Er2zLfOv6xioK1NDp2KwOprMdM7AeWrPSms=w16383.jpg" class="d-block w-100" alt="...">
                            </div>
                            <div class="carousel-item">
                                <img src="./assets/img/DYwVmcACoEfKcuhTEICaqlvqwnvFyMU2Vs_868x2TerQuabnisOVCeiEL_HKGGMoD0gr2vrF3vJyiftwIPRg49M=w16383.jpg" class="d-block w-100" alt="...">
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
