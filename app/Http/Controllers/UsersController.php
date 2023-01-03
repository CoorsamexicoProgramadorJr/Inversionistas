<?php

namespace App\Http\Controllers;

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

    public function store(Request $request)
    {
        $user = User::where('id', $request->id)->first();
        if ($user) {
            $this->update($request, $user);
        } else {
            $this->create($request);
        }
        return redirect(route('usuarios.index'));
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
    }

    public function update(Request $request, $user)
    {
        $validate = $request->validate([
            'name' => ['required', 'max:255', 'string'],
            'email' => ['required', 'max:255', 'email',],
            'password' => ['required', 'min:8', 'max:255'],
            'rol' => ['required'],
        ]);
        $user->update([
            'name' => $validate['name'],
            'email' => $validate['email'],
            'password' => Hash::make($validate['password']),
        ])->assignRole($validate['rol']);
    }

    public function destroy(Request $request)
    {
        User::destroy($request->id);
        return redirect(route('usuarios.index'));
    }
}