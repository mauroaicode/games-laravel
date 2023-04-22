<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Api\V1\GameController;

Route::get('games', [GameController::class, 'all'])->name('get.all.games');
Route::get('find/game/{id}', [GameController::class, 'find'])->name('get.game'); //Buscar juego por id
Route::post('create/game', [GameController::class, 'create'])->name('post.create.game'); //Crear o agregar un nuevo juego
Route::put('update/game/{id}', [GameController::class, 'update'])->name('put.update.game'); //Actualizar el juego, se busca por id
Route::delete('delete/game/{id}', [GameController::class, 'delete'])->name('delete.game'); //Eliminar juego existente, se busca por id


