<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TrashedNoteController;
use App\Http\Controllers\NoteController;
use App\Http\Livewire\Percobaan;

use Illuminate\Support\Facades\Route;

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
    return view('utama');
});



Route::get('/coba', Percobaan::class);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::prefix('notes')
    ->name('notes.')
    ->middleware(['auth', 'verified'])
    ->controller(NoteController::class)
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/', 'store')->name('store');
        Route::get('/{note}', 'show')->name('show');
        Route::get('/{note}/edit', 'edit')->name('edit');
        Route::post('/{note}', 'update')->name('update');
        Route::delete('/{note}', 'destroy')->name('destroy');
    });

    Route::prefix('/trashed')
    ->middleware(['auth', 'verified'])
    ->name('trashed.')
    ->group(function(){
        Route::get('/', [TrashedNoteController::class, 'index'])->name('index');
        Route::get('/{note}', [TrashedNoteController::class, 'show'])->name('show')->withTrashed();
        Route::put('/{note}', [TrashedNoteController::class, 'update'])->name('update')->withTrashed();
        Route::delete('/{note}', [TrashedNoteController::class, 'destroy'])->name('destroy')->withTrashed();
});

require __DIR__.'/auth.php';
