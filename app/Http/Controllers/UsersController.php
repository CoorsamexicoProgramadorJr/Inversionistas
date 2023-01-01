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
        $validate = $request->validate([
            'name' => ['required', 'max:255', 'unique:users', 'string'],
            'email' => ['required', 'max:255', 'email', 'unique:users'],
            'password' => ['required', 'min:8', 'max:255'],
            'rol' => ['required'],
        ]);
        User::create([
            'name' => $validate['name'],
            'email' => $validate['email'],
            'password' => Hash::make($validate['password']),
        ])->assignRole($validate['rol']);
        return redirect(route('usuarios.index'));
    }

    public function destroy(Request $request)
    {
        User::destroy($request->id);
        return redirect(route('usuarios.index'));
    }
}