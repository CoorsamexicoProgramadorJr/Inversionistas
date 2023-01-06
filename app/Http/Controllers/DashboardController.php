<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Category;
use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function Index()
    {
        $cats = DB::table('categories')->get();
        $year = date('Y');
        $month = date('m');
        $docs = Document::whereYear('created_at', $year)->whereMonth('created_at', $month)->get();
        return Inertia::render('Dashboard', ['categories' => $cats, 'documents' => $docs]);
    }

    public function store(Request $request)
    {
        Category::create([
            'nombre' => $request->category
        ]);
        return redirect(route('Dashboard'));
    }
}