<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Category;
use App\Models\Document;
use App\Models\User;
use GuzzleHttp\Psr7\Response;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Http\Request;
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

    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => ['required', 'max:255'],
            'path' => ['required', 'mimes:pdf,doc,docx,xsl,xslx,ppt,pptx'],
            'category' => ['required'],
        ]);
        $doc = Document::where('id', $request->id)->first();
        $path = Storage::disk('files')->put('/', request()->file('path'));
        if ($doc) {
            $this->update($validate, $doc, $path);
        } else {
            $this->create($validate, $path);
        }

        return redirect(route('archivos.index'));
    }
    public function create($val, $path)
    {
        Document::create([
            'name' => $val['name'],
            'path' => $path,
            'category_id' => $val['category'],
            'user_id' => auth()->user()->id,
        ]);
    }

    protected function update($val, $doc, $path)
    {
        Storage::disk('files')->delete($doc->path);
        $doc->update([
            'name' => $val['name'],
            'path' => $path,
            'category_id' => $val['category'],
            'user_id' => auth()->user()->id,
        ]);
    }

    public function destroy(Request $request)
    {
        $doc = Document::where('id', $request->id)->first();
        Storage::disk('files')->delete($doc->path);
        Document::destroy($request->id);
        return redirect(route('archivos.index'));
    }

    public function download(Request $request)
    {
        return Response()->download(public_path('files/' . $request->path));
    }
}