<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Company;
use App\Http\Requests\EmployeeRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EmployeeController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    $user = auth()->user();
    if ($user->isAdmin()) {
      $employees = Employee::with('company')->paginate(10);
    } else {
      $employees = Employee::where('company_id', $user->company_id)
        ->with('company')
        ->paginate(10);
    }

    return view('employees.index', compact('employees'));
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    $user = auth()->user();

    if ($user->isAdmin()) {
      $companies = Company::all();
    } else {
      $companies = Company::where('id', $user->company_id)->get();
    }

    return view('employees.create', compact('companies'));
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(EmployeeRequest $request)
  {
    $data = $request->validated();

    $user = auth()->user();

    // If user is company, only allow creating employees for their company
    if ($user->isCompany()) {
      $data['company_id'] = $user->company_id;
    }

    // Handle profile picture upload
    if ($request->hasFile('profile_picture')) {
      $data['profile_picture'] = $request->file('profile_picture')->store('profile_pictures', 'public');
    }

    Employee::create($data);

    return redirect()->route('employees.index')
      ->with('success', 'Employee created successfully.');
  }

  /**
   * Display the specified resource.
   */
  public function show(Employee $employee)
  {
    $user = auth()->user();

    // Check access
    if ($user->isCompany() && $employee->company_id !== $user->company_id) {
      abort(403);
    }

    return view('employees.show', compact('employee'));
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(Employee $employee)
  {
    $user = auth()->user();

    // Check access
    if ($user->isCompany() && $employee->company_id !== $user->company_id) {
      abort(403);
    }

    if ($user->isAdmin()) {
      $companies = Company::all();
    } else {
      $companies = Company::where('id', $user->company_id)->get();
    }

    return view('employees.edit', compact('employee', 'companies'));
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(EmployeeRequest $request, Employee $employee)
  {
    $user = auth()->user();

    // Check access
    if ($user->isCompany() && $employee->company_id !== $user->company_id) {
      abort(403);
    }

    $data = $request->validated();

    // If user is company, only allow updating employees for their company
    if ($user->isCompany()) {
      $data['company_id'] = $user->company_id;
    }

    // Handle profile picture upload
    if ($request->hasFile('profile_picture')) {
      // Delete old profile picture if exists
      if ($employee->profile_picture) {
        Storage::disk('public')->delete($employee->profile_picture);
      }
      $data['profile_picture'] = $request->file('profile_picture')->store('profile_pictures', 'public');
    }

    $employee->update($data);

    return redirect()->route('employees.index')
      ->with('success', 'Employee updated successfully.');
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Employee $employee)
  {
    $user = auth()->user();

    // Check access
    if ($user->isCompany() && $employee->company_id !== $user->company_id) {
      abort(403);
    }

    // Delete profile picture if exists
    if ($employee->profile_picture) {
      Storage::disk('public')->delete($employee->profile_picture);
    }

    $employee->delete();

    return redirect()->route('employees.index')
      ->with('success', 'Employee deleted successfully.');
  }
}
