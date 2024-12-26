<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\Poli;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class DoctorController extends Controller
{
    protected $route = 'doctor.';
    protected $view = 'master.doctor.';
    protected $title = 'Master Doctor ';
    protected $subTitle = 'Dokter';

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

        $polis    = Poli::all();

        return view($this->view . 'index', compact('route', 'title', 'subTitle', 'polis'));
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
            'nama'      => 'required|string',
            'foto'      => 'image|mimes:jpeg,png,jpg|max:2048',
            'poli_id'   => 'required'
        ]);

        $filePath = $request->hasFile('foto')
            ? $request->file('foto')->store('foto', 'public')
            : null;

        Doctor::create([
            'nama'      => $request->nama,
            'poli_id'   => $request->poli_id,
            'foto'      => $filePath,
        ]);

        return response('Berhasil menyimpan data', 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return Doctor::find($id);
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
            'nama'      => 'required|string',
            'foto'      => 'image|mimes:jpeg,png,jpg|max:2048',
            'poli_id'   => 'required'
        ]);

        $doctor = Doctor::findOrFail($id);

        // Hapus foto lama jika ada
        if ($doctor->foto && file_exists(storage_path('app/public/' . $doctor->foto))) {
            unlink(storage_path('app/public/' . $doctor->foto));
        }

        // Simpan foto baru jika ada
        $filePath = $request->hasFile('foto')
            ? $request->file('foto')->store('foto', 'public')
            : $doctor->foto; // Jika tidak ada foto baru, gunakan foto lama

        // Update data dokter
        $doctor->update([
            'nama'      => $request->nama,
            'poli_id'   => $request->poli_id,
            'foto'      => $filePath,
        ]);

        return response('Berhasil memperbaharui data', 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return Doctor::findOrFail($id)->delete();
    }

    public function api()
    {
        $doctors = Doctor::with('poli')->get();

        return DataTables::of($doctors)
            ->addIndexColumn()
            ->addColumn('action', function ($p) {
                $btnEdit = "<a href='#' onclick='edit(this)' title='Edit' data-url='" . route($this->route . 'edit', $p->id) . "'><i class='icon icon-pencil text-blue mr-1'></i></a>";

                $btnDelete = "<a onclick='remove(this)' title='Hapus' data-url='" . route($this->route . 'destroy', $p->id) . "'><i class='icon icon-remove text-red ml-1'></i></a>";

                return $btnEdit . $btnDelete;
            })
            ->editColumn('foto', function ($p) {
                if ($p->foto) {
                    return '<img src="' . asset('storage/' . $p->foto) . '" alt="Foto" width="50" height="50">';
                } else {
                    return 'Tidak ada foto';
                }
            })
            ->rawColumns(['action', 'foto'])
            ->toJson();
    }
}
