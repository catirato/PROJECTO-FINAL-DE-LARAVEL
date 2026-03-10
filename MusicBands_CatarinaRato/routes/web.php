<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BandController;
use App\Http\Controllers\AlbumController;
use App\Http\Controllers\DashboardController;

use Illuminate\Http\Request;

|--------------------------------------------------------------------------
| Página inicial
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('welcome');
});


/*
|--------------------------------------------------------------------------
| ÁLBUNS — EDIÇÃO (USER AUTENTICADO)
| Utilizadores autenticados podem editar álbuns
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    Route::get('/albums/{album}/edit', [AlbumController::class, 'edit'])
        ->name('albums.edit');

    Route::put('/albums/{album}', [AlbumController::class, 'update'])
        ->name('albums.update');
});

/*
|--------------------------------------------------------------------------
| DASHBOARD — APENAS UTILIZADORES AUTENTICADOS
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->get('/dashboard', [DashboardController::class, 'index'])
    ->name('dashboard');


/*
|--------------------------------------------------------------------------
| ADMINISTRADOR — GESTÃO TOTAL
| Apenas administradores podem criar, apagar e gerir conteúdos
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'admin'])->group(function () {

    /*
    |-------------------------
    | Bandas
    |-------------------------
    */
    Route::get('/bands/create', [BandController::class, 'create'])
        ->name('bands.create');

    Route::post('/bands', [BandController::class, 'store'])
        ->name('bands.store');

    Route::get('/bands/{band}/edit', [BandController::class, 'edit'])
        ->name('bands.edit');

    Route::put('/bands/{band}', [BandController::class, 'update'])
        ->name('bands.update');

    Route::delete('/bands/{band}', [BandController::class, 'destroy'])
        ->name('bands.destroy');

    /*
    |-------------------------
    | Álbuns
    |-------------------------
    */
    Route::get('/bands/{band}/albums/create', [AlbumController::class, 'create'])
        ->name('albums.create');

    Route::post('/albums', [AlbumController::class, 'store'])
        ->name('albums.store');

    Route::delete('/albums/{album}', [AlbumController::class, 'destroy'])
        ->name('albums.destroy');
});

/*
|--------------------------------------------------------------------------
| BANDAS — VISUALIZAÇÃO (PÚBLICO)
| Utilizadores não autenticados apenas podem visualizar
|--------------------------------------------------------------------------
*/
Route::resource('bands', BandController::class)
    ->only(['index', 'show']);

/*
|--------------------------------------------------------------------------
| Página 404 personalizada
|--------------------------------------------------------------------------
*/
Route::fallback(function () {
    return '<h5>Ups, essa página não existe</h5>';
});
