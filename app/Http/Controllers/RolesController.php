<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesController extends Controller
{
    public function index()
    {
        $perm = Permission::all();
        $rol = Role::all();
        return Inertia::render('Roles', ['permisos' => $perm, 'roles' => $rol]);
    }

    public function store(Request $request)
    {
        $role = Role::where('id', $request->id)->first();
        if ($role) {
            $validate = $request->validate([
                'name' => [
                    'required', 'string', 'max:255',
                ]
            ]);
            $this->update($validate, $role, $request->perm);
        } else {
            $validate = $request->validate([
                'name' => ['required', 'string', 'max:255', 'unique:roles']
            ]);
            $this->create($validate, $request->perm);
        }
        return redirect(route('roles.index'));
    }

    public function create($val, $permisos)
    {
        $role = Role::create([
            'name' => $val['name'],
            'guard_name' => 'web',
        ]);
        foreach ($permisos as $p)
            $role->givePermissionTo($p);
    }

    public function update($val, $role, $permisos)
    {
        $role->update([
            'name' => $val['name'],
        ]);
        foreach ($permisos as $p)
            $role->givePermissionTo($p);
    }

    public function destroy(Request $request)
    {
        $users = sizeof(User::role($request->id)->get());
        if ($users) {
            $perm = Permission::all();
            $rol = Role::all();
            return redirect(route('roles.index'));
        }
        Role::destroy($request->id);
        return redirect(route('roles.index'));
    }
}