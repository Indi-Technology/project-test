<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/companies', [App\Http\Controllers\CompanyController::class, 'index'])->name('companies.index');
Route::get('/companies/create', [App\Http\Controllers\CompanyController::class, 'create'])->name('companies.create');
Route::post('/companies/create', [App\Http\Controllers\CompanyController::class, 'store'])->name('companies.store');
