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

    public function api()
    {
        $pengunjungs = Pengunjung::all();

        return DataTables::of($pengunjungs)
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
