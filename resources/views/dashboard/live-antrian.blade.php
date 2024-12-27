@extends('layouts.main')

@section('post')
<div class="container-fluid page-header py-5 mb-5 wow fadeIn" data-wow-delay="0.1s">
    <div class="container py-5">
        <h1 class="display-3 text-white mb-3 animated slideInDown">Live Antrian</h1>
        <nav aria-label="breadcrumb animated slideInDown">
            <ol class="breadcrumb text-uppercase mb-0">
                <li class="breadcrumb-item"><a class="text-white">Home</a></li>
                <li class="breadcrumb-item text-primary active" aria-current="page">Live Antrian</li>
            </ol>
        </nav>
    </div>
</div>

<div class="container-xxl py-2">
    <div class="container">
        <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
            <p class="d-inline-block border rounded-pill py-1 px-4">Live Antrian</p>
            <h3>
                <span id="hari"></span>
                <span id="tgl"></span>
                <span id="bulan"></span>
                <span id="tahun"></span>
            </h3>
            <h4>
                <span id="jam"></span>:<span id="menit"></span>:<span id="detik"></span>
            </h4>
        </div>
        <div class="row g-4 text-center">
            @foreach ($antrianPolis as $key => $poli)
            <div class="col-lg-4 col-md-6 mb-4" id="poli-{{ $poli->id }}">
                <div class="service-item bg-white shadow-lg rounded h-100 p-4 position-relative" style="border-top: 4px solid {{ $poli->current_antrian > 0 ? '#28a745' : '#dc3545' }};">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="text-uppercase text-dark fw-bold">{{ strtoupper($poli->nama) }}</h4>
                        <span class="badge {{ $poli->current_antrian > 0 ? 'bg-success' : 'bg-danger' }} p-2 status-badge">
                            {{ $poli->current_antrian > 0 ? 'Aktif' : 'Tidak Aktif' }}
                        </span>
                    </div>
                    <div class="d-inline-flex align-items-center justify-content-center bg-light rounded-circle shadow-sm mb-4" style="width: 90px; height: 90px;">
                        <h2 class="mb-0 fw-bold text-primary current-antrian">{{ sprintf('%03s', $poli->current_antrian) }}</h2>
                    </div>
                    <div class="text-center">
                        <p class="mb-2 fs-5 text-secondary">Total Antrian</p>
                        <p class="fw-bold text-dark fs-3 total-antrian">{{ sprintf('%03s', $poli->total_antrian) }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection

@section('script')
<script type="text/javascript">
    function addZero(i) {
        return i < 10 ? "0" + i : i;
    }

    function updateDateTime() {
        const now = new Date();

        // Waktu
        document.getElementById("jam").textContent = addZero(now.getHours());
        document.getElementById("menit").textContent = addZero(now.getMinutes());
        document.getElementById("detik").textContent = addZero(now.getSeconds());

        // Hari
        const arrHari = ["Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jum'at", "Sabtu"];
        document.getElementById("hari").textContent = arrHari[now.getDay()];

        // Tanggal
        document.getElementById("tgl").textContent = now.getDate();

        // Bulan
        const arrBulan = [
            "Januari", "Februari", "Maret", "April", "Mei", "Juni",
            "Juli", "Agustus", "September", "Oktober", "November", "Desember"
        ];
        document.getElementById("bulan").textContent = arrBulan[now.getMonth()];

        // Tahun
        document.getElementById("tahun").textContent = now.getFullYear();
    }

    // Perbarui waktu setiap detik
    setInterval(updateDateTime, 1000);

    // Set waktu awal saat halaman dimuat
    updateDateTime();


    function updateAntrian() {
        $.ajax({
            url: "{{ route('live-antrian.data') }}", // Ganti dengan endpoint API Anda
            method: 'GET',
            success: function(response) {
                response.forEach(function(poli) {
                    // Cek jika antrian ada dan ganti nilai elemen yang sesuai
                    var poliElement = $("#poli-" + poli.id);

                    // Update nomor antrian
                    poliElement.find(".current-antrian").text(poli.current_antrian > 0 ? sprintf('%03', poli.current_antrian) : '---');

                    // Update status badge
                    if (poli.current_antrian > 0) {
                        poliElement.find(".status-badge").removeClass('bg-danger').addClass('bg-success').text('Aktif');
                        poliElement.find(".status-text").text('Aktif');
                        poliElement.find(".service-item").css('border-top', '4px solid #28a745');
                    } else {
                        poliElement.find(".status-badge").removeClass('bg-success').addClass('bg-danger').text('Tidak Aktif');
                        poliElement.find(".status-text").text('Tidak Aktif');
                        poliElement.find(".service-item").css('border-top', '4px solid #dc3545');
                    }

                    // Update total antrian
                    poliElement.find(".total-antrian").text(sprintf('%03', poli.total_antrian));
                });
            },
            error: function() {
                console.log('Terjadi kesalahan saat mengambil data.');
            }
        });
    }

    // Panggil fungsi updateAntrian setiap 5 detik (5000ms)
    setInterval(updateAntrian, 5000);

    // Panggil sekali saat halaman dimuat
    $(document).ready(function() {
        updateAntrian();
    });

    // Format number with leading zero if less than 100
    function sprintf(fmt, val) {
        val = val.toString(); // Convert val to string if it's not already
        return fmt.replace(/%(\d+)/g, function(_, len) {
            len = parseInt(len, 10); // Ensure len is an integer
            return val.padStart(len, '0'); // Pad the string to the desired length
        });
    }
</script>
@endsection