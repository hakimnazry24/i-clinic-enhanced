<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>@yield('title', 'I-CLINIC')</title> <!-- Dynamic Title -->
    <meta name="description" content="">
    <meta name="keywords" content="">

    <!-- Favicons -->
    <link href="{{ asset('assets/img/favicon.png') }}" rel="icon">
    <link href="{{ asset('assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

    <!-- Main CSS File -->
    <link href="{{ asset('assets/css/main.css') }}" rel="stylesheet">

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="index-page">
    <header id="header" class="header sticky-top">
        <div class="topbar d-flex align-items-center">
            <div class="container d-flex justify-content-center justify-content-md-between">
                <div class="contact-info d-flex align-items-center">

                </div>

            </div>
        </div>
        <div class="branding d-flex align-items-center">
            <div class="container d-flex justify-content-between">
                <a href="index.html" class="logo">
                    <h1 class="sitename">i-clinic</h1>
                </a>
                <nav id="navmenu" class="navmenu">
                    <ul>
                        <li><a href={{ route('home') }}>Home</a></li>
                        {{-- <li><a href="#booking">Booking Appoiment</a></li> --}}
                        <li><a href={{ route('news') }}>Information and News</a></li>
                        {{-- <li><a href="#record">Medical Record</a></li> --}}
                        <li><a href={{ route('feedback.index') }}>Feedback</a></li>
                        {{-- <li><a href="#payment">Payment</a></li> --}}
                        <li><a href="/login">Login</a>
                        </li>
                        <li><a href="/register"
                                class="bg-green-400 font-semibold text-black px-4 py-2 rounded-md">Register Now</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </header>

    <main class="main">
        @yield('content')
    </main>

    <footer id="footer" class="footer light-background">
        <div class="container footer-top">
            <div class="row">
                <div class="col-lg-4 footer-about">
                    <h3><I-clinic></I-clinic></h3>

                </div>
            </div>
        </div>
        <div class="container text-center">
            <p>© 2025 I-Clinic. All Rights Reserved</p>
        </div>
    </footer>

    <!-- Vendor JS Files -->
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/purecounter/purecounter_vanilla.js') }}"></script>
    <script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
    <!-- Main JS File -->
    <script src="{{ asset('assets/js/main.js') }}"></script>
</body>

</html>
