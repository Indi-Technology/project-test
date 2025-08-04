<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\EmployeeController;
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
    
    // Companies routes - Only for admin
    Route::middleware('admin')->group(function () {
        Route::get('companies', [CompanyController::class, 'index'])
            ->name('companies.index');
        
        Route::get('companies/create', [CompanyController::class, 'create'])
            ->name('companies.create');
        
        Route::post('companies/create', [CompanyController::class, 'store'])
            ->name('companies.store');
        
        Route::get('companies/{id}', [CompanyController::class, 'show'])
            ->name('companies.show');
        
        Route::get('companies/{id}/edit', [CompanyController::class, 'edit'])
            ->name('companies.edit');
        
        Route::put('companies/{id}/edit', [CompanyController::class, 'update'])
            ->name('companies.update');
        Route::patch('companies/{id}/edit', [CompanyController::class, 'update']);
        
        Route::delete('companies/{id}/delete', [CompanyController::class, 'destroy'])
            ->name('companies.destroy');
    });

    // Employee routes - Only for company role
    Route::middleware('company')->group(function () {
        Route::get('employees', [EmployeeController::class, 'index'])
            ->name('employees.index');
        
        Route::get('employees/create', [EmployeeController::class, 'create'])
            ->name('employees.create');
        
        Route::post('employees/create', [EmployeeController::class, 'store'])
            ->name('employees.store');
        
        Route::get('employees/{employee}', [EmployeeController::class, 'show'])
            ->name('employees.show');
        
        Route::get('employees/{employee}/edit', [EmployeeController::class, 'edit'])
            ->name('employees.edit');
        
        Route::put('employees/{employee}/edit', [EmployeeController::class, 'update'])
            ->name('employees.update');
        Route::patch('employees/{employee}/edit', [EmployeeController::class, 'update']);
        
        Route::delete('employees/{employee}/delete', [EmployeeController::class, 'destroy'])
            ->name('employees.destroy');
    });
});

require __DIR__.'/auth.php';
