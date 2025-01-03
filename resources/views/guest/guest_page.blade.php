@extends('guest.partials.main')
@section('header')

<!-- Masthead-->
<header class="masthead" style="min-height:10em;height:10vh;">
    <div class="container px-4 px-lg-5 h-100">
        <div class="row gx-4 gx-lg-5 h-100 align-items-center justify-content-center text-center">
            <div class="col-lg-8 align-self-end">
                <h1 class="text-white fw-bolder">{{$data->title}}</h1>
                <hr class="divider" />
            </div>
        </div>
    </div>
</header>
@endsection
@section('container')
<!-- Services-->
<!-- photo-->
<div id="portfolio">
    <div class="container-fluid p-5">
        {!! str($data->content)->markdown()->sanitizeHtml() !!}<br />
    </div>
</div>

<!-- Contact-->
<!-- Footer-->
<section class="page-section">
    <div class="row justify-content-center">
        <div class="col-lg-2 px-lg-5">
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime numquam provident alias doloribus esse hic nobis iste eaque adipisci consectetur.</p>
        </div>
        <div class="col-lg-2">
            <div class="row ">
                <div class="col-lg-12">
                    <h4> <i class="bi bi-geo-alt-fill"></i> Alamat</h4>
                    <p class="text-muted">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Aut, sunt.</p>
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
            <h4><i class="bi bi-person-lines-fill"></i>Kontak</h4>
            <p><i class="bi bi-telephone-fill"></i>Phone<br>
                <span class="text-muted">08xxxxxxxx</span>
            </p>
            <p><i class="bi bi-mailbox-flag"></i>Fax<br>
                <span class="text-muted">lorem</span>
            </p>
            <p><i class="bi bi-envelope-fill"></i>Email<br>
                <span class="text-muted">lorem@mail.com</span>
            </p>
        </div>
        <div class="col-lg-2">
            <h4><i class="bi bi-pin-map"></i>Kantor Pusat</h4>
            <h4>Jl. Ketintang Baru No. 11.</h4>
            <p class="text-muted">Lorem ipsum dolor sit amet.</p>
            <h4>Kantor Perwakilan</h4>
            <p class="text-muted">Lorem ipsum dolor sit amet consectetur adipisicing elit. Consequuntur, tenetur?</p>
        </div>
    </div>
</section>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
@endsection
