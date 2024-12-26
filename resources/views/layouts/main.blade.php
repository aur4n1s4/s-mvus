<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Puskesmas Pondok Benda</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="{{ asset('frontend/favicon.ico') }}" rel="icon">

    <!-- Google Web Fonts -->
    <link href="{{ asset('frontend/css/font.css') }}" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('frontend/home/lib/animate/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/home/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/home/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css') }}"
        rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('frontend/home/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{ asset('frontend/home/css/style.css') }}" rel="stylesheet">

    <!-- Template SweetAlert -->
    <link href="{{ asset('frontend/css/sweetalert2.min.css') }}" rel="stylesheet">
</head>

<body>
    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg bg-white navbar-light sticky-top p-0 wow fadeIn" data-wow-delay="0.1s">
        <a href="{{ url('/') }}" class="navbar-brand d-flex align-items-center px-4 px-lg-5">
            <h2 class="m-0 text-primary">
                UPTD PUSKESMAS
            </h2>
        </a>
        <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto p-4 p-lg-0">
                <a href="{{ url('/') }}" class="nav-item nav-link">Home</a>
                <a href="{{ route('about') }}" class="nav-item nav-link">About</a>
                <a href="{{ route('service') }}" class="nav-item nav-link">Service</a>
                <a href="{{ route('dokter') }}" class="nav-item nav-link">Dokter</a>
                <a href="{{ route('contact') }}" class="nav-item nav-link">Contact</a>
            </div>
            <a href="{{ route('login') }}" class="btn btn-primary rounded-0 py-4 px-lg-5 d-none d-lg-block">
                LOGIN <i class="fa fa-arrow-right ms-3"></i>
            </a>
        </div>
    </nav>
    <!-- Navbar End -->

    @yield('post')

    <!-- Footer Start -->
    <div class="container-fluid bg-dark text-light footer mt-5 pt-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-lg-5 col-md-6">
                    <h5 class="text-light mb-4">Alamat</h5>
                    <p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i>Jl. Benda Barat No. 14 A, Perum Pamulang
                        Permai 2, Pondok Benda, Pamulang, Kota
                        Tangerang Selatan</p>
                    <p class="mb-2"><i class="fa fa-phone-alt me-3"></i>+62823-1136-6261</p>
                    <p class="mb-2 s-12"><i class="fa fa-envelope me-3"></i>pengaduanpkmpondokbenda@yahoo.com</p>
                    <div class="d-flex pt-2">
                        <a class="btn btn-outline-light btn-social rounded-circle"
                            href="https://www.instagram.com/puskesmaspondokbenda/"><i class="fab fa-instagram"></i></a>
                        <a class="btn btn-outline-light btn-social rounded-circle" href=""><i
                                class="fab fa-youtube"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h5 class="text-light mb-4">Pelayanan</h5>
                    <a class="btn btn-link">Umum</a>
                    <a class="btn btn-link">Gizi</a>
                    <a class="btn btn-link">KIA</a>
                    <a class="btn btn-link">Catin</a>
                    <a class="btn btn-link">KB, IVA Test, dan Tindik Bayi</a>
                    <a class="btn btn-link">TB</a>
                    <a class="btn btn-link">Imunisasi</a>
                </div>
                <div class="col-lg-4 col-md-6">
                    <h5 class="text-light mb-4">Lokasi</h5>
                    <div class="position-relative mx-auto" style="max-width: 400px;">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d991.3825529706583!2d106.70703902936096!3d-6.325261399999994!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69e569a29ac027%3A0x6c3105df7808c997!2sPuskesmas%20Pondok%20Benda!5e0!3m2!1sid!2sid!4v1732347015936!5m2!1sid!2sid"
                            width="350" height="250" style="border:0;" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="copyright">
                <div class="row">
                    <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                        &copy; <a class="border-bottom" href="#">E-Puskesmas</a>, All Right Reserved.
                    </div>
                    <div class="col-md-6 text-center text-md-end">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square rounded-circle back-to-top"><i
            class="bi bi-arrow-up"></i></a>

    <!-- JavaScript Libraries -->
    <script src="{{ asset('frontend/js/jquery-3.4.1.min.js') }}"></script>
    <script src="{{ asset('frontend/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('frontend/home/lib/wow/wow.min.js') }}"></script>
    <script src="{{ asset('frontend/home/lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('frontend/home/lib/waypoints/waypoints.min.js') }}"></script>
    <script src="{{ asset('frontend/home/lib/counterup/counterup.min.js') }}"></script>
    <script src="{{ asset('frontend/home/lib/owlcarousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('frontend/home/lib/tempusdominus/js/moment.min.js') }}"></script>
    <script src="{{ asset('frontend/home/lib/tempusdominus/js/moment-timezone.min.js') }}"></script>
    <script src="{{ asset('frontend/home/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js') }}"></script>

    <!-- Template Javascript -->
    <script src="{{ asset('frontend/home/js/main.js') }}"></script>

    <!-- Template SweetAlert -->
    <script src="{{ asset('frontend/js/sweetalert2.all.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Additional Javascript -->
    @yield('script')
</body>

</html>
