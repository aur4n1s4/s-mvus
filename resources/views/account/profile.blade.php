@extends('layouts.app')

@section('title', 'Profile')

@section('content')
    @php $auth = Auth::user() @endphp
    <div class="page has-sidebar-left bg-light">
        <header class="white b-b p-3 ">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-1">
                        <img class="d-flex mr-3 height-50 fotoLink" src="{{ asset('backend/img/dummy/u1.png') }}"
                            alt="photo" align="left">
                    </div>
                    <div class="col-11">
                        <h3>
                            {{ $auth->pegawai ? $auth->pegawai->full_name : 'PROFIL' }}
                        </h3>
                        <strong>@ {{ $auth->username }}</strong>
                    </div>
                </div>
            </div>
        </header>

        @if ($auth->pegawai)
            <div class="container-fluid my-3">
                <div id="alert"></div>
                <div class="row">
                    <div class="col-md-12 pr-0">
                        <div class="card no-b">
                            <div class="card-body">
                                <strong><i class="icon icon-user"></i> Profil</strong>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-row form-inline">
                                            <div class="col-md-12">
                                                <div class="form-group m-0">
                                                    <label class="col-form-label s-12 col-md-3">NIK</label>
                                                    <input type="text" name="nik" id="nik" placeholder=""
                                                        class="form-control r-0 light s-12 col-md-7"
                                                        value="{{ $auth->pegawai->nik }}" disabled="disabled" required />
                                                </div>
                                                <div class="form-group m-0">
                                                    <label class="col-form-label s-12 col-md-3">Jenis Kelamin</label>
                                                    <input type="text" name="jk" id="jk" placeholder=""
                                                        class="form-control r-0 light s-12 col-md-7"
                                                        value="{{ $auth->pegawai->jk }}" disabled="disabled" required />
                                                </div>
                                                <div class="form-group m-0">
                                                    <label class="col-form-label s-12 col-md-3">Tempat Lahir</label>
                                                    <input type="text" name="t_lahir" id="t_lahir" placeholder=""
                                                        class="form-control r-0 light s-12 col-md-7"
                                                        value="{{ $auth->pegawai->t_lahir }}" disabled="disabled"
                                                        required />
                                                </div>
                                                <div class="form-group m-0">
                                                    <label class="col-form-label s-12 col-md-3">Tanggal Lahir</label>
                                                    <input type="text" name="d_lahir" id="d_lahir" placeholder=""
                                                        class="form-control r-0 light s-12 col-md-7"
                                                        value="{{ $auth->pegawai->d_lahir }}" disabled="disabled"
                                                        required />
                                                </div>
                                                <div class="form-group m-0">
                                                    <label class="col-form-label s-12 col-md-3">Pekerjaan</label>
                                                    <input type="text" name="pekerjaan" id="pekerjaan" placeholder=""
                                                        class="form-control r-0 light s-12 col-md-7"
                                                        value="{{ $auth->pegawai->pekerjaan }}" disabled="disabled"
                                                        required />
                                                </div>
                                                <div class="form-group m-0">
                                                    <label class="col-form-label s-12 col-md-3">Alamat</label>
                                                    <textarea name="alamat" id="alamat" placeholder="" class="form-control r-0 light s-12 col-md-7" disabled="disabled"
                                                        required>{{ $auth->pegawai->alamat }}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection

@section('script')
    <script type="text/javascript"></script>
@endsection
