@extends('layouts.main')

@section('post')
    <div class="container-fluid page-header py-5 mb-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container py-5">
            <h1 class="display-3 text-white mb-3 animated slideInDown">Tentang Kami</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb text-uppercase mb-0">
                    <li class="breadcrumb-item"><a class="text-white">Home</a></li>
                    <li class="breadcrumb-item text-primary active" aria-current="page">About</li>
                </ol>
            </nav>
        </div>
    </div>

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
                                    <div class="d-flex flex-shrink-0 align-items-center justify-content-center rounded-circle bg-light"
                                        style="width: 55px; height: 55px;">
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
                                    <div class="d-flex flex-shrink-0 align-items-center justify-content-center rounded-circle bg-light"
                                        style="width: 55px; height: 55px;">
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
                                    <div class="d-flex flex-shrink-0 align-items-center justify-content-center rounded-circle bg-light"
                                        style="width: 55px; height: 55px;">
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
                                    <div class="d-flex flex-shrink-0 align-items-center justify-content-center rounded-circle bg-light"
                                        style="width: 55px; height: 55px;">
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
                        <img class="position-absolute img-fluid w-100 h-100"
                            src="{{ asset('frontend/home/imgs/feature.jpg') }}" style="object-fit: cover;" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
