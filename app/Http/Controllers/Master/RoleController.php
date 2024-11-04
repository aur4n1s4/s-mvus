<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\DataTables;

class RoleController extends Controller
{
    protected $route = 'role.';
    protected $view = 'master.role.';
    protected $title = 'Master Role ';
    protected $subTitle = 'Role';

    public function index()
    {
        $route = $this->route;
        $title = $this->title;
        $subTitle = $this->subTitle;

        return view($this->view . 'index', compact('route', 'title', 'subTitle'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'       => 'required|unique:roles,name',
            'guard_name' => 'required'
        ]);

        $input = $request->all();
        Role::create($input);

        return response('Data role berhasil tersimpan.', 200);
    }

    public function edit($id)
    {
        return Role::find($id);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|unique:roles,name,' . $id,
            'guard_name' => 'required'
        ]);

        $input = $request->all();
        $role = Role::findOrFail($id);
        $role->update($input);

        return response('Data role berhasil diperbaharui.', 200);
    }

    public function destroy($id)
    {
        Role::destroy($id);

        return response('Data role berhasil dihapus.', 200);
    }

    public function api()
    {
        $role = Role::all();

        return Datatables::of($role)
            ->addColumn('permissions', function ($p) {
                return count($p->permissions) . " <a href='" . route($this->route . 'permission.index', $p->id) . "' class='text-success pull-right' title='Edit Permissions'><i class='icon-clipboard-list2 mr-1'></i></a>";
            })
            ->addColumn('action', function ($p) {
                $btnEdit = "<a  onclick='edit(" . $p->id . ")' title='Edit Role'><i class='icon-pencil text-blue m-1'></i></a>";

                $btnDelete = "<a onclick='remove(" . $p->id . ")' title='Hapus Role'><i class='icon-remove text-red m-1'></i></a>";

                return $btnEdit . $btnDelete;
            })
            ->rawColumns(['action', 'permissions'])
            ->toJson();
    }

    //--- Permission
    public function permissions($id)
    {
        $route = $this->route;
        $role = Role::findOrFail($id);
        $permissions = Permission::all();
        return view($this->view . 'role_permission', compact(
            'route',
            'role',
            'permissions',
        ));
    }

    public function listPermission($id)
    {
        $role = Role::findOrFail($id);
        return $role->permissions()->orderBy('name')->get();
    }

    public function storePermissions(Request $request)
    {
        $request->validate([
            'permissions' => 'required'
        ]);

        $role = Role::findOrFail($request->id);
        $role->givePermissionTo($request->permissions);

        return response()->json([
            'success' => true,
            'message' => 'Data permission berhasil tersimpan.'
        ]);
    }

    public function destroyPermission(Request $request, $name)
    {
        $role = Role::findOrFail($request->id);
        $role->revokePermissionTo($name);
    }
}
