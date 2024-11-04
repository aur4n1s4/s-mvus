<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Antrian</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .content {
            font-size: 14px;
        }

        .antrian-info {
            margin: 20px 0;
        }

        .status {
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="header">
        <h2>Cetak Antrian</h2>
    </div>
    <div class="content">
        <p>Nomor Antrian: <strong>{{ $antrian->no_antrian }}</strong></p>
        <p>Tanggal Kunjungan: <strong>{{ \Carbon\Carbon::parse($antrian->tanggal)->format('d-m-Y') }}</strong></p>
        <p>Poliklinik: <strong>{{ $antrian->poli->nama }}</strong></p>
        <p>Status:
            <strong class="status">
                @if ($antrian->status == 1)
                    Dalam pemeriksaan
                @elseif ($antrian->status == 2)
                    Selesai pemeriksaan
                @else
                    Menunggu
                @endif
            </strong>
        </p>
    </div>
    <hr>
    <p>Terima kasih telah mendaftar. Harap simpan antrian ini untuk keperluan pemeriksaan Anda.</p>
</body>

</html>
