<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Category;
use App\Models\Document;
use App\Models\User;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ArchController extends Controller
{
    public function index()
    {
        $cats = Category::all();
        $docs = Document::all();
        $users = User::all();
        return Inertia::render('Archivos', ['categories' => $cats, 'documents' => $docs, 'usuario' => $users]);
    }

    public function create(Request $request)
    {
        $validate = $request->validate([
            'name' => ['required', 'max:255'],
            'path' => ['required', 'mimes:pdf,doc,docx,xsl,xslx,ppt,pptx'],
            'category' => ['required'],
        ]);

        $path = Storage::disk('files')->put('/', request()->file('path'));
        Document::create([
            'name' => $validate['name'],
            'path' => $path,
            'category_id' => $validate['category'],
            'user_id' => auth()->user()->id,
        ]);

        return redirect(route('archivos.index'));
    }

    public function download(Request $request)
    {
        $url =  Storage::disk('files')->download($request->path);
        dd($url);
        return $url;
    }

    public function find(Request $request)
    {
    }

    public function destroy(Request $request)
    {
        Document::destroy($request->id);
        return redirect(route('archivos.index'));
    }

    protected function updateFile(UploadedFile $file)
    {
        $path = Storage::put('files', request()->file('path'));
        return $path;
    }
}