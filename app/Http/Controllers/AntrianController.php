<?php

namespace App\Http\Controllers;

use App\Models\Antrian;
use App\Models\Poli;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class AntrianController extends Controller
{
    protected $route = 'antrian.';
    protected $view = 'antrian.';
    protected $title = 'Antrian';
    protected $subTitle = 'Antrian Pasien';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $route    = $this->route;
        $title    = $this->title;
        $subTitle = $this->subTitle;

        $polis  = Poli::all();

        return view($this->view . 'index', compact('route', 'title', 'subTitle', 'polis'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function api(Request $request)
    {
        $statusPriority = [
            3 => 1, // Ditolak
            2 => 2, // Selesai
            1 => 3, // Dalam Pemeriksaan
            0 => 4, // Menunggu
        ];

        $antrians = Antrian::with(['pengunjung', 'poli'])
            ->where('poli_id', $request->poli)
            ->when(empty($request->tanggal), function ($q) {
                $q->whereDate('tanggal', Carbon::now());
            }, function ($q) use ($request) {
                $q->whereDate('tanggal', Carbon::parse($request->tanggal));
            })
            ->orderByRaw("CASE 
                            WHEN status = 3 THEN 3 -- Ditolak
                            WHEN status = 2 THEN 2 -- Selesai
                            ELSE 1 -- Menunggu dan Dalam proses
                        END,
                        no_antrian ASC")
            ->get();

        return DataTables::of($antrians)
            ->addIndexColumn()
            ->addColumn('action', function ($p) {
                $btnEdit = "<a href='#' onclick='edit(this)' title='Edit' data-url='" . route($this->route . 'edit', $p->id) . "'><i class='icon icon-pencil text-blue mr-1'></i></a>";

                $btnDelete = "<a onclick='remove(this)' title='Hapus' data-url='" . route($this->route . 'destroy', $p->id) . "'><i class='icon icon-remove text-red ml-1'></i></a>";

                return $btnEdit . $btnDelete;
            })
            ->editColumn('no_antrian', function ($p) {
                return "<span class='badge badge-primary'>" . $p->no_antrian . "</span>";
            })
            ->addColumn('status', function ($p) use ($antrians) {
                $url = route('antrian.status', $p->id);

                $select0 = $p->status == 0 ? 'selected' : '';
                $select1 = $p->status == 1 ? 'selected' : '';
                $select2 = $p->status == 2 ? 'selected' : '';

                // $disabled2 = $p->status == 2 ? 'disabled' : '';

                // $disabled = $antrians->where('no_antrian', '<', $p->no_antrian)
                //     ->whereIn('status', [0, 1])
                //     ->isNotEmpty() ? 'disabled' : '';

                $disabled = (in_array($p->status, [2, 3]) || $antrians->filter(function ($antrian) use ($p) {
                    return $antrian->no_antrian < $p->no_antrian && in_array($antrian->status, [0, 1]);
                })->isNotEmpty()) ? 'disabled' : '';

                $statusOptions = '';

                if ($p->status == 0) {
                    $statusOptions = <<<HTML
                        <option value="0" $select0>Menunggu</option>
                        <option value="1" $select1>Dalam Pemeriksaan</option>
                        <option value="3" $select2>Ditolak</option>
                    HTML;
                } else if ($p->status == 1) {
                    $statusOptions = <<<HTML
                        <option value="1" $select1>Dalam Pemeriksaan</option>
                        <option value="2" $select2>Selesai</option>
                    HTML;
                } else if ($p->status == 2) {
                    $statusOptions = <<<HTML
                        <option>Selesai</option>
                    HTML;
                } else if ($p->status == 3) {
                    $statusOptions = <<<HTML
                        <option>Ditolak</option>
                    HTML;
                } else {
                    $statusOptions = <<<HTML
                        <option>-</option>
                    HTML;
                }

                $status = <<<HTML
                    <select class="form-control r-5 s-12" id="status" data-url="$url" $disabled>$statusOptions</select>
                HTML;
                return $status;
            })
            ->addColumn('call_pasien', function ($p) {
                // Ambil nama pasien dan nama poliklinik
                $text = $p->pengunjung->nama . ' - ' . $p->poli->nama;

                if ($p->status == 0) {
                    return '<a onclick="panggilPasien(\'' . $text . '\')" title="Panggil pasien"><i class="icon icon-volume-up text-red ml-1"></i></a>';
                } else {
                    return '<i class="icon icon-volume-up ml-1"></i>';
                }
            })
            ->rawColumns(['action', 'no_antrian', 'status', 'call_pasien'])
            ->toJson();
    }

    public function status(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:0,1,2,3',
        ]);

        // Cari data antrian berdasarkan ID
        $antrian = Antrian::findOrFail($id);

        // Update status
        $antrian->status = $request->status;
        $antrian->save();

        return response()->json([
            'status' => true,
            'message' => 'Status berhasil diperbarui',
            'data' => [
                'status' => $antrian->status,
            ]
        ]);
    }
}
