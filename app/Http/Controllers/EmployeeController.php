<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class EmployeeController extends Controller
{
	public function index(Request $request)
	{
		$companies = Company::all();

		$search = $request->input('search');
		$companySearch = $request->input('company');

		if (!$search && !$companySearch) {
			$employees = Employee::orderBy('created_at', 'desc')->paginate(10);

			return view('employees.index', compact('employees', 'companies'));
		}

		$employees = Employee::where(function ($query) use ($search) {
			$query->where('name', 'like', "%{$search}%")
				->orWhere('email', 'like', "%{$search}%");
		})
			->when($companySearch, function ($query) use ($companySearch) {
				$query->whereHas('company', function ($q) use ($companySearch) {
					$q->where('id', $companySearch);
				});
			})
			->orderBy('created_at', 'desc')
			->paginate(10);

		return view('employees.index', compact('employees', 'companies'));
	}

	public function create()
	{
		$companies = Company::all();
		return view('employees.create', compact('companies'));
	}

	public function store(Request $request)
	{
		try {
			$validated = $request->validate([
				'name'       => ['required', 'string', 'max:255'],
				'email'      => ['required', 'email', 'unique:employees,email'],
				'phone'      => ['required', 'string', 'max:20'],
				'company_id' => ['required', 'exists:companies,id'],
			], [
				'name.required'       => 'Name is required.',
				'email.required'      => 'Email is required.',
				'email.email'         => 'Email must be a valid email address.',
				'email.unique'        => 'Email has already been taken.',
				'phone.required'      => 'Phone number is required.',
				'company_id.required' => 'Company is required.',
				'company_id.exists'   => 'Selected company does not exist.',
			]);

			Employee::create($validated);

			return redirect()->route('employees')->with('success', 'Employee created sucessfully.');
		} catch (\Exception $e) {
			throw $e;
		}
	}

	public function show(Employee $employee)
	{
		$employee = Employee::findOrFail($employee->id);
		return view('employees.show', compact('employee'));
	}

	public function edit(Employee $employee)
	{
		$employee = Employee::findOrFail($employee->id);
		$companies = Company::all();
		return view('employees.edit', compact('employee', 'companies'));
	}

	public function update(Request $request, Employee $employee)
	{
		try {
			$validated = $request->validate([
				'name'       => ['required', 'string', 'max:255'],
				'email'      => ['required', 'email', Rule::unique('employees', 'email')->ignore($employee->id)],
				'phone'      => ['required', 'string', 'max:20'],
				'company_id' => ['required', 'exists:companies,id'],
			], [
				'name.required'       => 'Name is required.',
				'email.required'      => 'Email is required.',
				'email.email'         => 'Email must be a valid email address.',
				'email.unique'        => 'Email has already been taken.',
				'phone.required'      => 'Phone number is required.',
				'company_id.required' => 'Company is required.',
				'company_id.exists'   => 'Selected company does not exist.',
			]);

			$employee->update($validated);

			return redirect()->route('employees')->with('success', 'Employee updated successfully.');
		} catch (\Exception $e) {
			throw $e;
		}
	}

	public function destroy(Employee $employee)
	{
		$employee->delete();
		return redirect()->route('employees')->with('success', 'Employee deleted successfully.');
	}
}
