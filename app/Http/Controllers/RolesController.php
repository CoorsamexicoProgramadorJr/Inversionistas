<?php

namespace App\Http\Controllers;

use App\Models\User;
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
                'name' => ['required', 'string', 'max:255',]
            ]);
            $this->update($validate, $role);
        } else {
            $validate = $request->validate([
                'name' => ['required', 'string', 'max:255', 'unique:roles']
            ]);
            $this->create($validate);
        }
        return redirect('roles.index');
    }

    public function create($val)
    {
        Role::create([
            'name' => $val['name'],
        ]);
    }

    public function update($val, $role)
    {
        $role->update([
            'name' => $val['name'],
        ]);
    }

    public function destroy(Request $request)
    {
        $users = $this->show($request);
        if ($users) {
            $perm = Permission::all();
            $rol = Role::all();
            return redirect('roles.index');
        }
        dd($users);
        Role::destroy($request->id);
        return redirect('roles.index');
    }
}