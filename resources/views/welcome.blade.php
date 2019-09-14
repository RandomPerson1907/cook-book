@extends("layouts.simple")

@push("styles")
    <link rel="stylesheet" href="{{ asset('/css/dore/dore.light.blue.min.css') }}">
@endpush

@section("content")
    <div class="landing-page">
        <div class="mobile-menu">
            <a href="#home" class="logo-mobile scrollTo">
                <span></span>
            </a>
            <ul class="navbar-nav">
                <li class="nav-item"><a href="#features" class="scrollTo">FEATURES</a></li>
                <li class="nav-item"><a href="#reviews" class="scrollTo">REVIEWS</a></li>
                <li class="nav-item"><a href="#pricing" class="scrollTo">PRICING</a></li>
                <li class="nav-item mb-2"><a href="#blog" class="scrollTo">BLOG</a></li>
                <li class="nav-item">
                    <div class="separator"></div>
                </li>
                <li class="nav-item mt-2"><a href="#apps">SIGN IN</a></li>
                <li class="nav-item"><a href="#apps">SIGN UP</a></li>
            </ul>
        </div>

        <div class="main-container">
            <nav class="landing-page-nav">
                <div class="container d-flex align-items-center justify-content-between">
                    <a class="navbar-logo pull-left scrollTo" href="#home">
                        <span class="white"></span>
                        <span class="dark"></span>
                    </a>
                    <ul class="navbar-nav d-none d-lg-flex flex-row">
                        @if($user = Auth::user())
                            <li class="nav-item mr-3 "><a class="btn btn-outline-semi-light btn-sm pr-4 pl-4" href="{{ route("recipes.index") }}">Мои рецепты</a></li>
                        @else
                            <li class="nav-item mr-3"><a href="{{ route("login") }}">ВОЙТИ</a></li>
                            <li class="nav-item pl-2">
                                <a class="btn btn-outline-semi-light btn-sm pr-4 pl-4" href="{{ route("register") }}">ЗАРЕГИСТРИРОВАТЬСЯ</a>
                            </li>
                        @endif
                    </ul>
                    <a href="#" class="mobile-menu-button">
                        <i class="simple-icon-menu"></i>
                    </a>
                </div>
            </nav>

            <div class="content-container" id="home">
                <div class="section home">
                    <div class="container">
                        <div class="row home-row">
                            <div class="col-12 d-block d-md-none">
                                <img alt="mobile hero" class="mobile-hero" src="/img/landing-page/home-hero-mobile.png" />
                            </div>

                            <div class="col-12 col-xl-4 col-lg-5 col-md-6">
                                <div class="home-text">
                                    <div class="display-1">МАГИЯ СКРЫВАЕТСЯ В ДЕТАЛЯХ</div>
                                    <p class="white mb-5">
                                        Книга с рецептами - это удобный способ хранить свои кулинарные хитрости удобно и в одном месте<br />
                                        <br />
                                        Надеюсь, Вам понравится!
                                    </p>
                                    <a class="btn btn-outline-semi-light btn-xl" href="{{ route("register") }}">ЗАРЕГИСТРИРОВАТЬСЯ СЕЙЧАС</a>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 p-0">
                                <div class="owl-container">
                                    <div class="owl-carousel home-carousel">
                                        <div class="card">
                                            <div class="card-body text-center">
                                                <div>
                                                    <i class="iconsmind-Cupcake large-icon"></i>
                                                    <h5 class="mb-0 font-weight-semibold">
                                                        Tasteful Design
                                                    </h5>
                                                </div>
                                                <div>
                                                    <p class="detail-text">
                                                        User experience principles always at the heart of
                            the design process.
                                                    </p>
                                                </div>
                                                <a class="btn btn-link font-weight-semibold" href="#">VIEW</a>
                                            </div>
                                        </div>

                                        <div class="card">
                                            <div class="card-body text-center">
                                                <div>
                                                    <i class="iconsmind-Line-Chart2 large-icon"></i>
                                                    <h5 class="mb-0 font-weight-semibold">
                                                        Superfine Charts
                                                    </h5>
                                                </div>
                                                <div>
                                                    <p class="detail-text">
                                                        Charts that looks good with color, opacity, border
                                                                                   and shadow.
                                                    </p>
                                                </div>
                                                <a class="btn btn-link font-weight-semibold" href="#">VIEW</a>
                                            </div>
                                        </div>

                                        <div class="card">
                                            <div class="card-body text-center">
                                                <div>
                                                    <i class="iconsmind-Three-ArrowFork large-icon"></i>
                                                    <h5 class="mb-0 font-weight-semibold">
                                                        Two Panels Menu
                                                    </h5>
                                                </div>
                                                <div>
                                                    <p class="detail-text">
                                                        A menu that looks good and does the job well.
                                                    </p>
                                                </div>
                                                <a class="btn btn-link font-weight-semibold" href="#">VIEW</a>
                                            </div>
                                        </div>
                                        <div class="card">
                                            <div class="card-body text-center">
                                                <div>
                                                    <i class="iconsmind-Funny-Bicycle large-icon"></i>
                                                    <h5 class="mb-0 font-weight-semibold">
                                                        Layouts for the Job
                                                    </h5>
                                                </div>
                                                <div>
                                                    <p class="detail-text">
                                                        Lots of different layouts for different jobs.
                                                    </p>
                                                </div>
                                                <a class="btn btn-link font-weight-semibold" href="#">VIEW</a>
                                            </div>
                                        </div>

                                        <div class="card">
                                            <div class="card-body text-center">
                                                <div>
                                                    <i class="iconsmind-Full-View large-icon"></i>
                                                    <h5 class="mb-0 font-weight-semibold">
                                                        Extra Responsive
                                                    </h5>
                                                </div>
                                                <div>
                                                    <p class="detail-text">
                                                        Better experiences for smaller and larger screens
                            by adding Xxl and Xxs.
                                                    </p>
                                                </div>
                                                <a class="btn btn-link font-weight-semibold" href="#">VIEW</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <a class="btn btn-circle btn-outline-semi-light hero-circle-button scrollTo" href="#features" id="homeCircleButton"><i
                            class="simple-icon-arrow-down"></i></a>
                </div>

            </div>
        </div>
    </div>
@endsection
