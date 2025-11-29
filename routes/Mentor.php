<?php
use App\Http\Controllers\Mentor\KelasController;
use App\Http\Controllers\Mentor\MateriController;
use App\Http\Controllers\Mentor\IsiMateriController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\UserCourseController;
use App\Http\Controllers\ReviewController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'role:mentor'])->group(function () {

    Route::resource('/kelas', KelasController::class);

});

//Route Mentor
Route::middleware(['auth', 'role:mentor'])->group(function () {

    // daftar materi per kelas
    Route::get('/kelas/{kelas}/materi', [MateriController::class, 'index'])->name('mentor.materi.index');
    Route::get('/kelas/{kelas}/materi/create', [MateriController::class, 'create'])->name('mentor.materi.create');
    Route::post('/kelas/{kelas}/materi', [MateriController::class, 'store'])->name('mentor.materi.store');
    Route::get('/materi/{materi}/edit', [MateriController::class, 'edit'])->name('mentor.materi.edit');
    Route::put('/materi/{materi}', [MateriController::class, 'update'])->name('mentor.materi.update');
    Route::delete('/materi/{materi}', [MateriController::class, 'destroy'])->name('mentor.materi.destroy');

    // isi materi
    Route::get('/materi/{materi}/isi', [IsiMateriController::class, 'index'])->name('mentor.isi-materi.index');
    Route::get('/materi/{materi}/isi/create', [IsiMateriController::class, 'create'])->name('mentor.isi-materi.create');
    Route::post('/materi/{materi}/isi', [IsiMateriController::class, 'store'])->name('mentor.isi-materi.store');
    Route::get('/isi-materi/{isiMateri}/edit', [IsiMateriController::class, 'edit'])->name('mentor.isi-materi.edit');
    Route::put('/isi-materi/{isiMateri}', [IsiMateriController::class, 'update'])->name('mentor.isi-materi.update');
    Route::delete('/isi-materi/{isiMateri}', [IsiMateriController::class, 'destroy'])->name('mentor.isi-materi.destroy');

});