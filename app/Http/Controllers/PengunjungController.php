<?php

namespace App\Http\Controllers;

use App\Models\Pengunjung;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PengunjungController extends Controller
{
    protected $route    = 'pengunjung.';
    protected $view     = 'pengunjung.';
    protected $title    = 'Pengunjung';
    protected $subTitle = 'Pengunjung';

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

        return view($this->view . 'index', compact('route', 'title', 'subTitle'));
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
        $route    = $this->route;
        $title    = $this->title;
        $subTitle = $this->subTitle;

        $pengunjung = Pengunjung::find($id);

        return view($this->view . 'detail', compact('route', 'title', 'subTitle', 'pengunjung'));
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

        $pengunjung = Pengunjung::find($id);

        return view($this->view . 'edit', compact('route', 'title', 'subTitle', 'pengunjung'));
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
            'nik'           => 'required|digits:16',
            'nama'          => 'required|string|max:255',
            'alamat'        => 'required|string|max:500',
            'telepon'       => 'required|numeric|digits_between:10,15',
            't_lahir'       => 'required|date_format:Y-m-d',
            'jenis_kelamin' => 'required|in:L,P',
        ]);

        Pengunjung::find($id)->update([
            'nik'           => $request->nik,
            'nama'          => $request->nama,
            'alamat'        => $request->alamat,
            'telepon'       => $request->telepon,
            't_lahir'       => $request->t_lahir,
            'jenis_kelamin' => $request->jenis_kelamin
        ]);

        return response()->json([
            'status'  => 1,
            'message' => 'Berhasil memperbaharui data.',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return Pengunjung::findOrFail($id)->delete();
    }

    public function api()
    {
        $pengunjungs = Pengunjung::all();

        return DataTables::of($pengunjungs)
            ->addIndexColumn()
            ->addColumn('action', function ($p) {
                $btnEdit = "<a href='" . route($this->route . 'edit', $p->id) . "' onclick='edit(this)' title='Edit'><i class='icon icon-pencil text-blue mr-1'></i></a>";

                $btnDelete = "<a onclick='remove(this)' title='Hapus' data-url='" . route($this->route . 'destroy', $p->id) . "'><i class='icon icon-remove text-red ml-1'></i></a>";

                return $btnEdit . $btnDelete;
            })
            ->editColumn('nik', function ($p) {
                return "<a href=" . route($this->route . 'show', $p->id) . ">" . $p->nik . "</a>";
            })
            ->rawColumns(['action', 'nik'])
            ->toJson();
    }
}
