@extends('layouts.app')

@section('title', $title)

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/css/jquery-confirm.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/jquery-fancybox.min.css') }}">
@endsection

@section('content')
    <div class="page has-sidebar-left bg-light">
        <header class="blue accent-3 relative nav-sticky">
            <div class="container-fluid text-white">
                <div class="row">
                    <div class="col">
                        <h4>
                            <i class="icon icon-document2"></i> Edit {{ $subTitle }}
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
                                data-url="{{ route($route . 'update', $pengunjung->id) }}" novalidate>
                                @csrf
                                @method('PATCH')

                                <div class="col-md-12">
                                    <div class="form-row m-1">
                                        <label for="nik" class="col-form-label s-12 col-md-2">
                                            NIK <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-md-10">
                                            <input type="text" name="nik" value="{{ $pengunjung->nik }}"
                                                class="form-control r-0 light s-12" minlength="16" maxlength="16"
                                                required />
                                        </div>
                                    </div>

                                    <div class="form-row m-1 text-left">
                                        <label for="nama" class="col-form-label s-12 col-md-2">
                                            Nama <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-md-10">
                                            <input type="text" name="nama" value="{{ $pengunjung->nama }}"
                                                class="form-control r-0 light s-12" required />
                                        </div>
                                    </div>

                                    <div class="form-row m-1">
                                        <label for="telepon" class="col-form-label s-12 col-md-2">
                                            Telepon <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-md-10">
                                            <input type="text" name="telepon" value="{{ $pengunjung->telepon }}"
                                                class="form-control r-0 light s-12" minlength="10" maxlength="14"
                                                required />
                                        </div>
                                    </div>

                                    <div class="form-row m-1">
                                        <label for="jenis_kelamin" class="col-form-label s-12 col-md-2">
                                            Jenis Kelamin <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-md-10">
                                            <select name="jenis_kelamin" class="form-control r-0 light s-12 m-0" required>
                                                <option value="">Pilih</option>
                                                <option value="L" @if ($pengunjung->jenis_kelamin == 'L') selected @endif>
                                                    Laki-laki
                                                </option>
                                                <option value="P" @if ($pengunjung->jenis_kelamin == 'P') selected @endif>
                                                    Perempuan
                                                </option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-row m-1">
                                        <label for="t_lahir" class="col-form-label s-12 col-md-2">
                                            Tanggal Lahir <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-md-10">
                                            <input type="date" name="t_lahir" value="{{ $pengunjung->t_lahir }}"
                                                class="form-control r-0 light s-12" autocomplete="off" required />
                                        </div>
                                    </div>

                                    <div class="form-row m-1">
                                        <label for="alamat" class="col-form-label s-12 col-md-2">
                                            Alamat <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-md-10">
                                            <textarea class="form-control r-5 light s-12" name="alamat" rows="2" required>{{ $pengunjung->alamat }}</textarea>
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
@endsection

@section('script')
    <script src="{{ asset('backend/js/jquery-confirm.min.js') }}"></script>
    <script src="{{ asset('backend/js/jquery-fancybox.min.js') }}"></script>

    <script type="text/javascript">
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

                        var message = response.message;

                        const alertMessage = `
                                <div role="alert" class="alert alert-success alert-dismissible fade show">
                                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span></button>
                                    <strong>Berhasil!</strong> ${message}
                                </div>
                            `;

                        $('#alert').html(alertMessage);

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
    </script>
@endsection
