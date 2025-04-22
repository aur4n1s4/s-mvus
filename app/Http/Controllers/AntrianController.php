<?php

namespace App\Http\Controllers;

use App\Models\Antrian;
use App\Models\Pengunjung;
use App\Models\Poli;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
        $route    = $this->route;
        $title    = $this->title;
        $subTitle = $this->subTitle;

        $polis  = Poli::all();

        return view($this->view . 'add', compact('route', 'title', 'subTitle', 'polis'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'nik'           => 'required',
            'pasien'        => 'required|in:0,1',
            'nama'          => 'required_if:pasien,1',
            'faskes'        => 'required_if:pasien,1|required_if:pasien,0|in:0,1',
            'alamat'        => 'required_if:pasien,1',
            'telepon'       => 'required_if:pasien,1',
            't_lahir'       => 'required_if:pasien,1',
            'jenis_kelamin' => 'required_if:pasien,1',
            'tanggal'       => 'required',
            'poli'          => 'required|exists:polis,id',
            'bpjs'          => 'required_if:faskes,1',
        ]);

        // Arahkan pengunjung ke form pendaftaran pasien lama
        if ($request->pasien == 0 && !Pengunjung::where('nik', $request->nik)->exists()) {
            return response('Nik belum terdaftar, silahkan mengisi form pasien baru.', 404);
        }

        // Mengecek registasi pasien lama
        if ($request->pasien == 1 && Pengunjung::where('nik', $request->nik)->exists()) {
            return redirect('NIK sudah terdaftar, silakan mengisi form pasien lama.', 400);
        }

        // Mengecek pengunjung yang membuat antrian di tanggal yang sama
        $exists = Antrian::whereHas('pengunjung', function ($query) use ($request) {
            $query->where('nik', $request->nik);
        })
            ->whereDate('tanggal', $request->tanggal)
            ->exists();

        if ($exists) {
            return response('Pengunjung dengan NIK yang sama sudah terdaftar hari ini.', 422);
        }

        try {
            DB::beginTransaction();

            $noAntrian = (Antrian::where('poli_id', $request->poli_id)->whereDate('tanggal', $request->tanggal)->max('no_antrian') ?? 0) + 1;

            $pengunjung = Pengunjung::where('nik', $request->nik)->first();

            if ($pengunjung == null) {
                $pengunjung = Pengunjung::create([
                    'nik'           => $request->nik,
                    'nama'          => $request->nama,
                    'alamat'        => $request->alamat,
                    'telepon'       => $request->telepon,
                    't_lahir'       => $request->t_lahir,
                    'jenis_kelamin' => $request->jenis_kelamin,
                ]);
            }

            $pengunjung->antrians()->create([
                'no_antrian'   => $noAntrian,
                'tanggal'      => $request->tanggal,
                'status'       => 0,
                'poli_id'      => $request->poli,
                'faskes'       => $request->faskes,
                'bpjs'         => $request->bpjs
            ]);

            DB::commit();
            return response('Antrian berhasil dibuat!');
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
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
        $route    = $this->route;
        $title    = $this->title;
        $subTitle = $this->subTitle;

        $antrian  = Antrian::with('pengunjung')->whereid($id)->first();
        $polis  = Poli::all();

        return view($this->view . 'edit', compact('route', 'title', 'subTitle', 'antrian', 'polis'));
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
        $this->validate($request, [
            'faskes' => 'required|in:0,1',
            'tanggal' => 'required',
            'poli' => 'required'
        ]);

        // Menemukan antrian berdasarkan ID
        $antrian = Antrian::find($id);

        if (!$antrian) {
            return response('Antrian tidak ditemukan.', 404);
        }

        // Mengecek jika pasien ingin melakukan reschedule pada tanggal yang sama
        $exists = Antrian::whereHas('pengunjung', function ($query) use ($request) {
            $query->where('nik', $request->nik);
        })
            ->whereDate('tanggal', $request->tanggal)
            ->where('id', '!=', $id) // Menghindari konflik dengan antrian yang sedang diupdate
            ->exists();

        if ($exists) {
            return response('Pengunjung dengan NIK yang sama sudah terdaftar di tanggal ini.', 422);
        }

        // Jika pasien ingin di-reschedule, perbarui data antrian
        try {
            DB::beginTransaction();

            // Menentukan nomor antrian baru berdasarkan poli dan tanggal yang sama
            $noAntrian = (Antrian::where('poli_id', $request->poli)
                ->whereDate('tanggal', $request->tanggal)
                ->max('no_antrian') ?? 0) + 1;

            // Update data antrian
            $antrian->update([
                'no_antrian'   => $noAntrian,
                'tanggal'      => $request->tanggal,
                'status'       => 0, // Status bisa diubah sesuai kebutuhan (misal: 0 untuk pending)
                'poli_id'      => $request->poli,
                'faskes'       => $request->faskes,
                'bpjs'         => $request->bpjs // Biarkan tidak berubah jika BPJS tidak diinput
            ]);

            DB::commit();
            return response('Antrian berhasil di-update!');
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return Antrian::find($id)->delete();
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
                $btnEdit = "<a href='" . route($this->route . 'edit', $p->id) . "' title='Edit'><i class='icon icon-pencil text-blue mr-1'></i></a>";

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
                $text = $p->pengunjung->nama . ' Nomor Antrian' . $this->angkaKeKata($p->no_antrian);

                if ($p->status == 0) {
                    return '<a onclick="panggilPasien(\'' . $text . '\')" title="Panggil pasien"><i class="icon icon-volume-up text-red ml-1"></i></a>';
                } else {
                    return '<i class="icon icon-volume-up ml-1"></i>';
                }
            })
            ->editColumn('jaminan', function ($p) {
                if ($p->faskes == 1) {
                    return "<span class='badge badge-success'>BPJS</span>";
                } else {
                    return "<span class='badge badge-primary'>UMUM</span>";
                }
            })
            ->rawColumns(['action', 'no_antrian', 'status', 'call_pasien', 'jaminan'])
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

    private
    function angkaKeKata($angka)
    {
        $huruf = [
            "", "satu", "dua", "tiga", "empat", "lima",
            "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas"
        ];

        if ($angka < 12) {
            return $huruf[$angka];
        } elseif ($angka < 20) {
            return $this->angkaKeKata($angka - 10) . " belas";
        } elseif ($angka < 100) {
            return $this->angkaKeKata(intval($angka / 10)) . " puluh " . $this->angkaKeKata($angka % 10);
        } elseif ($angka < 200) {
            return "seratus " . $this->angkaKeKata($angka - 100);
        } elseif ($angka < 1000) {
            return $this->angkaKeKata(intval($angka / 100)) . " ratus " . $this->angkaKeKata($angka % 100);
        } elseif ($angka < 2000) {
            return "seribu " . $this->angkaKeKata($angka - 1000);
        } elseif ($angka < 1000000) {
            return $this->angkaKeKata(intval($angka / 1000)) . " ribu " . $this->angkaKeKata($angka % 1000);
        } elseif ($angka < 1000000000) {
            return $this->angkaKeKata(intval($angka / 1000000)) . " juta " . $this->angkaKeKata($angka % 1000000);
        } else {
            return "Angka terlalu besar";
        }
    }
}
