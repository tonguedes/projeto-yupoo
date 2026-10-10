<?php

use App\Http\Controllers\CatalogoController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\ProdutoImagemController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

use App\Http\Controllers\DashboardController;

Route::middleware(['auth', 'verified'])
    ->get('/dashboard', [DashboardController::class, 'index'])
    ->name('dashboard');

Route::get('/catalogo/{slug}', [CatalogoController::class, 'index'])
    ->name('catalogo.index');

Route::get('/catalogo/{slug}/{produto}', [CatalogoController::class, 'show'])
    ->name('catalogo.show');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('/categorias', CategoriaController::class);
    Route::resource('/produtos', ProdutoController::class);

    //deletar imagens do produto
    Route::delete(
        '/produto-imagens/{imagem}',
        [ProdutoImagemController::class, 'destroy']
    )->name('produto-imagens.destroy');
});

require __DIR__ . '/auth.php';
