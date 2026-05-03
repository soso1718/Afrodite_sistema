<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuestionarioController;
use App\Http\Controllers\ArtigoController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\RegistroController;
use Illuminate\Support\Facades\Auth;
use App\Models\Resposta;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', function () {
    $user = Auth::user();

    if ($user->role === 'admin') {
        return redirect()->route('admin.dashboard');
    }

    $jaRespondeu = Resposta::where('user_id', $user->id)->exists();
    if (!$jaRespondeu) {
        return redirect()->route('questionario');
    }

    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/events', [EventController::class, 'index'])->name('events.index');
    Route::post('/events', [EventController::class, 'store'])->name('events.store');
    Route::put('/events/{event}', [EventController::class, 'update'])->name('events.update');
    Route::delete('/events/{event}', [EventController::class, 'destroy'])->name('events.destroy');

    Route::get('/registros', [RegistroController::class, 'index'])->name('registros.index');
    Route::get('/registros/{registro}/edit', [RegistroController::class, 'edit'])->name('registros.edit');
    Route::put('/registros/{registro}', [RegistroController::class, 'update'])->name('registros.update');
    Route::delete('/registros/{registro}', [RegistroController::class, 'destroy'])->name('registros.destroy');

    Route::get('/artigos', [ArtigoController::class, 'index'])->name('artigos.index');
    Route::get('/artigos/{artigo}', [ArtigoController::class, 'show'])
        ->whereNumber('artigo')
        ->name('artigos.show');

    Route::get('/questionario', [QuestionarioController::class, 'index'])->name('questionario');
    Route::post('/questionario', [QuestionarioController::class, 'store'])->name('questionario.store');
    Route::get('/questionario/editar', [QuestionarioController::class, 'edit'])->name('questionario.edit');
    Route::put('/questionario/update', [QuestionarioController::class, 'update'])->name('questionario.update');

});

Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::get('/questionarios/respostas', [DashboardController::class, 'respostas'])
            ->name('questionarios.respostas');

        Route::resource('artigos', ArtigoController::class)
            ->except(['index', 'show']);

    });

require __DIR__.'/auth.php';