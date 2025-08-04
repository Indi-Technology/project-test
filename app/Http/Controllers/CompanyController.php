<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CompanyService;
use App\Http\Requests\StoreCompanyRequest;

class CompanyController extends Controller
{

    public function __construct(protected CompanyService $companyService)
    {
        
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $companies = $this->companyService->getAllCompanies();
        return view('list-companies', compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('create-company');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCompanyRequest $request)
    {
        $company = $this->companyService->createCompany($request);

        if (isset($company['error'])) {
            return redirect()->back()->withErrors($company['error']);
        }

        return redirect()->route('companies.index')->with('success', $company['message']);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $result = $this->companyService->getCompanyWithEmployees($id);

        return view('show-company', compact('result'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $company = $this->companyService->getCompanyById($id);

        return view('edit-company', compact('company'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $company = $this->companyService->updateCompany($id, $request->all());

        if (isset($company['error'])) {
            return redirect()->back()->withErrors($company['error']);
        }

        return redirect()->route('companies.index')->with('success', 'Company updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $result = $this->companyService->deleteCompany($id);

        if (isset($result['error'])) {
            return redirect()->back()->withErrors($result['error']);
        }

        return redirect()->route('companies.index')->with('success', 'Company deleted successfully');
    }
}
