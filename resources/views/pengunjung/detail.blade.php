@extends('layouts.app')

@section('title', $title)

@section('style')
    <link rel="stylesheet" href="{{ asset('backend/css/jquery-confirm.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/css/jquery-fancybox.min.css') }}">
@endsection

@section('content')
    <div class="page has-sidebar-left bg-light">
        <header class="blue accent-3 relative nav-sticky">
            <div class="container-fluid text-white">
                <div class="row">
                    <div class="col">
                        <h3 class="my-2">
                            <i class="icon icon-document2"></i> {{ $subTitle }}
                        </h3>
                    </div>
                </div>
                <div class="row">
                    <ul class="nav nav-material nav-material-white responsive-tab" id="v-pills-tab" role="tablist">
                        <li>
                            <a class="nav-link" href="{{ route($route . 'index') }}">
                                <i class="icon icon-arrow_back"></i>Kembali</a>
                        </li>
                    </ul>
                </div>
            </div>
        </header>

        <div class="container-fluid my-1">
            <div class="row">
                <div class="col-md-12 p-2">
                    <div class="card">
                        <div class="card-header text-white bg-primary">
                            <h6>
                                <strong>
                                    Detail - {{ $subTitle }}
                                </strong>
                            </h6>
                        </div>
                        <div class="card-body no-b">
                            <div class="row col-md-12 my-1">
                                <div class="col-md-4 pr-0">
                                    <h6>NIK</h6>
                                </div>
                                <div class="col-md-1 m-0 p-0 text-center">
                                    <h6> : </h6>
                                </div>
                                <div class="col-md-7 text-left pl-0">
                                    <h6>
                                        {{ $pengunjung->nik }}
                                    </h6>
                                </div>
                            </div>

                            <div class="row col-md-12 my-1">
                                <div class="col-md-4 pr-0">
                                    <h6>Nama</h6>
                                </div>
                                <div class="col-md-1 m-0 p-0 text-center">
                                    <h6> : </h6>
                                </div>
                                <div class="col-md-7 text-left pl-0">
                                    <h6>
                                        {{ $pengunjung->nama }}
                                    </h6>
                                </div>
                            </div>

                            <div class="row col-md-12 my-1">
                                <div class="col-md-4 pr-0">
                                    <h6>Telepon</h6>
                                </div>
                                <div class="col-md-1 m-0 p-0 text-center">
                                    <h6> : </h6>
                                </div>
                                <div class="col-md-7 text-left pl-0">
                                    <h6>
                                        {{ $pengunjung->telepon }}
                                    </h6>
                                </div>
                            </div>

                            <div class="row col-md-12 my-1">
                                <div class="col-md-4 pr-0">
                                    <h6>Tanggal Lahir</h6>
                                </div>
                                <div class="col-md-1 m-0 p-0 text-center">
                                    <h6> : </h6>
                                </div>
                                <div class="col-md-7 text-left pl-0">
                                    <h6>
                                        {{ $pengunjung->t_lahir }}
                                    </h6>
                                </div>
                            </div>

                            <div class="row col-md-12 my-1">
                                <div class="col-md-4 pr-0">
                                    <h6>Usia</h6>
                                </div>
                                <div class="col-md-1 m-0 p-0 text-center">
                                    <h6> : </h6>
                                </div>
                                <div class="col-md-7 text-left pl-0">
                                    <h6>
                                        {{ \Carbon\Carbon::parse($pengunjung->t_lahir)->age }}
                                    </h6>
                                </div>
                            </div>

                            <div class="row col-md-12 my-1">
                                <div class="col-md-4 pr-0">
                                    <h6>Jenis Kelamin</h6>
                                </div>
                                <div class="col-md-1 m-0 p-0 text-center">
                                    <h6> : </h6>
                                </div>
                                <div class="col-md-7 text-left pl-0">
                                    <h6>
                                        {{ $pengunjung->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}
                                    </h6>
                                </div>
                            </div>

                            <div class="row col-md-12 my-1">
                                <div class="col-md-4 pr-0">
                                    <h6>Alamat</h6>
                                </div>
                                <div class="col-md-1 m-0 p-0 text-center">
                                    <h6> : </h6>
                                </div>
                                <div class="col-md-7 text-left pl-0">
                                    <div class="text-muted well well-sm no-shadow p-2 r-5">
                                        <small>{{ $pengunjung->alamat }}</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
