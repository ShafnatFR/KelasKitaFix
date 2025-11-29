<?php
use App\Http\Controllers\Mentor\KelasController;
use App\Http\Controllers\Mentor\MateriController;
use App\Http\Controllers\Mentor\IsiMateriController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\UserCourseController;
use App\Http\Controllers\ReviewController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {
    // Dashboard
    Route::get('/dashboard', function () {
        return redirect()->route('courses.index');
    })->name('dashboard');

    // Courses Routes (Halaman "My Courses")
    Route::get('/my-courses', [CourseController::class, 'index'])->name('courses.index');
    
    // Progress Routes (Halaman Progress Kursus)
    Route::get('/my-courses/{userCourse}', [UserCourseController::class, 'show'])->name('user-courses.show'); 
    Route::post('/progress/{courseProgress}/toggle', [UserCourseController::class, 'toggleProgress'])->name('progress.toggle');
    Route::post('/courses/{courseId}/progress/reset', [UserCourseController::class, 'resetProgress'])->name('progress.reset');

    // Review Routes
    Route::get('/courses/{courseId}/reviews', [ReviewController::class, 'index'])->name('reviews.index');
    Route::get('/courses/{courseId}/reviews/create', [ReviewController::class, 'create'])->name('reviews.create');
    Route::post('/courses/{courseId}/reviews', [ReviewController::class, 'store'])->name('reviews.store');
    Route::get('/courses/{courseId}/reviews/edit', [ReviewController::class, 'edit'])->name('reviews.edit');
    Route::put('/courses/{courseId}/reviews', [ReviewController::class, 'update'])->name('reviews.update');
    Route::delete('/courses/{courseId}/reviews', [ReviewController::class, 'destroy'])->name('reviews.destroy');
});

require __DIR__.'/auth.php';


Route::middleware(['auth'])->group(function () {

    // CRUD kelas
    Route::resource('kelas', KelasController::class);

    // CRUD materi
    Route::resource('materi', MateriController::class);

    // CRUD isi materi
    Route::resource('isi-materi', IsiMateriController::class);

});

