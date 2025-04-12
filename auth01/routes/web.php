<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
Route::prefix('dashboard')->group(function(){
    Route::middleware('guest')->group(function(){
        Route::get('/',[AuthController::class, 'showLogin'])->name('auth.login.show');
        Route::post('/login',[AuthController::class, 'processLogin'])->name('auth.login.process');
        Route::get('/register',[AuthController::class, 'showRegister'])->name('auth.register.show');
        Route::post('/register',[AuthController::class, 'processRegister'])->name('auth.register.process');
    });
    Route::middleware('auth')->group(function(){
        Route::get('/teacher',[DashboardController::class, 'showTeacher'])->name('teacher.index');
        Route::get('/student',[DashboardController::class, 'showStudent'])->name('student.index');
        Route::get('/dashboard',[DashboardController::class, 'showDashboard'])->name('dashboard.index');
    }); 
   
});
