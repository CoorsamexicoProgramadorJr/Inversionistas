<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DocController extends Controller
{
    public function Index() {
        $cats = DB::table('categories')->get();
        return Inertia::render('Dashboard', ['cateogries' => $cats]);
    }

    public function store(Request $request){
        Category::create([
            'nombre' => $request->category
        ]);
        return Inertia::render('Dashboard');
    }
}
