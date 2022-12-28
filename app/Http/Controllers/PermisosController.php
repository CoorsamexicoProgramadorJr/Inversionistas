<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermisosController extends Controller
{
    public function create(Request $request)
    {
        Permission::create([
            'name' => $request->nombre,
        ]);
    }
}