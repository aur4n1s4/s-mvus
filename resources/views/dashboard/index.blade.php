@extends('layouts.main')

@section('post')
<!-- Header Start -->
<div class="container-fluid header bg-primary p-0 mb-5">
    <div class="row g-0 align-items-center flex-column-reverse flex-lg-row">
        <div class="col-lg-6 p-5 wow fadeIn" data-wow-delay="0.1s">
            <h1 class="display-4 text-white mb-5">Puskesmas, Rumah Kesehatan Keluarga Anda</h1>
            <div class="row g-4">
                <div class="col-sm-4">
                    <div class="border-start border-light ps-4">
                        <h2 class="text-white mb-1" data-toggle="counter-up">{{ $pengunjungHariIni }}</h2>
                        <p class="text-light mb-0">Pengunjung Hari Ini</p>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="border-start border-light ps-4">
                        <h2 class="text-white mb-1" data-toggle="counter-up">{{ $pengunjungBesok }}</h2>
                        <p class="text-light mb-0">Pengunjung Besok</p>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="border-start border-light ps-4">
                        <h2 class="text-white mb-1" data-toggle="counter-up">{{ $totalPengunjung }}</h2>
                        <p class="text-light mb-0">Semua Pengunjung</p>
                    </div>
                </div>
            </div>
            <div class="mt-4">
                <a href="{{ route('pendaftaran.index') }}" class="btn btn-outline-light rounded-pill border-2 py-3 px-5 animated slideInRight">
                    Pendaftaran Pasien <i class="fas fa-arrow-right ms-2"></i>
                </a>
            </div>
        </div>


        <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
            <div class="owl-carousel header-carousel">
                <div class="owl-carousel-item position-relative">
                    <img class="img-fluid" src="{{ asset('frontend/home/imgs/carousel-1.jpg') }}" alt="">
                    <div class="owl-carousel-text">
                        <h1 class="display-1 text-white mb-0">Pelayanan Kesehatan Umum</h1>
                    </div>
                </div>
                <div class="owl-carousel-item position-relative">
                    <img class="img-fluid" src="{{ asset('frontend/home/imgs/carousel-2.jpg') }}" alt="">
                    <div class="owl-carousel-text">
                        <h1 class="display-1 text-white mb-0">Pelayanan Kesehatan Lingkungan</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Header End -->

<!-- About Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s">
                <div class="d-flex flex-column">
                    <img class="img-fluid rounded" src="{{ asset('frontend/home/imgs/about-1.jpg') }}" alt="">
                </div>
            </div>
            <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                <p class="d-inline-block border rounded-pill py-1 px-4">Tentang Kami</p>
                <h1 class="mb-4">Membangun Kesehatan Bersama Puskesmas, Kenali Layanan Kami!</h1>
                <p>
                    UPTD Puskesmas Pondok Benda menyediakan layanan kesehatan dengan fasilitas rawat inap. Didirikan
                    pada 11
                    Februari 2011, Puskesmas ini telah memiliki izin operasional resmi dari Dinas Kesehatan
                    Kota Tangerang Selatan berdasarkan SK Nomor 445.4/0009-DPMPTSP/OL/2018.
                    Puskesmas Pondok Benda berlokasi di Jl. Benda Barat No. 14, Perum Pamulang Permai
                    2, Kelurahan Pondok Benda, Kecamatan Pamulang, Kota Tangerang Selatan.
                </p>
                <p class="mb-4">
                    Sebagai ujung tombak pelayanan kesehatan di tingkat pertama, melaksanakan berbagai upaya kesehatan
                    masyarakat, baik yang bersifat
                    esensial maupun pengembangan. Upaya pengembangan dilakukan melalui inovasi,
                    ekstensifikasi, dan intensifikasi pelayanan sesuai dengan prioritas kesehatan masyarakat,
                    karakteristik wilayah kerja, dan sumber daya yang tersedia.
                </p>
                <p><i class="far fa-check-circle text-primary me-3"></i>Tim medis yang profesional dan terlatih</p>
                <p><i class="far fa-check-circle text-primary me-3"></i>Fasilitas kesehatan yang lengkap</p>
                <p><i class="far fa-check-circle text-primary me-3"></i>Pelayanan kesehatan terbaik dan ramah kepada
                    pasien</p>
            </div>
        </div>
    </div>
</div>
<!-- About End -->

