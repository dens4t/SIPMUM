@extends('guest.partials.main')


@section('container')
<section class="pt-5 page-section">
    <div class="container pb-2"></div>
    <div class="container">
        <div class="row" data-aos="fade-right">
            <div class="col-12">
                <h2 class="contact-title h2"><i class="bi bi-person-fill"></i> Login User</h2>
            </div>
            <div class="col-lg-8" >
                <form method="POST" action="" accept-charset="UTF-8" data-request="onSignIn" class="form-contact contact_form"><input name="_session_key" type="hidden" value="Y97daWGIe9FX07CRTtTVjhYenlq6Pch8yQTz3S1W"><input name="_token" type="hidden" value="jVl7AfSQyCdlmhJZrTFOHr9zBS9jAE1HzLUkpshl">
                    @csrf
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group"><input type="text" required id="name" name="username" placeholder="Enter Username" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Username'" class="form-control valid bg-white"></div>
                        </div>
                        <div class="col-12">
                            <div class="form-group"><input type="password" required id="subject" name="password" placeholder="Enter Password" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Subject'" class="form-control bg-white"></div>
                        </div>
                    </div>
                    <div class="form-group mt-3"><button type="submit" class="button px-3 py-3 button-contactForm boxed-btn">Login</button></div>
                </form>
            </div>
            <!-- <div class="col-lg-3 offset-lg-1">
                <div class="media contact-info bg-white p-3"><span class="contact-info__icon"><i class="ti-unlock"></i></span>
                    <div class="media-body">
                        <h3>Registrasi</h3>
                        <p>Silahkan klik link berikut untuk mengisi form registrasi : <a class="post-link" href="https://uppunagaya.com/register">Register</a></p>
                    </div>
                </div>
            </div> -->
        </div>
    </div>
</section>
@endsection
