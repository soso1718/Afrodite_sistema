<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuestionarioController;
use App\Http\Controllers\ArtigoController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin', function () {
        return view('admin.dashboard');
    });
});

Route::middleware(['auth'])->group(function () {

    Route::get('/questionario', [QuestionarioController::class, 'index'])
        ->name('questionario');

    Route::post('/questionario', [QuestionarioController::class, 'store'])
        ->name('questionario.store')
        ->middleware('auth');
        
    Route::get('/questionario/editar', [QuestionarioController::class, 'edit'])
        ->name('questionario.edit');
        
    Route::put('/questionario/update', [QuestionarioController::class, 'update'])
        ->name('questionario.update');

});

Route::middleware('auth')->group(function () {
    Route::get('/artigos', [ArtigoController::class, 'index'])
        ->name('artigos.index');

    Route::get('/artigos/{artigo}', [ArtigoController::class, 'show'])
        ->whereNumber('artigo')
        ->name('artigos.show');
});


Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::resource('artigos', ArtigoController::class)
            ->except(['index', 'show']);
});


require __DIR__.'/auth.php';