<!-- Feature Start -->
<div class="container-fluid bg-primary overflow-hidden my-5 px-lg-0">
    <div class="container feature px-lg-0">
        <div class="row g-0 mx-lg-0">
            <div class="col-lg-6 feature-text py-5 wow fadeIn" data-wow-delay="0.1s">
                <div class="p-lg-5 ps-lg-0">
                    <p class="d-inline-block border rounded-pill text-light py-1 px-4">Fitur Unggulan</p>
                    <h1 class="text-white mb-4">Mengapa Memilih Kami?</h1>
                    <p class="text-white mb-4 pb-2">'Puskesmas Sehat' menjadi program untuk mendorong masyarakat untuk
                        hidup sehat dan aktif dengan cara memberikan fasilitas olahraga, edukasi tentang pola makan
                        sehat, serta memberikan motivasi dan dukungan dalam mencapai gaya hidup sehat</p>
                    <div class="row g-4">
                        <div class="col-6">
                            <div class="d-flex align-items-center">
                                <div class="d-flex flex-shrink-0 align-items-center justify-content-center rounded-circle bg-light" style="width: 55px; height: 55px;">
                                    <i class="fa fa-user-md text-primary"></i>
                                </div>
                                <div class="ms-4">
                                    <p class="text-white mb-2">Berpengalaman</p>
                                    <h5 class="text-white mb-0">Dokter</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="d-flex align-items-center">
                                <div class="d-flex flex-shrink-0 align-items-center justify-content-center rounded-circle bg-light" style="width: 55px; height: 55px;">
                                    <i class="fa fa-check text-primary"></i>
                                </div>
                                <div class="ms-4">
                                    <p class="text-white mb-2">Berkualitas</p>
                                    <h5 class="text-white mb-0">Pelayanan</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="d-flex align-items-center">
                                <div class="d-flex flex-shrink-0 align-items-center justify-content-center rounded-circle bg-light" style="width: 55px; height: 55px;">
                                    <i class="fa fa-comment-medical text-primary"></i>
                                </div>
                                <div class="ms-4">
                                    <p class="text-white mb-2">Terjangkau</p>
                                    <h5 class="text-white mb-0">Biaya</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="d-flex align-items-center">
                                <div class="d-flex flex-shrink-0 align-items-center justify-content-center rounded-circle bg-light" style="width: 55px; height: 55px;">
                                    <i class="fa fa-headphones text-primary"></i>
                                </div>
                                <div class="ms-4">
                                    <p class="text-white mb-2">24 Jam</p>
                                    <h5 class="text-white mb-0">Siap Melayani</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 pe-lg-0 wow fadeIn" data-wow-delay="0.5s" style="min-height: 400px;">
                <div class="position-relative h-100">
                    <img class="position-absolute img-fluid w-100 h-100" src="{{ asset('frontend/home/imgs/feature.jpg') }}" style="object-fit: cover;" alt="">
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Feature End -->

<!-- Service Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
            <p class="d-inline-block border rounded-pill py-1 px-4">Layanan Kami</p>
            <h1>Solusi Kesehatan Anda</h1>
        </div>
        <div class="row g-4">
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                <div class="service-item bg-light rounded h-100 p-5">
                    <div class="d-inline-flex align-items-center justify-content-center bg-white rounded-circle mb-4" style="width: 65px; height: 65px;">
                        <i class="fa fa-heartbeat text-primary fs-4"></i>
                    </div>
                    <h4 class="mb-3">Kesehatan Umum</h4>
                    <p class="mb-4">Pemeriksaan tekanan darah, gula darah, dan kolesterol. Memantau kesehatan tubuh
                        secara berkala dan mencegah terjadinya penyakit yang lebih serius.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                <div class="service-item bg-light rounded h-100 p-5">
                    <div class="d-inline-flex align-items-center justify-content-center bg-white rounded-circle mb-4" style="width: 65px; height: 65px;">
                        <i class="fa fa-x-ray text-primary fs-4"></i>
                    </div>
                    <h4 class="mb-3">Imunisasi</h4>
                    <p class="mb-4">Pelayanan kesehatan bagi ibu dan anak-anak, untuk mencegah penyebaran penyakit
                        yang dapat mengancam kesehatan, seperti campak, polio dan hepatitis.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                <div class="service-item bg-light rounded h-100 p-5">
                    <div class="d-inline-flex align-items-center justify-content-center bg-white rounded-circle mb-4" style="width: 65px; height: 65px;">
                        <i class="fa fa-tooth text-primary fs-4"></i>
                    </div>
                    <h4 class="mb-3">Kesehatan Gigi</h4>
                    <p class="mb-4">Memberikan perawatan gigi dan mulut untuk mencegah terjadinya masalah kesehatan
                        gigi yang lebih serius di masa depan</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                <div class="service-item bg-light rounded h-100 p-5">
                    <div class="d-inline-flex align-items-center justify-content-center bg-white rounded-circle mb-4" style="width: 65px; height: 65px;">
                        <i class="fa fa-wheelchair text-primary fs-4"></i>
                    </div>
                    <h4 class="mb-3">Kesehatan Lingkungan</h4>
                    <p class="mb-4">Mengawasi kebersihan lingkungan, sanitasi lingkungan, dan pengawasan penyediaan
                        air bersih untuk mencegah terjadinya penyakit yang disebabkan oleh lingkungan yang tidak sehat
                    </p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                <div class="service-item bg-light rounded h-100 p-5">
                    <div class="d-inline-flex align-items-center justify-content-center bg-white rounded-circle mb-4" style="width: 65px; height: 65px;">
                        <i class="fa fa-brain text-primary fs-4"></i>
                    </div>
                    <h4 class="mb-3">Kesehatan Jiwa</h4>
                    <p class="mb-4">Menyediakan pelayanan kesehatan jiwa konseling dan terapi bagi pasien dengan
                        masalah kesehatan jiwa untuk membantu pasien mengatasi masalah mental dan emosional, seperti
                        stres, depresi dan kecemasan</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                <div class="service-item bg-light rounded h-100 p-5">
                    <div class="d-inline-flex align-items-center justify-content-center bg-white rounded-circle mb-4" style="width: 65px; height: 65px;">
                        <i class="fa fa-vials text-primary fs-4"></i>
                    </div>
                    <h4 class="mb-3">Kesehatan Reproduksi</h4>
                    <p class="mb-4">Memberikan layanan pemeriksaan kehamilan, perawatan pasca persalinan dan
                        konseling tentang kesehatan reproduksi untuk membantu ibu dan pasangan dalam merencanakan
                        keluarga dan menjaga kesehatan reproduksi</p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Service End -->
@endsection
<!-- End #section -->