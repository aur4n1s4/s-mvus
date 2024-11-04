<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>E-PUSKESMAS</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="{{ asset('frontend/home/img/favicon.ico') }}" rel="icon">

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
            <h1 class="m-0 text-primary"><i class="far fa-hospital me-3"></i>E-PUSKESMAS</h1>
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
                <div class="col-lg-3 col-md-6">
                    <h5 class="text-light mb-4">Alamat</h5>
                    <p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i>Wonosobo, Jawa Tengah</p>
                    <p class="mb-2"><i class="fa fa-phone-alt me-3"></i>+012 345 67890</p>
                    <p class="mb-2"><i class="fa fa-envelope me-3"></i>info@example.com</p>
                    <div class="d-flex pt-2">
                        <a class="btn btn-outline-light btn-social rounded-circle" href=""><i
                                class="fab fa-twitter"></i></a>
                        <a class="btn btn-outline-light btn-social rounded-circle" href=""><i
                                class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-outline-light btn-social rounded-circle" href=""><i
                                class="fab fa-youtube"></i></a>
                        <a class="btn btn-outline-light btn-social rounded-circle" href=""><i
                                class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h5 class="text-light mb-4">Pelayanan</h5>
                    <a class="btn btn-link">Cardiology</a>
                    <a class="btn btn-link">Pulmonary</a>
                    <a class="btn btn-link">Neurology</a>
                    <a class="btn btn-link">Orthopedics</a>
                    <a class="btn btn-link">Laboratory</a>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h5 class="text-light mb-4">Kunjungi</h5>
                    <a class="btn btn-link" href="{{ url('/about') }}">Tentang Kami</a>
                    <a class="btn btn-link" href="{{ url('/service') }}">Layanan Kami</a>
                    <a class="btn btn-link" href="{{ url('/contact') }}">Hubungi Kami</a>
                    <a class="btn btn-link" href="{{ url('/pendaftaran') }}">Pendaftaran Pasien</a>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h5 class="text-light mb-4">Newsletter</h5>
                    <p>Dolor amet sit justo amet elitr clita ipsum elitr est.</p>
                    <div class="position-relative mx-auto" style="max-width: 400px;">
                        <input class="form-control border-0 w-100 py-3 ps-4 pe-5" type="text"
                            placeholder="Your email">
                        <button type="button"
                            class="btn btn-primary py-2 position-absolute top-0 end-0 mt-2 me-2">SignUp</button>
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
                        <!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
                        Designed By <a class="border-bottom" href="https://htmlcodex.com">HTML Codex</a>
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
