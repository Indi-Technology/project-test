<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/companies', [App\Http\Controllers\CompanyController::class, 'index'])->name('companies.index');
Route::get('/companies/create', [App\Http\Controllers\CompanyController::class, 'create'])->name('companies.create');
Route::post('/companies/create', [App\Http\Controllers\CompanyController::class, 'store'])->name('companies.store');
Route::get('/companies/{id}', [App\Http\Controllers\CompanyController::class, 'show'])->name('companies.show');
Route::get('/companies/{id}/edit', [App\Http\Controllers\CompanyController::class, 'edit'])->name('companies.edit');
Route::put('/companies/{id}/edit', [App\Http\Controllers\CompanyController::class, 'update'])->name('companies.update');
Route::delete('/companies/{id}/delete', [App\Http\Controllers\CompanyController::class, 'destroy'])->name('companies.destroy');
