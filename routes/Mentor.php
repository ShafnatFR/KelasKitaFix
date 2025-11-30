<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Mentor\KelasController;
use App\Http\Controllers\Mentor\MateriController;
use App\Http\Controllers\Mentor\IsiMateriController;

Route::middleware(['auth', 'role:mentor'])
    ->prefix('mentor')
    ->name('mentor.')
    ->group(function () {

        // CRUD Kelas
        Route::resource('kelas', KelasController::class);

        // CRUD Materi
        Route::resource('materi', MateriController::class);

        // CRUD Isi Materi
        Route::resource('isi-materi', IsiMateriController::class);

    });
