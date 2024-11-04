@extends('guest.partials.main')
@section('header')

<header class="masthead" style="height: 25px !important;">
    <div class="container px-4 px-lg-5 h-100">
        <div class="row gx-4 gx-lg-5 align-items-center justify-content-center text-center h-100">
            <div class="col-lg-8 align-self-end">
                <h1 class="text-white fw-bolder">Siaran Pers</h1>
                <hr class="divider" />
            </div>
            <div class="col-lg-8 align-self-baseline">
                <p class="text-white fw-bolder mb-5 fs-2" style="font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;">Berita</p>
            </div>
        </div>
    </div>
</header>
@endsection

@section('container')
<section class="container-fluid p-3 d-flex justify-content-between flex-wrap gap-3">
    <div class="row mt-3">
        <div class="col-lg-2"></div>
        <div class="col-lg-7 newsSide">
            <div class="row topNews">
                <div class="col-lg-12">
                    <h2 class="text-danger">Top News</h2>
                    <hr />
                    <div id="carouselExampleCaptions" class="carousel slide">
                        <div class="carousel-indicators">
                            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
                            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
                        </div>
                        <div class="carousel-inner">
                            <!-- <div class="carousel-item active">
                                <img src="./assets/img/UP-Kapuas.png" class="d-block w-100" alt="...">
                                <div class="carousel-caption d-none d-md-block">
                                    <a href="" class="linkstylepers-1">
                                        <h5>First slide label</h5>
                                        <p>Some representative placeholder content for the first slide.</p>
                                    </a>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <img src="./assets/img/UP-Kapuas.png" class="d-block w-100" alt="...">
                                <div class="carousel-caption d-none d-md-block">
                                    <a href="" class="linkstylepers-1">
                                        <h5>Second slide label</h5>
                                        <p>Some representative placeholder content for the second slide.</p>
                                    </a>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <img src="./assets/img/UP-Kapuas.png" class="d-block w-100" alt="...">
                                <div class="carousel-caption d-none d-md-block">
                                    <a href="" class="linkstylepers-1">
                                        <h5>Third slide label</h5>
                                        <p>Some representative placeholder content for the third slide.</p>
                                    </a>
                                </div>
                            </div> -->
                            @foreach ($slides as $i=>$slide)
                            <?php $thumbnail = array_values($slide->thumbnail); ?>
                            <div class="carousel-item{{ $i == 0 ? " active" : ""}}">
                                <img src="{{ url('storage', $thumbnail) }}" style="max-width:1204px!important;height:602px !important;" class="d-block w-100" alt="...">
                                <div class="carousel-caption d-none d-md-block">
                                    <a href="" class="linkstylepers-1">
                                        <h5>{{$slide->title}}</h5>
                                        <!-- <p>Some representative placeholder content for the first slide.</p> -->
                                    </a>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row mt-3">
                <p>News</p>
                <hr>
                <div class="col-lg-12">

                    <!-- card berita -->
                    @foreach ($data as $i=>$post)
                    <?php $thumbnail = array_values($post->thumbnail); ?>
                    <div class="card mb-3 border-0" style="max-width: 100%;">
                        <div class="row g-0">
                            <div class="col-md-4">
                                <img src="{{url('storage',$thumbnail)}}" class="img-fluid rounded-start" alt="...">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h4 class="card-text"><a href="{{ url('siaran-pers',$post->slug) }}" class="linkstylepers">{{ $post->title }}</a></p>
                                        <small class="text-muted">{{ $post->created_at?->diffForHumans() }}</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach


                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="text-danger g-3">Populer</h2>
                    <hr>


                    @foreach ($popular as $i=>$post)
                    <?php $thumbnail = array_values($post->thumbnail); ?>
                    <!-- card berita populer -->
                    <div class="card text-bg-dark m-2" style="cursor:pointer;" onclick="window.location.href='{{ url("siaran-pers",$post->slug) }}'">
                        <img src="{{ url('storage', $thumbnail) }}" class="card-img" alt="...">
                        <div class="card-img-overlay">
                            <h5 class="card-title">{{$post->title}}</h5>
                            <!-- <p class="card-text"><a href="" class="linkstylepers-1">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</a> </p> -->
                            <!-- <p class="card-text"><small>Last updated 3 mins ago</small></p> -->
                        </div>
                    </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
</section>
@endsection
