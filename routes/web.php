<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\CheckRole;
use App\Models\Company;
use App\Models\Employee;
use Illuminate\Support\Facades\Route;

//Route::get('/', function () {
//	return view('welcome');
//});

Route::redirect('/', '/dashboard');

Route::get('/dashboard', function () {
	$companies = Company::all();
	$employees = Employee::all();

	return view('dashboard', [
		'companies' => $companies,
		'employees' => $employees,
	]);
})->name('dashboard')->middleware('auth');

Route::middleware('role:admin')->group(function () {
	Route::group(['prefix' => 'companies'], function () {
		Route::get('/', [CompanyController::class, 'index'])->name('companies');

		Route::get('/create', [CompanyController::class, 'create'])->name('companies.create');

		Route::post('/store', [CompanyController::class, 'store'])->name('companies.store');

		Route::get('/{company}', [CompanyController::class, 'show'])->name('companies.show');

		Route::get('/{company}/edit', [CompanyController::class, 'edit'])->name('companies.edit');

		Route::put('/{company}/update', [CompanyController::class, 'update'])->name('companies.update');

		Route::delete('/{company}/delete', [CompanyController::class, 'destroy'])->name('companies.delete');

		Route::put('/{company}/logo', [CompanyController::class, 'removeLogo'])->name('companies.removeLogo');
	});
});

Route::group(['prefix' => 'employees'], function () {
	Route::get('/', [EmployeeController::class, 'index'])->name('employees');

	Route::get('/create', [EmployeeController::class, 'create'])->name('employees.create');

	Route::post('/store', [EmployeeController::class, 'store'])->name('employees.store');

	Route::get('/{employee}', [EmployeeController::class, 'show'])->name('employees.show');

	Route::get('/{employee}/edit', [EmployeeController::class, 'edit'])->name('employees.edit');

	Route::put('/{employee}/update', [EmployeeController::class, 'update'])->name('employees.update');

	Route::delete('/{employee}/delete', [EmployeeController::class, 'destroy'])->name('employees.delete');
})->middleware('auth');

Route::middleware('auth')->group(function () {
	Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
	Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
	Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
