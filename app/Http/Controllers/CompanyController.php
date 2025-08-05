<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\User;
use App\Notifications\CompanyRegistered;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class CompanyController extends Controller
{
	public function index(Request $request)
	{
		$search = $request->input('search');

		if (!Auth::user()->role == 'admin') {
			$companies = Company::where('user_id', Auth::user()->id);
		} else {
			$companies = Company::query();
		}

		if (!$search) {
			$companies = $companies->orderBy('created_at', 'desc')->paginate(10);

			return view('companies.index', compact('companies'));
		}

		$companies = $companies->where('name', 'like', "%{$search}%")
			->orWhere('email', 'like', "%{$search}%")
			->orderBy('created_at', 'desc')
			->paginate(10);

		return view('companies.index', compact('companies'));
	}

	public function create()
	{
		return view('companies.create');
	}

	public function store(Request $request)
	{
		try {
			DB::transaction(function () use ($request) {
				$validated = $request->validate([
					'name'        => ['required', 'string', 'max:255'],
					'email'       => ['required', 'string', 'email', 'max:255', 'unique:companies,email'],
					'logo'        => [
						'nullable',
						'image',
						'max:2048',
						Rule::dimensions()->minWidth(100)->minHeight(100)
					],
					'password'    => ['required', 'string', 'min:8'],
					'description' => ['nullable', 'string'],
				], [
					'name.required'      => 'Name is required.',
					'email.required'     => 'Email is required.',
					'email.email'        => 'Email must be a valid email address.',
					'email.unique'       => 'Email has already been taken.',
					'logo.image'         => 'Logo must be an image file.',
					'logo.max'           => 'Logo size must not exceed 2MB.',
					'logo.dimensions'    => 'Logo must be at least 100x100 pixels.',
					'password.required'  => 'Password is required.',
					'password.min'       => 'Password must be at least 8 characters.',
					'description.string' => 'Description must be a string.',
				]);

				if ($request->hasFile('logo')) {
					$logoPath = $request->file('logo')->store('logo', 'public');
				}

				$user = User::create([
					'name'     => $validated['name'],
					'email'    => $validated['email'],
					'password' => bcrypt($validated['password']),
					'role'     => 'user',
				]);

				$company = Company::create([
					'name'        => $validated['name'],
					'email'       => $validated['email'],
					'logo'        => isset($logoPath) ? $logoPath : null,
					'description' => $validated['description'],
					'user_id'     => $user->id
				]);

				$admin = User::first();
				$admin->notify(new CompanyRegistered($company));
			});

			return redirect()->route('companies')->with('success', 'Company created successfully.');
		} catch (ValidationException $e) {
			throw $e;
		}
	}

	public function show(Company $company)
	{
		$company = Company::findOrFail($company->id);
		$employees = $company->employees()->orderBy('created_at', 'desc')->paginate(10);
		return view('companies.show', compact('company', 'employees'));
	}

	public function edit(Company $company)
	{
		$company = Company::findOrFail($company->id);
		return view('companies.edit', compact('company'));
	}

	public function update(Request $request, Company $company)
	{
		try {
			$validated = $request->validate([
				'name'        => ['required', 'string', 'max:255'],
				'email'       => ['required', 'string', 'email', 'max:255', Rule::unique('companies')->ignore($company->id)],
				'logo'        => [
					'nullable',
					'image',
					'max:2048',
					Rule::dimensions()->minWidth(100)->minHeight(100)
				],
				'description' => ['nullable', 'string'],
			], [
				'name.required'   => 'Name is required.',
				'email.required'  => 'Email is required.',
				'email.email'     => 'Email must be a valid email address.',
				'email.unique'    => 'Email has already been taken.',
				'logo.image'      => 'Logo must be an image file.',
				'logo.max'        => 'Logo size must not exceed 2MB.',
				'logo.dimensions' => 'Logo must be at least 100x100 pixels.'
			]);

			if ($request->hasFile('logo')) {
				if ($company->logo) {
					Storage::disk('public')->delete($company->logo);
				}
				$logoPath = $request->file('logo')->store('logo', 'public');
				$validated['logo'] = $logoPath;
			}

			$company->update($validated);

			return redirect()->route('companies', $company->id)->with('success', 'Company updated successfully.');
		} catch (ValidationException $e) {
			throw $e;
		}
	}

	public function destroy(Company $company)
	{
		try {
			DB::transaction(function () use ($company) {
				if ($company->logo) {
					Storage::disk('public')->delete($company->logo);
				}

				$company->employees()->each(function ($employee) {
					$employee->delete();
				});

				$company->user()->delete();

				$company->delete();
			});

			return redirect()->route('companies')->with('success', 'Company deleted successfully.');
		} catch (\Exception $e) {
			return redirect()->route('companies')->with('error', 'Failed to delete company: ' . $e->getMessage());
		}
	}

	public function removeLogo(Company $company)
	{
		if (!$company->logo) {
			return redirect()->route('companies.edit', $company->id)->with('error', 'No logo to remove.');
		}

		Storage::disk('public')->delete($company->logo);
		$company->logo = null;
		$company->save();
		return redirect()->route('companies.edit', $company->id)->with('success', 'Logo removed successfully.');
	}
}
