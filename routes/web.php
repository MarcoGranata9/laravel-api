<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\TechnologyController;
use App\Http\Controllers\Admin\TypeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])
    ->name('admin.')
    ->prefix('admin')
    ->group(function() {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
        Route::resource('projects', ProjectController::class)->parameters(['projects'=> 'project:slug']);
        Route::get('trash', [ProjectController::class, 'trash'])->name('projects.trash');
        Route::delete('trash/{project}', [ProjectController::class, 'trash_delete'])->withTrashed()->name('trash.delete');
        Route::put('trash/{project}/restore', [ProjectController::class, 'restore'])->name('trash.restore');
        Route::resource('types', TypeController::class)->parameters(['types'=> 'type:slug']);
        Route::resource('technologies', TechnologyController::class)->parameters(['technologies'=> 'technology:slug']);
});

require __DIR__.'/auth.php';
