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
    public function show(Request $request)
    {
        try {
            $users = sizeof(User::Role($request->id)->get());
        } catch (Exception $e) {
            $users = '';
        }
        return $users;
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
    public function create(Request $request)
    {
        $validate = $request->validate([
            'name' => ['required', 'string', 'max:255']
        ]);
        Role::create([
            'name' => $validate['name'],
        ]);
        return redirect('roles.index');
    }
}