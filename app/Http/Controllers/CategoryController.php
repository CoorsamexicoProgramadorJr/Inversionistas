<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Category;
use Illuminate\Http\Request;
use Ramsey\Uuid\Type\Integer;

class CategoryController extends Controller
{
    public function index()
    {
        $cats = Category::all();
        return Inertia::render('Category', ['cats' => $cats]);
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'max:255', 'unique:categories']
        ]);
        Category::create([
            'name' => $validated['name'],
        ]);
    }
    public function destroy(Request $request)
    {
        Category::destroy($request->id);
    }
}