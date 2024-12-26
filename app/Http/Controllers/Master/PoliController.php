<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Poli;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class PoliController extends Controller
{
    protected $route = 'poli.';
    protected $view = 'master.poli.';
    protected $title = 'Master Pelayanan ';
    protected $subTitle = 'Pelayanan';

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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'nama'       => 'required|string',
            'keterangan' => 'required'
        ]);

        Poli::create([
            'nama'       => $request->nama,
            'keterangan' => $request->keterangan,
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
        return Poli::findOrFail($id);
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
            'nama'       => 'required|string',
            'keterangan' => 'required'
        ]);

        Poli::find($id)->update([
            'nama'       => $request->nama,
            'keterangan' => $request->keterangan,
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
        return Poli::findOrFail($id)->delete();
    }

    public function api()
    {
        $polis = Poli::all();
        return DataTables::of($polis)
            ->addIndexColumn()
            ->addColumn('action', function ($p) {
                $btnEdit = "<a href='#' onclick='edit(this)' title='Edit' data-url='" . route($this->route . 'edit', $p->id) . "'><i class='icon icon-pencil text-blue mr-1'></i></a>";

                $btnDelete = "<a onclick='remove(this)' title='Hapus' data-url='" . route($this->route . 'destroy', $p->id) . "'><i class='icon icon-remove text-red ml-1'></i></a>";

                return $btnEdit . $btnDelete;
            })
            ->rawColumns(['action'])
            ->toJson();
    }
}
