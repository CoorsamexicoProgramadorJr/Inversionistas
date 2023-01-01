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
            'name' => ['required', 'max:255',]
        ]);
        $categ = Category::where('id', $request->id)->first();
        if ($categ)
            $this->update($validated, $categ);
        else
            $this->create($validated);
    }
    public function destroy(Request $request)
    {
        Category::destroy($request->id);
    }
    public function create($valida)
    {
        Category::create([
            'name' => $valida['name'],
        ]);
    }
    public function update($valida, $cate)
    {
        $cate->update([
            'name' => $valida['name'],
        ]);
    }
}