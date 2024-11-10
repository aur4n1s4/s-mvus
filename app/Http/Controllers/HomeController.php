<?php

namespace App\Http\Controllers;

use App\Models\Antrian;
use App\Models\Poli;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $antrian0 = $this->getAntrianByStatus(0);
        $antrian1 = $this->getAntrianByStatus(1);
        $antrian2 = $this->getAntrianByStatus(2);
        $antrian3 = $this->getAntrianByStatus(3);

        $antrianPolis = Poli::withCount([
            'antrians as total',
            'antrians as antrian' => function ($query) {
                $query->where('status', 1);
            }
        ])->get()->map(function ($poli) {
            $color = ['secondary', 'primary', 'success', 'danger'];
            $poli->color = $color[rand(0, 3)];
            return $poli;
        });

        return view('home', compact(
            'antrian0',
            'antrian1',
            'antrian2',
            'antrian3',
            'antrianPolis'
        ));
    }

    private function getAntrianByStatus($status)
    {
        return json_encode(array_replace(
            array_fill(1, 12, 0),
            Antrian::where('status', $status)
                ->selectRaw('MONTH(tanggal) as month, COUNT(*) as count')
                ->groupByRaw('MONTH(tanggal)')
                ->pluck('count', 'month')
                ->toArray()
        ));
    }
}
