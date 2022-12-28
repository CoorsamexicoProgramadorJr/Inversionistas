<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesController extends Controller
{
    public function index()
    {
        $perm = Permission::all();
        $rol = Role::all();
        return Inertia::render('Roles', ['permisos' => $perm, 'roles' => $rol]);
    }
}