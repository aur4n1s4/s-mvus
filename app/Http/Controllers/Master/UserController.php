<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Pegawai;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    protected $route    = 'user.';
    protected $view     = 'master.user.';
    protected $title    = 'Master Pengguna ';
    protected $subTitle = 'Pengguna';

    public function edit($id)
    {
        $route    = $this->route;
        $title    = $this->title;
        $subTitle = $this->subTitle;

        $user  = User::find($id);
        $roles = Role::all();

        return view($this->view . 'user_edit', compact('route', 'title', 'subTitle', 'user', 'roles'));
    }

    public function update(Request $request, $id)
    {
        switch ($request->type) {
            case 1:
                $c_status = ($request->c_status == 'on' ? 1 : 0);
                $user = User::findOrFail($id);
                $user->status = $c_status;
                $user->save();

                return response()->json([
                    'success' => true,
                    'message' => 'Data user berhasil diperbaharui. Status user ' . $c_status
                ]);
                break;
            case 2:
                $request->validate([
                    'username' => 'required|unique:users,username,' . $id
                ]);

                $username = $request->username;
                $user = User::findOrFail($id);
                $user->username = $username;
                $user->save();

                return response()->json([
                    'success' => true,
                    'message' => 'Data user berhasil diperbaharui. Username user ' . $username
                ]);
                break;
            case 3:
                $request->validate([
                    'password' => 'required|string|min:6|confirmed'
                ]);

                $password = bcrypt($request->password);
                $user = User::findOrFail($id);
                $user->password = $password;
                $user->save();

                return response()->json([
                    'success' => true,
                    'message' => 'Data user berhasil diperbaharui. Password user ' . $request->password
                ]);
                break;
            case 4:
                $user = User::findOrFail($id);
                $user->assignRole($request->roles);

                return response()->json([
                    'success' => true,
                    'message' => 'Data role berhasil diperbaharui'
                ]);
                break;
        }
    }

    public function destroy($id)
    {
        Pegawai::where('user_id', $id)->update(['user_id' => 0]);
        User::destroy($id);

        return response()->json([
            'success' => true,
            'message' => 'Data user berhasil dihapus.'
        ]);
    }

    public function role($id)
    {
        return User::find($id)->getRoleNames();
    }

    public function roleDestroy(Request $request, $name)
    {
        return User::find($request->id)->removeRole($name);
    }
}
