<?php

use App\Http\Controllers\ArchController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\UsersController;
use App\Models\Category;
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
    Route::post('/arch', [ArchController::class, 'store']);
    Route::get('/arch/{path}/download', [ArchController::class, 'download'])->name('archivos.download');
    Route::post('/arch/delete', [ArchController::class, 'destroy'])->name('archivos.delete');

    //Rutas de la pagina categorys
    Route::get('/category', [CategoryController::class, 'index'])->name('category.index');
    Route::post('/category/create', [CategoryController::class, 'store'])->name('category.create');
    Route::post('/category/destroy', [CategoryController::class, 'destroy'])->name('category.destroy');

    //Rutas de la Pagina Usuarios
    Route::get('/users', [UsersController::class, 'index'])->name('usuarios.index');
    Route::post('/users/create', [UsersController::class, 'store'])->name('usuarios.create');
    Route::post('/users/delete', [UsersController::class, 'destroy'])->name('usuarios.delete');

    //Rutas de la pagina Roles
    Route::get('/roles', [RolesController::class, 'index'])->name('roles.index');
    Route::post('/roles/destroy', [RolesController::class, 'destroy'])->name('roles.destroy');
    Route::post('/roles/create', [RolesController::class, 'store'])->name('roles.create');
});
/* Route::middleware([
    'auth:sanctum',
    'role:Admin',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
}); */