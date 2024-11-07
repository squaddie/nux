<?php

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\LinkController;
use Illuminate\Support\Facades\Route;


Route::get('/', [RegisterController::class, 'view'])->name('auth.view');
Route::post('/register', [RegisterController::class, 'register'])->name('auth.register');
Route::group(['middleware' => ['verify.link']], function () {
    Route::get('/{link}/imfeelinglucky', [LinkController::class, 'getLucky'])->name('link.lucky.view');
    Route::get('/{link}/imfeelinglucky-create', [LinkController::class, 'makeLucky'])->name('link.lucky.create');
    Route::get('/{link}/history', [LinkController::class, 'history'])->name('link.history');
    Route::get('/{link}/create', [LinkController::class, 'create'])->name('link.create');
    Route::get('/{link}/disable', [LinkController::class, 'disable'])->name('link.disable');
    Route::get('/{link}', [LinkController::class, 'link'])->name('link');
});

