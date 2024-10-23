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
                <p class="text-white fw-bolder mb-5 fs-2" style="font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;">(SISTEM PENGELOLAAN SDM DAN UMUM)</p>
            </div>
        </div>
    </div>
</header>
@endsection
@section('container')
<!-- About-->
<section class="page-section bg-primary" id="about">
    <div class="container px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-lg-8 text-center" data-aos="fade-up">
                <h2 class="text-white mt-0">Lorem ipsum dolor sit amet consectetur adipisicing elit. Omnis sequi vitae excepturi nemo, nostrum dolorum optio unde accusamus deleniti fuga praesentium quo in beatae, mollitia neque, placeat rem consectetur velit. Repellat a repellendus mollitia qui officia explicabo sunt non, possimus soluta rem quis nisi eum ut, nesciunt, placeat voluptatibus. Nihil velit reiciendis omnis odit minus alias officia eligendi deserunt molestiae impedit, fuga earum consectetur neque itaque veniam quibusdam sed, est laborum! Modi earum neque quis itaque, in vel suscipit sapiente quisquam dolor aspernatur commodi cupiditate corrupti tempore eius repellendus necessitatibus maxime ullam ipsa qui, rem omnis, maiores odit voluptates? Eius.</h2>
                <hr class="divider divider-light" />
            </div>
</section>
<!-- Services-->
<section class="page-section" id="services">
    <div class="container px-4 px-lg-5">
        <h2 class="text-center mt-0" data-aos="fade-up">Layanan</h2>
        <hr class="divider" />
        <div class="row gx-4 gx-lg-5" data-aos="fade-up">
            <div class="col-lg-3 col-md-6 text-center">
                <div class="mt-5">
                    <div class="mb-2"><i class="bi-gem fs-1 text-primary"></i></div>
                    <h3 class="h4 mb-2">Sturdy Themes</h3>
                    <p class="text-muted mb-0">Our themes are updated regularly to keep them bug free!</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 text-center">
                <div class="mt-5">
                    <div class="mb-2"><i class="bi-laptop fs-1 text-primary"></i></div>
                    <h3 class="h4 mb-2">Up to Date</h3>
                    <p class="text-muted mb-0">All dependencies are kept current to keep things fresh.</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 text-center">
                <div class="mt-5">
                    <div class="mb-2"><i class="bi-globe fs-1 text-primary"></i></div>
                    <h3 class="h4 mb-2">Ready to Publish</h3>
                    <p class="text-muted mb-0">You can use this design as is, or you can make changes!</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 text-center">
                <div class="mt-5">
                    <div class="mb-2"><i class="bi-heart fs-1 text-primary"></i></div>
                    <h3 class="h4 mb-2">Made with Love</h3>
                    <p class="text-muted mb-0">Is it really open source if it's not made with love?</p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- photo-->
<div id="portfolio">
    <div class="container-fluid p-0">
        <h2 class="text-center mt-0">Dokumentasi</h2>
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
<section class="page-section" id="contact" data-aos="fade-up">
    <div class="container px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-lg-8 col-xl-6 text-center">
                <h2 class="mt-0">Kontak Kami</h2>
                <hr class="divider" />
                <p class="text-muted mb-5">Berikan Saran Masukan Anda</p>
            </div>
        </div>
        <div class="row gx-4 gx-lg-5 justify-content-center mb-5">
            <div class="col-lg-6">
                <!-- * * * * * * * * * * * * * * *-->
                <!-- * * SB Forms Contact Form * *-->
                <!-- * * * * * * * * * * * * * * *-->
                <!-- This form is pre-integrated with SB Forms.-->
                <!-- To make this form functional, sign up at-->
                <!-- https://startbootstrap.com/solution/contact-forms-->
                <!-- to get an API token!-->
                <form id="contactForm" data-sb-form-api-token="API_TOKEN">
                    <!-- Name input-->
                    <div class="form-floating mb-3">
                        <input class="form-control" id="name" type="text" placeholder="Enter your name..." data-sb-validations="required" />
                        <label for="name">Full name</label>
                        <div class="invalid-feedback" data-sb-feedback="name:required">A name is required.</div>
                    </div>
                    <!-- Email address input-->
                    <div class="form-floating mb-3">
                        <input class="form-control" id="email" type="email" placeholder="name@example.com" data-sb-validations="required,email" />
                        <label for="email">Email address</label>
                        <div class="invalid-feedback" data-sb-feedback="email:required">An email is required.</div>
                        <div class="invalid-feedback" data-sb-feedback="email:email">Email is not valid.</div>
                    </div>
                    <!-- Phone number input-->
                    <div class="form-floating mb-3">
                        <input class="form-control" id="phone" type="tel" placeholder="(123) 456-7890" data-sb-validations="required" />
                        <label for="phone">Phone number</label>
                        <div class="invalid-feedback" data-sb-feedback="phone:required">A phone number is required.</div>
                    </div>
                    <!-- Message input-->
                    <div class="form-floating mb-3">
                        <textarea class="form-control" id="message" type="text" placeholder="Enter your message here..." style="height: 10rem" data-sb-validations="required"></textarea>
                        <label for="message">Message</label>
                        <div class="invalid-feedback" data-sb-feedback="message:required">A message is required.</div>
                    </div>
                    <!-- Submit success message-->
                    <!---->
                    <!-- This is what your users will see when the form-->
                    <!-- has successfully submitted-->
                    <div class="d-none" id="submitSuccessMessage">
                        <div class="text-center mb-3">
                            <div class="fw-bolder">Form submission successful!</div>
                            To activate this form, sign up at
                            <br />
                            <a href="https://startbootstrap.com/solution/contact-forms">https://startbootstrap.com/solution/contact-forms</a>
                        </div>
                    </div>
                    <!-- Submit error message-->
                    <!---->
                    <!-- This is what your users will see when there is-->
                    <!-- an error submitting the form-->
                    <div class="d-none" id="submitErrorMessage">
                        <div class="text-center text-danger mb-3">Error sending message!</div>
                    </div>
                    <!-- Submit Button-->
                    <div class="d-grid"><button class="btn btn-primary btn-xl disabled" id="submitButton" type="submit">Submit</button></div>
                </form>
            </div>
        </div>
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-lg-4 text-center mb-5 mb-lg-0">
                <i class="bi-phone fs-2 mb-3 text-muted"></i>
                <div>Phone Number</div>
            </div>
        </div>
    </div>
</section>
@endsection
