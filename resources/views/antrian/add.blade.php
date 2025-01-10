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
                        <h4>
                            <i class="icon icon-users"></i> Tambah {{ $subTitle }}
                        </h4>
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
                    <div id="alert"></div>
                    <div class="card">
                        <div class="card-body">
                            <form class="needs-validation" id="form" method="POST"
                                data-url="{{ route($route . 'store') }}" novalidate>
                                @csrf
                                @method('POST')

                                <div class="col-md-12">
                                    <div class="form-row m-1">
                                        <label for="nik" class="col-form-label s-12 col-md-2">
                                            NIK
                                        </label>
                                        <div class="col-md-10">
                                            <input type="text" name="nik" class="form-control r-0  s-12"
                                                placeholder="Nomor Induk KTP" autocomplete="off" minlength="16"
                                                maxlength="16" required />
                                        </div>
                                    </div>

                                    <div class="form-row m-1">
                                        <label for="pasien" class="col-form-label s-12 col-md-2">
                                            Pasien
                                        </label>
                                        <div class="col-md-10">
                                            <select name="pasien" id="pasien" class="form-control r-0  s-12 m-0"
                                                required>
                                                <option>Pilih</option>
                                                <option value="0">Lama</option>
                                                <option value="1">Baru</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-row m-1 nama" style="display: none">
                                        <label for="nama" class="col-form-label s-12 col-md-2">
                                            Nama
                                        </label>
                                        <div class="col-md-10">
                                            <input type="text" name="nama" id="nama"
                                                class="form-control r-0  s-12" placeholder="Nama pasien" />
                                        </div>

                                    </div>

                                    <div class="form-row m-1 faskes" style="display: none">
                                        <label for="faskes" class="col-form-label s-12 col-md-2">
                                            Jenis Jaminan
                                        </label>
                                        <div class="col-md-10">
                                            <select name="faskes" id="faskes" class="form-control r-0  s-12 m-0">
                                                <option>Pilih</option>
                                                <option value="0">UMUM</option>
                                                <option value="1">BPJS</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-row m-1 bpjs" style="display: none">
                                        <label for="bpjs" class="col-form-label s-12 col-md-2">
                                            BPJS
                                        </label>
                                        <div class="col-md-10">
                                            <input type="bpjs" name="bpjs" id="bpjs"
                                                class="form-control r-0  s-12" />
                                        </div>
                                    </div>

                                    <div class="form-row m-1 alamat" style="display: none">
                                        <label for="alamat" class="col-form-label s-12 col-md-2">
                                            Alamat
                                        </label>
                                        <div class="col-md-10">
                                            <textarea class="form-control r-5  s-12" name="alamat" id="alamat" rows="2"></textarea>
                                        </div>
                                    </div>

                                    <div class="form-row m-1 telepon" style="display: none">
                                        <label for="telepon" class="col-form-label s-12 col-md-2">
                                            Telepon
                                        </label>
                                        <div class="col-md-10">
                                            <input type="text" name="telepon" id="telepon"
                                                class="form-control r-0  s-12" minlength="10" maxlength="14" />
                                        </div>
                                    </div>

                                    <div class="form-row m-1 t_lahir" style="display: none">
                                        <label for="t_lahir" class="col-form-label s-12 col-md-2">
                                            Tanggal Lahir
                                        </label>
                                        <div class="col-md-10">
                                            <input type="date" name="t_lahir" id="t_lahir"
                                                class="form-control date-time-picker r-0  s-12" autocomplete="off" />
                                        </div>
                                    </div>

                                    <div class="form-row m-1 jenis_kelamin" style="display: none">
                                        <label for="jenis_kelamin" class="col-form-label s-12 col-md-2">
                                            Jenis Kelamin
                                        </label>
                                        <div class="col-md-10">
                                            <select name="jenis_kelamin" id="jenis_kelamin"
                                                class="form-control r-0  s-12 m-0">
                                                <option value="">Pilih</option>
                                                <option value="L">Laki-Laki</option>
                                                <option value="P">Perempuan</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-row m-1 tanggal" style="display: none">
                                        <label for="tanggal" class="col-form-label s-12 col-md-2">
                                            Tanggal Kunjungan
                                        </label>
                                        <div class="col-md-10">
                                            <input type="date" name="tanggal"
                                                class="form-control date-time-picker r-0  s-12" autocomplete="off" />
                                        </div>
                                    </div>

                                    <div class="form-row m-1 poli" style="display: none">
                                        <label for="poli" class="col-form-label s-12 col-md-2">
                                            Poliklinik
                                        </label>
                                        <div class="col-md-10">

                                            <select name="poli" id="poli" class="form-control r-0 s-12 filter">
                                                @foreach ($polis as $poli)
                                                    <option value="{{ $poli->id }}">{{ $poli->nama }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                        </div>

                        <div class="col-md-12 my-2">
                            <div class="float-right">
                                <button type="submit" class="btn btn-primary btn-sm" id="action">
                                    <i class="icon-save mr-2"></i>
                                    Simpan
                                </button>
                            </div>
                        </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('backend/js/jquery-fancybox.min.js') }}"></script>
    <script src="{{ asset('backend/js/jquery-confirm.min.js') }}"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('.date-time-picker').datetimepicker({
                format: 'Y-m-d',
                timepicker: false,
            });
        });

        $('#form').on('submit', function(event) {
            event.preventDefault();
            const form = $(this);
            const submitButton = form.find('#action');
            const alert = form.find('#alert');

            if (!form[0].checkValidity()) {
                event.stopPropagation();
            } else {
                alert.html('');
                submitButton.prop('disabled', true);

                $.ajax({
                    url: form.data('url'),
                    type: 'POST',
                    data: new FormData(form[0]),
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        submitButton.prop('disabled', false);

                        var message = response;

                        const alertMessage = `
                                <div role="alert" class="alert alert-success alert-dismissible fade show">
                                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span></button>
                                    <strong>Berhasil!</strong> ${message}
                                </div>
                            `;

                        $('#alert').html(alertMessage);

                        window.location.reload();


                    },
                    error: function(xhr) {
                        $('#action').removeAttr('disabled');
                        $('#status-result').html('');

                        let errorMessages = '';

                        // Cek apakah ada pesan error validasi atau hanya pesan umum
                        if (xhr.responseJSON) {
                            if (xhr.responseJSON.errors) {
                                const errors = xhr.responseJSON.errors;
                                errorMessages = Object.values(errors).map(error =>
                                    `<li>${error}</li>`).join('');
                            } else if (xhr.responseJSON.message) {
                                // Jika tidak ada `errors`, tetapi ada `message`, tampilkan pesan ini
                                errorMessages = `<li>${xhr.responseJSON.message}</li>`;
                            }
                        } else {
                            errorMessages =
                                `<li>Terjadi kesalahan. Silakan coba lagi.</li>`;
                        }

                        // Tampilan pesan error dengan styling yang lebih bersih
                        const alertMessage = `
                                <div role="alert" class="alert alert-danger alert-dismissible fade show">
                                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span></button>
                                    <strong>Kesalahan:</strong> Terdapat kesalahan dalam input data.
                                    <ol class="pl-3 m-0">${errorMessages}</ol>
                                </div>
                            `;

                        $('#alert').html(alertMessage);
                    }
                });
            }
            form.addClass('was-validated');
        });

        $('#pasien').on('change', function() {
            const selected = $(this).find(':selected').val();

            // Reset semua field
            $('.nama, .faskes, .alamat, .telepon, .t_lahir, .jenis_kelamin, .tanggal, .poli').hide().find(
                'input, select').removeAttr('required');

            if (selected == 1) {
                $('.nama, .faskes, .alamat, .telepon, .t_lahir, .jenis_kelamin, .tanggal, .poli').show().find(
                    'input, select').attr('required', true);
            } else if (selected == 0) {
                $('.faskes, .tanggal, .poli').show().find('input, select').attr('required', true);
            } else {
                $('.nama, .faskes, .alamat, .telepon, .t_lahir, .jenis_kelamin, .tanggal, .poli').hide().find(
                    'input, select').removeAttr('required');
            }
        });

        $('#faskes').on('change', function() {
            const selected = $(this).find(':selected').val();

            if (selected == 1) {
                $('.bpjs').show().find('input').attr('required', true);
            } else {
                $('.bpjs').hide().find('input').removeAttr('required');
            }
        });
    </script>
@endsection
