<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Category;
use App\Models\Document;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ArchController extends Controller
{
    public function index() {
        $cats = Category::all();
        $docs = Document::all();
        return Inertia::render('Archivos',['categories' => $cats,'documents' => $docs]);
    }

    public function create(Request $request){
        $path = Storage::disk('files')->put('/', request()->file('path'));
        Document::create([
            'nombre' =>$request->nombre,
            'path' => $path,
            'category_id' =>$request->category,
            'user_id' => auth()->user()->id,
        ]);

        !$this->index();
    }

    public function download(){
        foreach ($_GET as $value => $key) {
            $path = $value;
        }
        $path = Document::find($path);
        $url =  Storage::disk('files')->download($path->path);
        return $url;
    }
    
    public function find(){
        foreach ($_GET as $value => $key) {
            $path = $value;
        }
        $path = Document::find($path);
    }

    public function destroy(Request $request){
        dd($request);
    }

    protected function updateFile(UploadedFile $file){
        $path = Storage::put('files', request()->file('path'));
        return $path;
    }
}
