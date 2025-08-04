<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Http\Requests\CompanyRequest;
use App\Mail\CompanyWelcomeMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;

class CompanyController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    $companies = Company::paginate(10);
    return view('companies.index', compact('companies'));
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    return view('companies.create');
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(CompanyRequest $request)
  {
    $data = $request->validated();
    if ($request->hasFile('logo')) {
      $data['logo'] = $request->file('logo')->store('logos', 'public');
    }

    $company = Company::create($data);
    
    // Kirim email selamat datang ke company
    try {
      Mail::to($company->email)->send(new CompanyWelcomeMail($company));
    } catch (\Exception $e) {
      \Log::error('Failed to send welcome email to company: ' . $e->getMessage());
    }
    
    return redirect()->route('companies.index')
      ->with('success', 'Company created successfully and welcome email has been sent.');
  }

  /**
   * Display the specified resource.
   */
  public function show(Company $company)
  {
    return view('companies.show', compact('company'));
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(Company $company)
  {
    return view('companies.edit', compact('company'));
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(CompanyRequest $request, Company $company)
  {
    $data = $request->validated();

    if ($request->hasFile('logo')) {
      // Delete old logo if exists
      if ($company->logo) {
        Storage::disk('public')->delete($company->logo);
      }
      $data['logo'] = $request->file('logo')->store('logos', 'public');
    }

    $company->update($data);

    return redirect()->route('companies.index')
      ->with('success', 'Company updated successfully.');
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Company $company)
  {
    // Delete logo if exists
    if ($company->logo) {
      Storage::disk('public')->delete($company->logo);
    }

    $company->delete();

    return redirect()->route('companies.index')
      ->with('success', 'Company deleted successfully.');
  }
}
