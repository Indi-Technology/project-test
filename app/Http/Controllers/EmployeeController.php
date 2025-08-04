<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Company;
use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;

class EmployeeController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Employee::class, 'employee');
    }
    public function index()
    {
    $user = auth()->user();
    $query = Employee::with('company')->latest();

    if (!$user->isAdmin()) {
        $query->where('company_id', $user->company_id);
    }

    $employees = $query->paginate(10);
    return view('employees.index', compact('employees'));
}

    public function create()
    {
        $companies = Company::orderBy('name')->get();
        return view('employees.create', compact('companies'));
    }

    public function store(StoreEmployeeRequest $request)
    {
        Employee::create($request->validated());
        return redirect()->route('employees.index')->with('success', 'Employee created successfully.');
    }

    public function show(Employee $employee)
    {
        return view('employees.show', compact('employee'));
    }

    public function edit(Employee $employee)
    {
        $companies = Company::orderBy('name')->get();
        return view('employees.edit', compact('employee', 'companies'));
    }

    public function update(UpdateEmployeeRequest $request, Employee $employee)
    {
        $employee->update($request->validated());
        return redirect()->route('employees.index')->with('success', 'Employee updated successfully.');
    }

    public function destroy(Employee $employee)
    {
        $employee->delete();
        return redirect()->route('employees.index')->with('success', 'Employee deleted successfully.');
    }
}
