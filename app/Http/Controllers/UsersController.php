<?php

namespace App\Http\Controllers;

use App\Models\Rol;
use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    public function index()
    {
        $rols = Role::all();
        $users = User::all();
        return Inertia::render('Usuarios', ['usuarios' => $users, 'rols' => $rols]);
    }

    public function create(Request $request)
    {
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        return redirect(route('usuarios.index'));
    }

    public function destroy(Request $request)
    {
        User::destroy($request->id);
        return redirect(route('usuarios.index'));
    }
}