<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Pegawai;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class PegawaiController extends Controller
{
    protected $route    = 'pegawai.';
    protected $view     = 'master.pegawai.';
    protected $title    = 'Master Pegawai ';
    protected $subTitle = 'Pegawai';

    public function index()
    {
        $route     = $this->route;
        $title     = $this->title;
        $subTitle  = $this->subTitle;

        return view($this->view . 'index', compact('route', 'title', 'subTitle'));
    }

    public function create()
    {
        $route     = $this->route;
        $title     = $this->title;
        $subTitle  = $this->subTitle;

        return view($this->view . 'add', compact('route', 'title', 'subTitle'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nik'          => 'required',
            'first_name'   => 'required',
            'phone_number' => 'required',
            'email'        => 'required',
            'gender'       => 'required',
            't_lahir'      => 'required',
            'd_lahir'      => 'required',
        ]);

        Pegawai::create([
            'nik'          => $request->nik,
            'first_name'   => $request->first_name,
            'last_name'    => $request->last_name,
            'phone_number' => $request->phone_number,
            'email'        => $request->email,
            'gender'       => $request->gender,
            't_lahir'      => $request->t_lahir,
            'd_lahir'      => $request->d_lahir,
        ]);

        return response('Data pegawi berhasi disimpan.', Response::HTTP_OK);
    }

    public function edit($id)
    {
        $route     = $this->route;
        $title     = $this->title;
        $subTitle  = $this->subTitle;
        $pegawai   = Pegawai::find($id);

        return view($this->view . 'edit', compact('route', 'title', 'subTitle', 'pegawai'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nik'          => 'required',
            'first_name'   => 'required',
            'phone_number' => 'required',
            'email'        => 'required',
            'gender'       => 'required',
            't_lahir'      => 'required',
            'd_lahir'      => 'required',
        ]);

        $pegawai = Pegawai::find($id);
        $pegawai->update([
            'nik'          => $request->nik,
            'first_name'   => $request->first_name,
            'last_name'    => $request->last_name,
            'phone_number' => $request->phone_number,
            'email'        => $request->email,
            'gender'       => $request->gender,
            't_lahir'      => $request->t_lahir,
            'd_lahir'      => $request->d_lahir,
        ]);

        return response('Data pegawi berhasi diperbaharui.', Response::HTTP_OK);
    }

    public function addUser($employeId)
    {
        $pegawai = Pegawai::findOrFail($employeId);
        if ($pegawai->user_id == 0) {
            $user = User::updateOrCreate([
                'username' => $pegawai->nik,
                'password' => bcrypt('123456')
            ]);
            $user_id = $user->id;
            $pegawai->user_id = $user_id;
            $pegawai->save();
        } else {
            $user_id = $pegawai->user_id;
        }
        return response('Berhasil menambahkan pengguna.', Response::HTTP_OK);
    }

    public function api()
    {
        $pegawai = Pegawai::get();
        return DataTables::of($pegawai)
            ->addIndexColumn()
            ->editColumn('user', function ($p) {
                if ($p->user_id == "") {
                    return "Tidak <a  onclick='addUser(this)' title='Hapus' data-url='" . route($this->route . 'addUser', $p->id) . "' class='float-right text-success' title='Tambah sebagai pengguna aplikasi'><i class='icon-user-plus'></i></a>";
                } else {
                    return "Ya <a href='" . route($this->route . 'user.edit', $p->user_id) . "' class='float-right' title='Edit akun user'><i class='icon-user'></i></a>";
                }
            })
            ->addColumn('action', function ($p) {
                $btnEdit = "<a href='" . route($this->route . 'edit', $p->id) . "' title='Edit'><i class='icon-pencil text-blue'></i></a>";
                // Disable button delete if user_id same as user login
                if (Auth::user()->id == $p->user_id) {
                    $btnDelete = "<a><i class='icon-trash text-grey'></i></a>";
                } else {
                    $btnDelete = " <a onclick='remove(this)' title='Hapus' data-url='" . route($this->route . 'destroy', $p->id) . "'><i class='icon-remove text-red'></i></a>";
                }
                return $btnEdit . $btnDelete;
            })
            ->rawColumns(['user', 'action'])
            ->toJson();
    }
}
