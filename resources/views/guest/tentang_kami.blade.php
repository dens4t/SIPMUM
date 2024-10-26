@extends('guest.partials.main')
@section('header')

<!-- Masthead-->
<header class="masthead">
            <div class="container px-4 px-lg-5 h-100">
                <div class="row gx-4 gx-lg-5 h-100 align-items-center justify-content-center text-center">
                    <div class="col-lg-8 align-self-end">
                        <h1 class="text-white fw-bolder">Tentang Kami</h1>
                        <hr class="divider" />
                    </div>
                    <div class="col-lg-8 align-self-baseline">
                        <p class="text-white fw-bolder mb-5 fs-2" style="font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Officiis, unde quaerat! Atque iure necessitatibus tempore voluptatem soluta quo excepturi accusantium esse dolores optio at itaque, fugit fugiat eligendi minima inventore?</p>
                    </div>
                </div>
            </div>
        </header>
@endsection
@section('container')
        <!-- Services-->
        <!-- photo-->
        <div id="portfolio">
            <div class="container-fluid p-0">
                <h2 class="text-center mt-5">Dokumentasi</h2>
                <hr class="divider" />
                <div class="row g-0">
                    <div class="col-lg-4 col-sm-6">
                        <a class="portfolio-box" href="assets/img/portfolio/fullsize/1.jpg" title="Project Name" data-aos="fade-up">
                            <img class="img-fluid" src="assets/img/portfolio/thumbnails/1.jpg" alt="..." />
                            <div class="portfolio-box-caption">
                                <div class="project-category text-white-50">Category</div>
                                <div class="project-name">Project Name</div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <a class="portfolio-box" href="assets/img/portfolio/fullsize/2.jpg" title="Project Name" data-aos="fade-up">
                            <img class="img-fluid" src="assets/img/portfolio/thumbnails/2.jpg" alt="..." />
                            <div class="portfolio-box-caption">
                                <div class="project-category text-white-50">Category</div>
                                <div class="project-name">Project Name</div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <a class="portfolio-box" href="assets/img/portfolio/fullsize/3.jpg" title="Project Name" data-aos="fade-up">
                            <img class="img-fluid" src="assets/img/portfolio/thumbnails/3.jpg" alt="..." />
                            <div class="portfolio-box-caption">
                                <div class="project-category text-white-50">Category</div>
                                <div class="project-name">Project Name</div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <a class="portfolio-box" href="assets/img/portfolio/fullsize/4.jpg" title="Project Name" data-aos="fade-up">
                            <img class="img-fluid" src="assets/img/portfolio/thumbnails/4.jpg" alt="..." />
                            <div class="portfolio-box-caption">
                                <div class="project-category text-white-50">Category</div>
                                <div class="project-name">Project Name</div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <a class="portfolio-box" href="assets/img/portfolio/fullsize/5.jpg" title="Project Name" data-aos="fade-up">
                            <img class="img-fluid" src="assets/img/portfolio/thumbnails/5.jpg" alt="..." />
                            <div class="portfolio-box-caption">
                                <div class="project-category text-white-50">Category</div>
                                <div class="project-name">Project Name</div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <a class="portfolio-box" href="assets/img/portfolio/fullsize/6.jpg" title="Project Name" data-aos="fade-up">
                            <img class="img-fluid" src="assets/img/portfolio/thumbnails/6.jpg" alt="..." />
                            <div class="portfolio-box-caption p-3">
                                <div class="project-category text-white-50">Category</div>
                                <div class="project-name">Project Name</div>
                            </div>
                        </a>
                    </div>
                </div>
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
                            <span class="text-muted">08:00 - 16:30</span></p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2">
                    <h4><i class="bi bi-person-lines-fill"></i>Kontak</h4>
                    <p><i class="bi bi-telephone-fill"></i>Phone<br>
                        <span class="text-muted">08xxxxxxxx</span></p>
                    <p><i class="bi bi-mailbox-flag"></i>Fax<br>
                        <span class="text-muted">lorem</span></p>
                    <p><i class="bi bi-envelope-fill"></i>Email<br>
                        <span class="text-muted">lorem@mail.com</span></p>
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
