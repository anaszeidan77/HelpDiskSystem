<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;



Route::get('/', [DashboardController::class, 'index']);
Route::get('layout/dashboard', [DashboardController::class, 'index']);
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth'])
    ->name('dashboard');
Route::get('/tickets/{ticket}/comments', [TicketController::class, 'showComments'])->name('tickets.comments');

// Routes for Comments
Route::resource('comments', CommentController::class)->middleware('auth');

Route::resource('tickets', TicketController::class)->middleware('auth');

// Routes for Categories
Route::resource('categories', CategoryController::class)->middleware('auth');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// طرق إضافية للتعامل مع المستخدمين المحذوفين

Route::middleware('auth')->group(function () {
    Route::resource('users', UserController::class);
    Route::get('users/viewdeleteuser',[UserController::class,'viewdeleteuser'])->name('users.viewdeleteuser');
    Route::post('users/{id}/restore', [UserController::class, 'restore'])->name('users.restore');
    Route::delete('users/{id}/force-delete', [UserController::class, 'forceDelete'])->name('users.forceDelete');
});
require __DIR__.'/auth.php';
