<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/companies', [App\Http\Controllers\CompanyController::class, 'index']);
