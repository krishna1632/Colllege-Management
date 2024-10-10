<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\FacultyController;
use App\Http\Controllers\Admin\StudyMaterialController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\QuizController;
use App\Http\Controllers\Admin\QuestionController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/faculty', [FacultyController::class, 'store'])->name('faculty.store');
});

require __DIR__ . '/auth.php';

Route::middleware(['auth', 'userMiddleware'])->group(function () {
    Route::get('/user/dashboard', [UserController::class, 'index'])->name('dashboard');
});

Route::middleware(['auth', 'adminMiddleware'])->prefix('admin')->as('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
    Route::resource('faculty', FacultyController::class);
    Route::resource('study_materials', StudyMaterialController::class);
    Route::resource('quizzes', QuizController::class);



    Route::get('/quizzes/{quiz}/questions', [QuestionController::class, 'index'])->name('questions.index');
    Route::get('/quizzes/{quiz}/questions/create', [QuestionController::class, 'create'])->name('questions.create');
    Route::post('/quizzes/{quiz}/questions', [QuestionController::class, 'store'])->name('questions.store');
    Route::get('/questions/{id}/edit', [QuestionController::class, 'edit'])->name('questions.edit');
    Route::put('/questions/{id}', [QuestionController::class, 'update'])->name('questions.update');
    Route::delete('/questions/{id}', [QuestionController::class, 'destroy'])->name('questions.destroy');
    Route::post('/quizzes/{quiz}/finalSubmit', [QuizController::class, 'finalSubmit'])->name('quizzes.finalSubmit');
});

// Event routes for admin
Route::middleware(['auth', 'adminMiddleware'])->group(function () {
    Route::get('/admin/event', [EventController::class, 'index'])->name('admin.event.index');
    Route::get('/admin/event/create', [EventController::class, 'create'])->name('admin.event.create');
    Route::post('/admin/event', [EventController::class, 'store'])->name('event.store');
    Route::get('/admin/event/{event}/edit', [EventController::class, 'edit'])->name('admin.event.edit');
    Route::put('/admin/event/{event}', [EventController::class, 'update'])->name('admin.event.update');
    Route::delete('/admin/event/{event}', [EventController::class, 'destroy'])->name('admin.event.destroy');
});