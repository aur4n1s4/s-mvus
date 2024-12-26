<?php

namespace App\Http\Controllers;

use App\Models\Antrian;
use App\Models\Doctor;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Total pengunjung hari ini
        $pengunjungHariIni = Antrian::whereDate('tanggal', Carbon::now())->count();

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

    public function contact()
    {
        return view('dashboard.contact');
    }
}
