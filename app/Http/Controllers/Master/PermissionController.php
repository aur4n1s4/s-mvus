<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Yajra\DataTables\DataTables;

class PermissionController extends Controller
{
    protected $route = 'permission.';
    protected $view = 'master.permission.';
    protected $title = 'Master Permission ';
    protected $subTitle = 'Permission';


    public function index()
    {
        $route    = $this->route;
        $title    = $this->title;
        $subTitle = $this->subTitle;

        return view($this->view . 'index', compact('route', 'title', 'subTitle'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:permissions,name',
            'guard_name' => 'required'
        ]);

        $input = $request->all();
        Permission::create($input);

        return response()->json([
            'success' => true,
            'message' => 'Data permission berhasil tersimpan.'
        ]);
    }

    public function edit($id)
    {
        $permission = Permission::find($id);
        return $permission;
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|unique:permissions,name,' . $id,
            'guard_name' => 'required'
        ]);

        $input = $request->all();
        $permission = Permission::findOrFail($id);
        $permission->update($input);

        return response()->json([
            'success' => true,
            'message' => 'Data permission berhasil diperbaharui.'
        ]);
    }

    public function destroy($id)
    {
        Permission::destroy($id);

        return response()->json([
            'success' => true,
            'message' => 'Data permission berhasil dihapus.'
        ]);
    }

    public function api()
    {
        $permission = Permission::all();
        return DataTables::of($permission)
            ->addColumn('action', function ($p) {
                return "
                    <a  href='#' onclick='edit(" . $p->id . ")' title='Edit Permission'><i class='icon-pencil mr-1'></i></a>
                    <a href='#' onclick='remove(" . $p->id . ")' class='text-danger' title='Hapus Permission'><i class='icon-remove'></i></a>";
            })
            ->rawColumns(['action'])
            ->toJson();
    }
}
