<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CompanyService;

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
        $company = $this->companyService->getCompanyById($id);
        return view('show-company', compact('company'));
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
        // Logic to update a specific company
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Logic to delete a specific company
    }
}
