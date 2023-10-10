<?php

use Illuminate\Support\Facades\Route;


use App\Http\Controllers\{
    AdocaoController,
    ClienteController,
    EspecieController,
    PetController,
    ProfileController,
    RacaController
};
use App\Models\Raca;

Route::get('/', function () {
    return redirect()->route('adocao.index');
})->middleware(['auth', 'verified'])
    ->name('home');

Route::get('/dashboard', function () {
    return redirect()->route('adocao.index');
})->middleware(['auth', 'verified'])
    ->name('dashboard');


/**
 * --------------------------
 * | Adoções
 * | 04-10-2023
 * --------------------------
 */
Route::prefix('adocoes')
    ->controller(AdocaoController::class)
    ->middleware('auth')
    ->group(function () {
        Route::get('/', 'index')
            ->name('adocao.index');
        Route::get('/novo/{id_cliente?}', 'create')
            ->name('adocao.create');
        Route::get('/editar/{id}', 'edit')
            ->name('adocao.edit');
        Route::get('exibir/{id}', 'show')
            ->name('adocao.show');

        Route::post('cadastrar/{id_cliente}', 'store')
            ->name('adocao.store');
        Route::post('atualizar/{id}', 'update')
            ->name('adocao.update');
        Route::post('excluir/{id}', 'destroy')
            ->name('adocao.destroy');
    });

/**
 * --------------------------
 * | Clientes
 * | 04-10-2023
 * --------------------------
 */
Route::prefix('pessoas')
    ->controller(ClienteController::class)
    ->middleware('auth')
    ->group(function () {
        Route::get('/', 'index')
            ->name('cliente.index');
        Route::get('/novo', 'create')
            ->name('cliente.create');
        Route::get('/editar/{id}', 'edit')
            ->name('cliente.edit');
        Route::get('exibir/{id}', 'show')
            ->name('cliente.show');

        Route::post('cadastrar', 'store')
            ->name('cliente.store');
        Route::post('atualizar/{id}', 'update')
            ->name('cliente.update');
        Route::post('excluir/{id}', 'destroy')
            ->name('cliente.destroy');
    });

/**
 * --------------------------
 * | Especies
 * | 04-10-2023
 * --------------------------
 */
Route::prefix('especies')
    ->controller(EspecieController::class)
    ->middleware('auth')
    ->group(function () {
        Route::get('/', 'index')
            ->name('especie.index');
        Route::get('/novo', 'create')
            ->name('especie.create');
        Route::get('/editar/{id}', 'edit')
            ->name('especie.edit');
        Route::get('exibir/{id}', 'show')
            ->name('especie.show');

        Route::post('cadastrar', 'store')
            ->name('especie.store');
        Route::post('atualizar/{id}', 'update')
            ->name('especie.update');
        Route::post('excluir/{id}', 'destroy')
            ->name('especie.destroy');
    });

/**
 * --------------------------
 * | Pets
 * | 04-10-2023
 * --------------------------
 */
Route::prefix('animais')
    ->controller(PetController::class)
    ->middleware('auth')
    ->group(function () {
        Route::get('/', 'index')
            ->name('pet.index');
        Route::get('/novo', 'create')
            ->name('pet.create');
        Route::get('/editar/{id}', 'edit')
            ->name('pet.edit');
        Route::get('exibir/{id}', 'show')
            ->name('pet.show');

        Route::post('cadastrar', 'store')
            ->name('pet.store');
        Route::post('atualizar/{id}', 'update')
            ->name('pet.update');
        Route::post('excluir/{id}', 'destroy')
            ->name('pet.destroy');

        Route::get('/racas/{id_especie}', 'racas')
            ->name('pet.racas');
    });

/**
 * --------------------------
 * | Raças
 * | 04-10-2023
 * --------------------------
 */
Route::prefix('racas')
    ->controller(RacaController::class)
    ->middleware('auth')
    ->group(function () {
        Route::get('/', 'index')
            ->name('raca.index');
        Route::get('/novo', 'create')
            ->name('raca.create');
        Route::get('/editar/{id}', 'edit')
            ->name('raca.edit');
        Route::get('exibir/{id}', 'show')
            ->name('raca.show');

        Route::post('cadastrar', 'store')
            ->name('raca.store');
        Route::post('atualizar/{id}', 'update')
            ->name('raca.update');
        Route::post('excluir/{id}', 'destroy')
            ->name('raca.destroy');
    });


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

/**
 * --------------------------
 * | Thomas Melo
 * | 04-10-2023
 * --------------------------
 */
