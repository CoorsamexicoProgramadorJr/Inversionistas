<?php

use App\Http\Controllers\ArchController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\UsersController;
use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Auth/Login', [
        'canLogin' => Route::has('login')
    ]);
});

//Dashboad
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/dashboard', [DashboardController::class, 'store']);

    //Rutas de la pagina Archivos
    Route::get('/arch', [ArchController::class, 'index'])->name('archivos.index');
    Route::post('/arch', [ArchController::class, 'create']);
    Route::post('/arch/update', [ArchController::class, 'update'])->name('archivos.update');
    Route::post('/arch/download', [ArchController::class, 'download'])->name('archivos.download');
    Route::get('/arch/find', [ArchController::class, 'find'])->name('archivos.find');
    Route::post('/arch/delete', [ArchController::class, 'destroy'])->name('archivos.delete');

    //Rutas de la Pagina Usuarios
    Route::get('/users', [UsersController::class, 'index'])->name('usuarios.index');
    Route::post('/users/create', [UsersController::class, 'create'])->name('usuarios.create');
    Route::post('/users/delete', [UsersController::class, 'destroy'])->name('usuarios.delete');

    //Rutas de la pagina Roles

    Route::get('/roles', [RolesController::class, 'index'])->name('roles.index');
});