<?php

use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\ProdutoImagemController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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
    Route::resource('/categorias', CategoriaController::class);
    Route::resource('/produtos', ProdutoController::class);

    //deletar imagens do produto
    Route::delete(
        '/produto-imagens/{imagem}',
        [ProdutoImagemController::class, 'destroy']
    )->name('produto-imagens.destroy');
});

require __DIR__ . '/auth.php';
