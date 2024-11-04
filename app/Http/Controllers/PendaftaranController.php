<?php

namespace App\Http\Controllers;

use App\Models\Antrian;
use App\Models\Pengunjung;
use App\Models\Poli;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PendaftaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $polis = Poli::all();

        return view('dashboard.pendaftaran', compact('polis'));
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
        $this->validate($request, [
            'nik'           => 'required|digits:16',
            'nama'          => 'required_if:cform,1|string|max:255',
            'alamat'        => 'required_if:cform,1|string|max:500',
            'telepon'       => 'required_if:cform,1|numeric|digits_between:10,15',
            't_lahir'       => 'required_if:cform,1|date_format:Y-m-d',
            'jenis_kelamin' => 'required_if:cform,1|in:L,P',
            'tgl_kunjung'   => 'required|date_format:Y-m-d',
            'poli_id'       => 'required|exists:polis,id'
        ]);

        // Arahkan pengunjung ke form pendaftaran pasien lama
        if ($request->cform == 1 && Pengunjung::where('nik', $request->nik)->exists()) {
            return redirect()
                ->back()
                ->with('error', 'NIK sudah terdaftar, silakan mengisi form pasien lama.');
        }

        // Mengecek pengunjung yang membuat antrian di tanggal yang sama
        $exists = Antrian::whereHas('pengunjung', function ($query) use ($request) {
            $query->where('nik', $request->nik);
        })
            ->whereDate('tanggal', $request->tgl_kunjung)
            ->exists();

        if ($exists) {
            return redirect()
                ->back()
                ->with('error', 'Pengunjung dengan NIK yang sama sudah terdaftar hari ini.');
        }

        try {
            DB::beginTransaction();

            $noAntrian = (Antrian::where('poli_id', $request->poli_id)->whereDate('tanggal', $request->tgl_kunjung)->max('no_antrian') ?? 0) + 1;

            $pengunjung = Pengunjung::where('nik', $request->nik)->first();

            if ($pengunjung == null) {
                $pengunjung = Pengunjung::create([
                    'nik'           => $request->nik,
                    'nama'          => $request->nama,
                    'alamat'        => $request->alamat,
                    'telepon'       => $request->telepon,
                    't_lahir'       => $request->t_lahir,
                    'jenis_kelamin' => $request->jenis_kelamin
                ]);
            }

            $pengunjung->antrians()->create([
                'no_antrian'   => $noAntrian,
                'tanggal'      => $request->tgl_kunjung,
                'status'       => 0,
                'poli_id'      => $request->poli_id
            ]);

            DB::commit();
            return redirect()
                ->back()
                ->with('success', 'Antrian berhasil dibuat!');
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

    public function status(Request $request)
    {
        $this->validate($request, [
            'nik'           => 'required|digits:16',
            'tgl_kunjung'   => 'required|date_format:Y-m-d',
        ]);

        $antrian = Antrian::whereHas('pengunjung', function ($query) use ($request) {
            $query->where('nik', $request->nik);
        })
            ->whereDate('tanggal', $request->tgl_kunjung)
            ->first();

        if (!$antrian) {
            return response()->json([
                'status'  => false,
                'message' => 'Tidak ditemukan antrian',
            ], 404);
        }

        $statusAntrian = '-';

        if ($antrian->status == 0) {
            $statusAntrian = 'Menunggu pemeriksaan';
        } else if ($antrian->status == 1) {
            $statusAntrian = 'Dalam pemeriksaan';
        } else if ($antrian->status == 2) {
            $statusAntrian = 'Selesai pemeriksaan';
        } else {
            $statusAntrian = 'Tidak ada status!';
        }

        return response()->json([
            'status'  => true,
            'message' => 'Antrian ditemukan',
            'data'    => [
                'nomor'   => $antrian->no_antrian,
                'tanggal' => Carbon::parse($antrian->tanggal)->format('d-m-Y'),
                'status'  => $statusAntrian,
                'poli'    => $antrian->poli->nama,
                'link'    => route('pendaftaran.cetak', $antrian->id),
            ]
        ]);
    }

    public function cetakPdf($id)
    {
        $antrian = Antrian::findOrFail($id);

        $pdf = Pdf::loadView('dashboard.cetak', compact('antrian'))
            ->setPaper('a4', 'portrait');

        return $pdf->stream('antrian.pdf');
    }
}
