<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\Employee;

class DashboardController extends Controller
{
  public function index()
  {
    $user = auth()->user();

    $data = [
      'user' => $user,
      'totalCompanies' => $user->isAdmin() ? Company::count() : 0,
      'totalEmployees' => $user->isAdmin() ? Employee::count() :
        ($user->isCompany() ? Employee::where('company_id', $user->company_id)->count() : 0),
    ];

    return view('dashboard', $data);
  }
}
