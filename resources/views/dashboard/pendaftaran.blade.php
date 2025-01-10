@extends('layouts.main')

@section('post')
    <div class="container-fluid page-header py-5 mb-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container py-5">
            <h1 class="display-3 text-white mb-3 animated slideInDown">Pendaftaran</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb text-uppercase mb-0">
                    <li class="breadcrumb-item"><a class="text-white" href="#">Home</a></li>
                    <li class="breadcrumb-item text-primary active" aria-current="page">Pendaftaran</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="container-xxl py-5">
        <div class="container">

            @if (session('success') || session('error'))
                <div class="alert alert-{{ session('success') ? 'success' : 'danger' }} alert-dismissible fade show"
                    role="alert">
                    {{ session('success') ?? session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="row g-4">
                <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s">

                    <div class="bg-light rounded p-5">
                        <ul class="nav nav-tabs" id="pendaftaranTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" id="newPatient-tab" data-bs-toggle="tab" href="#newPatient"
                                    role="tab" aria-controls="newPatient" aria-selected="true">
                                    Pasien Baru

                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="oldPatient-tab" data-bs-toggle="tab" href="#oldPatient"
                                    role="tab" aria-controls="oldPatient" aria-selected="false">
                                    Pasien Lama
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="statusPatient-tab" data-bs-toggle="tab" href="#statusPatient"
                                    role="tab" aria-controls="statusPatient" aria-selected="false">
                                    Status Pendaftaran
                                </a>
                            </li>
                        </ul>

                        <!-- Tab content -->
                        <div class="tab-content" id="pendaftaranTabContent">
                            <!-- Form Pendaftaran Pasien Baru -->
                            <div class="tab-pane fade show active" id="newPatient" role="tabpanel"
                                aria-labelledby="newPatient-tab">
                                <h2 class="mb-4 mt-1">Daftar Sebagai Pasien Baru</h2>
                                <form action="{{ route('pendaftaran.store') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="cform" value="1">
                                    <div class="row g-3">
                                        <div class="col-12">
                                            <div class="form-floating">
                                                <input type="text" name="nik" id="nik" required
                                                    class="form-control @error('nik') is-invalid @enderror"
                                                    placeholder="Nomor Induk Kependudukan" minlength="16" maxlength="16"
                                                    pattern="\d{16}" value="{{ old('nik') }}">
                                                <label for="nik">Nomor Induk Kependudukan</label>
                                                @error('nik')
                                                    <span class="invalid-feedback" role="alert">
                                                        {{ $message }}
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-floating">
                                                <select name="faskes" id="faskes"
                                                    class="form-select border-0 @error('faskes') is-invalid @enderror"
                                                    required>
                                                    <option selected>Pilih Jenis Jaminan</option>
                                                    <option value="0">Umum</option>
                                                    <option value="1">BPJS</option>
                                                </select>
                                                @error('faskes')
                                                    <span class="invalid-feedback" role="alert">
                                                        {{ $message }}
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-12 bpjs" style="display: none">
                                            <div class="form-floating">
                                                <input type="text" name="bpjs" id="bpjs"
                                                    class="form-control @error('bpjs') is-invalid @enderror"
                                                    placeholder="Nomor BPJS" value="{{ old('bpjs') }}">
                                                <label for="bpjs">Nomor BPJS</label>
                                                @error('bpjs')
                                                    <span class="invalid-feedback" role="alert">
                                                        {{ $message }}
                                                    </span>
                                                @enderror
                                            </div>
                                            <small class="text-muted">Pastikan BPJS anda di Puskesmas Pondok Benda</small>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-floating">
                                                <input type="text" name="nama" id="nama" required
                                                    class="form-control @error('nama') is-invalid @enderror"
                                                    placeholder="Nama Anda" value="{{ old('nama') }}">
                                                <label for="nama">Nama Anda</label>
                                                @error('nama')
                                                    <span class="invalid-feedback" role="alert">
                                                        {{ $message }}
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-floating">
                                                <textarea name="alamat" id="alamat" required class="form-control @error('alamat') is-invalid @enderror"
                                                    placeholder="Alamat Lengkap Anda" style="height: 100px">{{ old('alamat') }}</textarea>
                                                <label for="alamat">Alamat</label>
                                                @error('alamat')
                                                    <span class="invalid-feedback" role="alert">
                                                        {{ $message }}
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <input type="text" name="telepon" id="telepon" required
                                                    class="form-control @error('telepon') is-invalid @enderror"
                                                    placeholder="Telepon" value="{{ old('telepon') }}">
                                                <label for="telepon">Telepon</label>
                                                @error('telepon')
                                                    <span class="invalid-feedback" role="alert">
                                                        {{ $message }}
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-floating">
                                                <input type="date"
                                                    class="form-control @error('t_lahir') is-invalid @enderror"
                                                    id="t_lahir" name="t_lahir" required value="{{ old('t_lahir') }}">
                                                <label for="t_lahir">Tanggal Lahir</label>
                                                @error('t_lahir')
                                                    <span class="invalid-feedback" role="alert">
                                                        {{ $message }}
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-floating">
                                                <select name="jenis_kelamin" id="jenis_kelamin"
                                                    class="form-select border-0 @error('jenis_kelamin') is-invalid @enderror"
                                                    required>
                                                    <option selected>Pilih Jenis Kelamin</option>
                                                    <option value="P">Perempuan</option>
                                                    <option value="L">Laki-Laki</option>
                                                </select>
                                                @error('jenis_kelamin')
                                                    <span class="invalid-feedback" role="alert">
                                                        {{ $message }}
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-floating">
                                                <input required type="date"
                                                    class="form-control @error('tgl_kunjung') is-invalid @enderror"
                                                    id="tgl_kunjung" name="tgl_kunjung"
                                                    min="{{ Carbon\Carbon::now()->format('Y-m-d') }}"
                                                    value="{{ old('tgl_kunjung') }}">
                                                <label for="tgl_kunjung">Tanggal Kunjungan</label>

                                                @error('tgl_kunjung')
                                                    <span class="invalid-feedback" role="alert">
                                                        {{ $message }}
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-floating">
                                                <select name="poli_id" id="poli_id"
                                                    class="form-select border-1 @error('poli_id') is-invalid @enderror"
                                                    required>
                                                    <option selected>Pilih Poli</option>
                                                    @foreach ($polis as $p)
                                                        <option value="{{ $p->id }}">{{ $p->nama }}</option>
                                                    @endforeach
                                                </select>
                                                @error('poli_id')
                                                    <span class="invalid-feedback" role="alert">
                                                        {{ $message }}
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <button class="btn btn-primary w-100 py-3" type="submit">Daftar
                                                Sekarang</button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <!-- Form Pendaftaran Pasien Lama -->
                            <div class="tab-pane fade" id="oldPatient" role="tabpanel" aria-labelledby="oldPatient-tab">
                                <h2 class="mb-4 mt-1">Daftar Sebagai Pasien Lama</h2>
                                <form action="{{ route('pendaftaran.store') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="cform" value="2">
                                    <div class="row g-3">
                                        <div class="col-12">
                                            <div class="form-floating">
                                                <input type="text" name="nik" id="nik_lama" required
                                                    class="form-control @error('nik') is-invalid @enderror"
                                                    placeholder="Nomor Induk Kependudukan" minlength="16" maxlength="16"
                                                    pattern="\d{16}" value="{{ old('nik') }}">
                                                <label for="nik_lama">Nomor Induk Kependudukan</label>
                                                @error('nik')
                                                    <span class="invalid-feedback" role="alert">
                                                        {{ $message }}
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-floating">
                                                <select name="faskes" id="faskes_lama"
                                                    class="form-select border-0 @error('faskes') is-invalid @enderror"
                                                    required>
                                                    <option selected>Pilih Jenis Jaminan</option>
                                                    <option value="0">Umum</option>
                                                    <option value="1">BPJS</option>
                                                </select>
                                                @error('faskes')
                                                    <span class="invalid-feedback" role="alert">
                                                        {{ $message }}
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-12 bpjs_lama" style="display: none">
                                            <div class="form-floating">
                                                <input type="text" name="bpjs" id="bpjs_nama"
                                                    class="form-control @error('bpjs') is-invalid @enderror"
                                                    placeholder="Nomor BPJS" value="{{ old('bpjs') }}">
                                                <label for="bpjs_lama">Nomor BPJS</label>
                                                @error('bpjs')
                                                    <span class="invalid-feedback" role="alert">
                                                        {{ $message }}
                                                    </span>
                                                @enderror
                                            </div>
                                            <small class="text-muted">Pastikan BPJS anda di Puskesmas Pondok Benda</small>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-floating">
                                                <input required type="date"
                                                    class="form-control @error('tgl_kunjung') is-invalid @enderror"
                                                    id="tgl_kunjung_lama" name="tgl_kunjung"
                                                    min="{{ Carbon\Carbon::now()->format('Y-m-d') }}"
                                                    value="{{ old('tgl_kunjung') }}">
                                                <label for="tgl_kunjung_lama">Tanggal Kunjungan</label>

                                                @error('tgl_kunjung')
                                                    <span class="invalid-feedback" role="alert">
                                                        {{ $message }}
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-floating">
                                                <select name="poli_id" id="poli_id_lama"
                                                    class="form-select border-1 @error('poli_id') is-invalid @enderror"
                                                    required>
                                                    <option selected>Pilih Poli</option>
                                                    @foreach ($polis as $p)
                                                        <option value="{{ $p->id }}">{{ $p->nama }}</option>
                                                    @endforeach
                                                </select>
                                                @error('poli_id')
                                                    <span class="invalid-feedback" role="alert">
                                                        {{ $message }}
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <button class="btn btn-primary w-100 py-3" type="submit">Daftar</button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <!-- Status Pendaftaran -->
                            <div class="tab-pane fade" id="statusPatient" role="tabpanel"
                                aria-labelledby="statusPatient-tab">
                                <h2 class="mb-4 mt-1">Cek Status Pendaftaran Anda</h2>
                                <form id="form-status" data-url="{{ route('pendaftaran.status') }}" method="POST">
                                    @csrf
                                    <div id="alert"></div>
                                    <div class="row g-3">
                                        <div class="col-12">
                                            <div class="form-floating">
                                                <input type="text" name="nik" id="nik_lama" required
                                                    class="form-control @error('nik') is-invalid @enderror"
                                                    placeholder="Nomor Induk Kependudukan" minlength="16" maxlength="16"
                                                    pattern="\d{16}" value="{{ old('nik') }}">
                                                <label for="nik_lama">Nomor Induk Kependudukan</label>
                                                @error('nik')
                                                    <span class="invalid-feedback" role="alert">
                                                        {{ $message }}
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-floating">
                                                <input required type="date"
                                                    class="form-control @error('tgl_kunjung') is-invalid @enderror"
                                                    id="tgl_kunjung_lama" name="tgl_kunjung"
                                                    min="{{ Carbon\Carbon::now()->format('Y-m-d') }}"
                                                    value="{{ old('tgl_kunjung') }}">
                                                <label for="tgl_kunjung_lama">Tanggal Kunjungan</label>

                                                @error('tgl_kunjung')
                                                    <span class="invalid-feedback" role="alert">
                                                        {{ $message }}
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <button type="submit" id="action" class="btn btn-primary w-100 py-3">Cek
                                                Status</button>
                                        </div>
                                    </div>
                                </form>

                                <div id="status-result" class="mt-3"></div>

                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                    <div class="h-100" style="min-height: 400px;">
                        <div class="position-relative h-100">
                            <img class="position-absolute img-fluid w-100 h-100"
                                src="{{ asset('frontend/home/img/feature.jpg') }}" style="object-fit: cover;"
                                alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        $('#form-status').on('submit', function(event) {
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

                        $('#status-result').html(`
                                 <div class="alert alert-info">
                                    <h4>Informasi Antrian:</h4>
                                    <p>Nomor Antrian: ${response.data.nomor}</p>
                                    <p>Tanggal: ${response.data.tanggal}</p>
                                    <p>Status: ${response.data.status}</p>
                                    <p>Poliklinik: ${response.data.poli}</p>
                                    <a href="${response.data.link}" target='_blank'>Cetak Antrian</a>
                                </div>
                                `);
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
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    <strong>Error:</strong> Terdapat kesalahan dalam input data.
                                    <ol class="pl-3 m-0">${errorMessages}</ol>
                                </div>
                            `;

                        $('#alert').html(alertMessage);
                    }
                });
            }
            form.addClass('was-validated');
        });

        $('#faskes').on('change', function() {
            const selected = $(this).find(':selected').val();

            if (selected == 1) {
                $('.bpjs').show();
            } else {
                $('.bpjs').hide();
            }
        });
        $('#faskes_lama').on('change', function() {
            const selected = $(this).find(':selected').val();

            if (selected == 1) {
                $('.bpjs_lama').show();
            } else {
                $('.bpjs_lama').hide();
            }
        });
    </script>
@endsection
