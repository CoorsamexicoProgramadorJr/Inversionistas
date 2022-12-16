<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;

class DocController extends Controller
{
    public function Index() {
        return Inertia::render('Dashboard');
    }
}
