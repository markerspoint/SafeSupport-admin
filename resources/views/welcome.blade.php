<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="icon" type="image/png" href="{{ asset('template/img/safecenter-logo.png') }}">

    <!-- SEO Meta Tags -->
    <meta name="description" content="Tivo is a HTML landing page template built with Bootstrap to help you crate engaging presentations for SaaS apps and convert visitors into users.">
    <meta name="author" content="Inovatik">

    <!-- OG Meta Tags to improve the way the post looks when you share the page on LinkedIn, Facebook, Google+ -->
    <meta property="og:site_name" content="" /> <!-- website name -->
    <meta property="og:site" content="" /> <!-- website link -->
    <meta property="og:title" content="" /> <!-- title shown in the actual shared post -->
    <meta property="og:description" content="" /> <!-- description shown in the actual shared post -->
    <meta property="og:image" content="" /> <!-- image link, make sure it's jpg -->
    <meta property="og:url" content="" /> <!-- where do you want your post to link to -->
    <meta property="og:type" content="article" />

    <!-- Website Title -->
    <title>SafeSupport</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    {{-- <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,400i,700&display=swap&subset=latin-ext" rel="stylesheet"> --}}
    <link href="{{asset('landing/css/bootstrap.css')}}" rel="stylesheet">
    <link href="{{asset('landing/css/fontawesome-all.css')}}" rel="stylesheet">
    <link href="{{asset('landing/css/swiper.css')}}" rel="stylesheet">
    <link href="{{asset('landing/css/magnific-popup.css')}}" rel="stylesheet">
    <link href="{{asset('landing/css/styles.css')}}" rel="stylesheet">


</head>
<body data-spy="scroll" data-target=".fixed-top">

    <!-- Preloader -->
    <div class="spinner-wrapper">
        <div class="spinner">
            <div class="bounce1"></div>
            <div class="bounce2"></div>
            <div class="bounce3"></div>
        </div>
    </div>
    <!-- end of preloader -->


    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom fixed-top">
        <div class="container">


            <!-- Image Logo -->
            <a href="{{ route('counselor.dashboard') }}" class="navbar-brand d-flex align-items-center ml-3" style="font-weight: 700; color: #ffffff; text-decoration: none;" onmouseover="this.style.color='#e1eaf7'" onmouseout="this.style.color='#fff'">
                SafeSupp
                <img src="{{ asset('template/img/safecenter-logo.png') }}" alt="O" style="height: 24px; margin: 0 4px;">
                rt
            </a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-awesome fas fa-bars"></span>
                <span class="navbar-toggler-awesome fas fa-times"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarsExampleDefault">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link page-scroll" href="#header">HOME <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link page-scroll" href="#features">FEATURES</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link page-scroll" href="#details">DETAILS</a>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle page-scroll" href="#video" id="navbarDropdown" role="button" aria-haspopup="true" aria-expanded="false">VIDEO</a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="article-details.html"><span class="item-text">ARTICLE DETAILS</span></a>
                            <div class="dropdown-items-divide-hr"></div>
                            <a class="dropdown-item" href="terms-conditions.html"><span class="item-text">TERMS CONDITIONS</span></a>
                            <div class="dropdown-items-divide-hr"></div>
                            <a class="dropdown-item" href="privacy-policy.html"><span class="item-text">PRIVACY POLICY</span></a>
                        </div>
                    </li>


                    <li class="nav-item">
                        <a class="nav-link page-scroll" href="#pricing">PRICING</a>
                    </li>
                </ul>
                <span class="nav-item">
                    <a class="btn-outline-sm" href="{{ route('login') }}">LOG IN</a>
                </span>
            </div>
        </div>
    </nav>


    <!-- Header -->
    <header id="header" class="header">
        <!-- Circles Background -->
        <ul class="circles">
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
        </ul>

        <div class="header-content d-flex align-items-center justify-content-center text-center" style="height: 100vh; position: relative; z-index: 2;">
            <div class="text-container">
                <h1 style="font-size: clamp(2rem, 5vw, 4rem); font-weight: 800; color: #fff; margin-top: -4rem;">
                    Listen. Heal. Grow. <span style="color: #ffd400;">Live.</span>
                </h1>

                <p class="p-large" style="font-size: clamp(1rem, 2.5vw, 1.25rem); line-height: 1.75rem; color: #fff; max-width: 45rem; margin: 0 2rem 2rem 2rem;">
                    Student, your feelings matter. Find the compassionate, professional counseling you need, made simple and always within reach.
                </p>
                <a class="btn-solid-lg page-scroll" href="{{ route('register') }}">Get Started</a>
            </div>
        </div>
    </header>



    <svg class="header-frame" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none" viewBox="0 0 1920 310">
        <defs>
            <style>
                .cls-1 {
                    fill: #1ab394;
                }

            </style>
        </defs>
        <title>header-frame</title>
        <path class="cls-1" d="M0,283.054c22.75,12.98,53.1,15.2,70.635,14.808,92.115-2.077,238.3-79.9,354.895-79.938,59.97-.019,106.17,18.059,141.58,34,47.778,21.511,47.778,21.511,90,38.938,28.418,11.731,85.344,26.169,152.992,17.971,68.127-8.255,115.933-34.963,166.492-67.393,37.467-24.032,148.6-112.008,171.753-127.963,27.951-19.26,87.771-81.155,180.71-89.341,72.016-6.343,105.479,12.388,157.434,35.467,69.73,30.976,168.93,92.28,256.514,89.405,100.992-3.315,140.276-41.7,177-64.9V0.24H0V283.054Z" />
    </svg>

    <!-- Customers -->
    <div class="slider-1">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">

                    <!-- Image Slider -->
                    <div class="slider-container">
                        <div class="swiper-container image-slider">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide">
                                    <img class="img-fluid" src="{{asset('landing/images/customer-logo-1.png')}}" alt="alternative">
                                </div>
                                <div class="swiper-slide">
                                    <img class="img-fluid" src="{{asset('landing/images/customer-logo-2.png')}}" alt="alternative">
                                </div>
                                <div class="swiper-slide">
                                    <img class="img-fluid" src="{{asset('landing/images/customer-logo-3.png')}}" alt="alternative">
                                </div>
                                <div class="swiper-slide">
                                    <img class="img-fluid" src="{{asset('landing/images/customer-logo-4.png')}}" alt="alternative">
                                </div>
                                <div class="swiper-slide">
                                    <img class="img-fluid" src="{{asset('landing/images/customer-logo-5.png')}}" alt="alternative">
                                </div>
                                <div class="swiper-slide">
                                    <img class="img-fluid" src="{{asset('landing/images/customer-logo-6.png')}}" alt="alternative">
                                </div>
                            </div> <!-- end of swiper-wrapper -->
                        </div> <!-- end of swiper container -->
                    </div> <!-- end of slider-container -->
                    <!-- end of image slider -->

                </div> <!-- end of col -->
            </div> <!-- end of row -->
        </div> <!-- end of container -->
    </div>

    <!-- Description -->
    <div class="cards-1">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="above-heading">DESCRIPTION</div>
                    <h2 class="h2-heading">What SafeSupport can offer?</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-image">
                            <img class="img-fluid" src="{{ asset('landing/images/counseling.svg') }}" alt="alternative">
                        </div>
                        <div class="card-body">
                            <h4 class="card-title">Compassionate Guidance</h4>
                            <p>A listening ear when you need it most. Our counselors understand the pressures of student life and provide support without judgment.</p>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-image">
                            <img class="img-fluid" src="{{asset('landing/images/counseling2.svg')}}" alt="alternative">
                        </div>
                        <div class="card-body">
                            <h4 class="card-title">Stress-Free Booking</h4>
                            <p>Life is busy—we get it. Book your sessions in just a few clicks, anytime, anywhere, so getting help fits seamlessly into your day.</p>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-image">
                            <img class="img-fluid" src="{{asset('landing/images/counseling3.svg')}}" alt="alternative">
                        </div>
                        <div class="card-body">
                            <h4 class="card-title">Tools for Your Well-Being</h4>
                            <p>Access practical resources, tips, and exercises that help you manage stress, process emotions, and grow at your own pace.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Mission -->
    <section id="mission" style="padding-top: 4rem; padding-bottom: 4rem; text-align: center;">
        <div class="container" style="max-width: 90vw; margin: 0 auto;">
            <div class="row">
                <div class="col-lg-12">
                    <div class="above-heading" style="font-size: 1rem; letter-spacing: 0.05em;">OUR MISSION</div>
                    <h2 style="font-size: clamp(1.75rem, 4vw, 2.5rem); margin-bottom: 2rem;">Why We Created SafeSupport</h2>
                    <p style="max-width: 45rem; margin: 0 auto; font-size: clamp(1rem, 2.5vw, 1.25rem); line-height: 1.75rem;">
                        At Central Philippine State University (CPSU), we noticed a growing concern for students’ mental health.
                        Many students struggle with stress, anxiety, and feelings of isolation—issues that, if left unaddressed, can escalate into serious consequences, including thoughts of self-harm.
                        <br><br>
                        SafeSupport was created as a capstone project to provide a <strong>safe, accessible, and compassionate platform</strong> where students can seek counseling, find resources, and connect with professional support before their challenges become overwhelming.
                        <br><br>
                        Our goal is simple: help students <strong>listen, heal, and grow</strong>—so that every student feels supported, understood, and never alone.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Our Team -->
    <div class="container text-center my-5">
        <h2 class="mb-5 fw-bold" style="color: #4a4a4a;">Our Team</h2>

        <div class="row justify-content-center g-4">


            <div class="col-6 col-sm-6 col-md-3 d-flex flex-column align-items-center">
                <img src="{{ asset('landing/images/ian.jpg') }}" alt="Developer 1" class="team-img mb-3">
                <p class="fw-semibold mb-1">Mark Ian Dela Cruz</p>
                <p class="text-muted small">Developer / Programmer</p>
            </div>


            <div class="col-6 col-sm-6 col-md-3 d-flex flex-column align-items-center">
                <img src="{{ asset('landing/images/yvonne.jpg') }}" alt="Developer 2" class="team-img mb-3">
                <p class="fw-semibold mb-1">Yvonne Grace Ochida</p>
                <p class="text-muted small">Analytical Writer</p>
            </div>


            <div class="col-6 col-sm-6 col-md-3 d-flex flex-column align-items-center">
                <img src="{{ asset('landing/images/cristine.jpeg') }}" alt="Developer 3" class="team-img mb-3">
                <p class="fw-semibold mb-1">Cristine Bilbar</p>
                <p class="text-muted small">Quality and Assurance</p>
            </div>


            <div class="col-6 col-sm-6 col-md-3 d-flex flex-column align-items-center">
                <img src="{{ asset('landing/images/janpil.jpg') }}" alt="Developer 4" class="team-img mb-3">
                <p class="fw-semibold mb-1">Johnphil Arreco</p>
                <p class="text-muted small">User Researcher</p>
            </div>
        </div>
    </div>



    <!-- Video -->
    <div id="video" class="basic-2">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="image-container">
                        <div class="video-wrapper">
                            <a class="popup-youtube" href="https://www.youtube.com/watch?v=G0zJGDokyWQ" data-effect="fadeIn">
                                <img class="img-fluid" src="{{ asset('landing/images/video-icon.svg') }}" alt="alternative">
                                <span class="video-play-button">
                                    <span></span>
                                </span>
                            </a>
                        </div>
                    </div>
                    <div class="p-heading">
                        Watch how SafeSupport helps students access professional, compassionate counseling anytime, manage stress effectively, and take control of their mental health.
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <svg class="footer-frame" data-name="Layer 2" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none" viewBox="0 0 1920 79">
        <defs>
            <style>
                .cls-2 {
                    fill: #1ab394;
                }

            </style>
        </defs>
        <title>footer-frame</title>
        <path class="cls-2" d="M0,72.427C143,12.138,255.5,4.577,328.644,7.943c147.721,6.8,183.881,60.242,320.83,53.737,143-6.793,167.826-68.128,293-60.9,109.095,6.3,115.68,54.364,225.251,57.319,113.58,3.064,138.8-47.711,251.189-41.8,104.012,5.474,109.713,50.4,197.369,46.572,89.549-3.91,124.375-52.563,227.622-50.155A338.646,338.646,0,0,1,1920,23.467V79.75H0V72.427Z" transform="translate(0 -0.188)" />
    </svg>
    <div class="footer">
        <div class="container">
            <div class="row">

                <!-- About -->
                <div class="col-md-4">
                    <div class="footer-col first">
                        <h4>About SafeSupport</h4>
                        <p class="p-small">
                            SafeSupport is a student-focused counseling platform developed as a capstone project at CPSU.
                            Our mission is to make mental health support more accessible, compassionate, and stigma-free.
                        </p>
                    </div>
                </div>

                <!-- Links -->
                <div class="col-md-4">
                    <div class="footer-col middle">
                        <h4>Quick Links</h4>
                        <ul class="list-unstyled li-space-lg p-small">
                            <li class="media">
                                <i class="fas fa-square"></i>
                                <div class="media-body">
                                    <a class="white" href="{{ route('register') }}">Get Started</a>
                                </div>
                            </li>
                            <li class="media">
                                <i class="fas fa-square"></i>
                                <div class="media-body">
                                    <a class="white" href="{{ route('login') }}">Login</a>
                                </div>
                            </li>
                            <li class="media">
                                <i class="fas fa-square"></i>
                                <div class="media-body">
                                    <a class="white" href="privacy-policy.html">Privacy Policy</a> &nbsp;|&nbsp;
                                    <a class="white" href="terms-conditions.html">Terms & Conditions</a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Contact -->
                <div class="col-md-4">
                    <div class="footer-col last">
                        <h4>Contact</h4>
                        <ul class="list-unstyled li-space-lg p-small">
                            <li class="media">
                                <i class="fas fa-map-marker-alt"></i>
                                <div class="media-body">Central Philippine State University, Kabankalan City, Negros Occidental</div>
                            </li>
                            <li class="media">
                                <i class="fas fa-envelope"></i>
                                <div class="media-body">
                                    <a class="white" href="mailto:safesupport@cpsu.edu.ph">safesupport@cpsu.edu.ph</a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </div>




    <!-- Copyright -->
    <div class="copyright">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <p class="p-small">Copyright © 2025 | <a href="#">SafeSupport</a><br>
                        Developed By <a href="https://m.me/mrkndlcrz.ide" target="_blank"> <strong>Mark Ian D. Dela Cruz</strong></a>
                    </p>
                </div>
            </div>
        </div>
    </div>



    <!-- Scripts -->
    <script src="{{asset('landing/js/jquery.min.js')}}"></script> <!-- jQuery for Bootstrap's JavaScript plugins -->
    <script src="{{asset('landing/js/popper.min.js')}}"></script> <!-- Popper tooltip library for Bootstrap -->
    <script src="{{asset('landing/js/bootstrap.min.js')}}"></script> <!-- Bootstrap framework -->
    <script src="{{asset('landing/js/jquery.easing.min.js')}}"></script> <!-- jQuery Easing for smooth scrolling between anchors -->
    <script src="{{asset('landing/js/swiper.min.js')}}"></script> <!-- Swiper for image and text sliders -->
    <script src="{{asset('landing/js/jquery.magnific-popup.js')}}"></script> <!-- Magnific Popup for lightboxes -->
    <script src="{{asset('landing/js/validator.min.js')}}"></script> <!-- Validator.js - Bootstrap plugin that validates forms -->
    <script src="{{asset('landing/js/scripts.js')}}"></script> <!-- Custom scripts -->


</body>
</html>
