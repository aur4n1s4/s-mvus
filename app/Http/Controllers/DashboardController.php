<?php

namespace App\Http\Controllers;

use App\Models\Antrian;
use App\Models\Doctor;
use App\Models\Poli;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Total pengunjung hari ini
        $pengunjungHariIni = Antrian::whereDate('tanggal', Carbon::today())->count();

        // Total pengunjung besok
        $pengunjungBesok = Antrian::whereDate('tanggal', Carbon::tomorrow())->count();

        // Mendapatkan awal dan akhir minggu ini
        $startOfWeek = Carbon::now()->startOfWeek(); // Senin
        $endOfWeek = Carbon::now()->endOfWeek();    // Minggu

        // Query total antrean minggu ini
        $totalPengunjung = Antrian::whereBetween('tanggal', [$startOfWeek, $endOfWeek])->count();

        return view('dashboard.index', compact('pengunjungHariIni', 'pengunjungBesok', 'totalPengunjung'));
    }

    public function about()
    {
        return view('dashboard.about');
    }

    public function service()
    {
        return view('dashboard.service');
    }

    public function dokter()
    {
        $doctors = Doctor::all();

        return view('dashboard.dokter', compact('doctors'));
    }

    public function liveAntrian()
    {
        $antrianPolis = Poli::withCount([
            'antrians as total_antrian' => function ($query) {
                $query->whereDate('tanggal', Carbon::today()); // Hitung total antrian untuk hari ini
            }
        ])->with([
            'antrians' => function ($query) {
                $query->where('status', 1)
                    ->whereDate('tanggal', Carbon::today()) // Filter untuk tanggal hari ini
                    ->select('id', 'poli_id', 'no_antrian');
            },
            'antriansSelesai' => function ($query) {
                $query->where('status', 2)
                    ->whereDate('tanggal', Carbon::today())
                    ->orderBy('no_antrian', 'desc');
            }
        ])->get()->map(function ($poli) {
            $color = ['secondary', 'primary', 'success', 'danger'];
            $poli->color = $color[rand(0, 3)];

            // Ambil current_antrian dari antrians
            $poli->current_antrian = $poli->antrians->pluck('no_antrian')->first() ?? 0;

            // Ambil last_antrian_selesai dari antriansSelesai
            $poli->last_antrian_selesai = $poli->antriansSelesai->pluck('no_antrian')->first() ?? 0;

            // Jika current_antrian = 0, gunakan last_antrian_selesai
            if ($poli->current_antrian == 0) {
                $poli->current_antrian = $poli->last_antrian_selesai;
            }

            return $poli;
        });


        // Tambahkan total keseluruhan
        $totalAntrian = $antrianPolis->sum('total_antrian');

        $antrianPolis->push((object)[
            'id' => -1,
            'nama' => 'total',
            'keterangan' => 'Total',
            'created_at' => now(),
            'updated_at' => now(),
            'total_antrian' => $totalAntrian,
            'color' => 'danger',
            'current_antrian' => 0,
            'antrians' => collect([]),
        ]);

        // return $antrianPolis;

        return view('dashboard.live-antrian', compact('antrianPolis'));
    }

    public function antrianApi()
    {
        $antrianPolis = Poli::withCount([
            'antrians as total_antrian' => function ($query) {
                $query->whereDate('tanggal', Carbon::today()); // Hitung total antrian untuk hari ini
            }
        ])->with([
            'antrians' => function ($query) {
                $query->where('status', 1)
                    ->whereDate('tanggal', Carbon::today()) // Filter untuk tanggal hari ini
                    ->select('id', 'poli_id', 'no_antrian');
            },
            'antriansSelesai' => function ($query) {
                $query->where('status', 2)
                    ->whereDate('tanggal', Carbon::today())
                    ->orderBy('no_antrian', 'desc');
            }
        ])->get()->map(function ($poli) {
            $color = ['secondary', 'primary', 'success', 'danger'];
            $poli->color = $color[rand(0, 3)];

            // Ambil current_antrian dari antrians
            $poli->current_antrian = $poli->antrians->pluck('no_antrian')->first() ?? 0;

            // Ambil last_antrian_selesai dari antriansSelesai
            $poli->last_antrian_selesai = $poli->antriansSelesai->pluck('no_antrian')->first() ?? 0;

            // Jika current_antrian = 0, gunakan last_antrian_selesai
            if ($poli->current_antrian == 0) {
                $poli->current_antrian = $poli->last_antrian_selesai;
            }

            return $poli;
        });

        // Tambahkan total keseluruhan
        $totalAntrian = $antrianPolis->sum('total_antrian');

        $antrianPolis->push((object)[
            'id' => -1,
            'nama' => 'total',
            'keterangan' => 'Total',
            'created_at' => now(),
            'updated_at' => now(),
            'total_antrian' => $totalAntrian,
            'color' => 'danger',
            'current_antrian' => 0,
            'antrians' => collect([]),
        ]);

        return response()->json($antrianPolis);
    }
    public function contact()
    {
        return view('dashboard.contact');
    }
}
