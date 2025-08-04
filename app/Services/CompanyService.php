<?php

namespace App\Services;
use App\Models\Company;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CompanyService
{
    /**
     * Logic to handle company-related operations.
     */
    public function getAllCompanies()
    {
        $companies = Company::with([
            'user:id,name', 
            'employees:id,company_id,phone,logo', 
            'employees.user:id,name'
        ])
        ->select('id', 'user_id', 'description', 'logo')
        ->get()
        ->map(function ($company) {
            return [
                'id' => $company->id,
                'name' => $company->user->name,
                'description' => $company->description,
                'logo' => $company->logo,
                'employees' => $company->employees->map(function ($employee) {
                    return [
                        'name' => $employee->user->name,
                        'phone' => $employee->phone,
                        'logo' => $employee->logo
                    ];
                })
            ];
        });
        
        return $companies;
    }

    public function createCompany($request)
    {
        try {
            return DB::transaction(function () use ($request) {
                $user = User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                    'role' => 'company',
                ]);
    
                $company = Company::create([
                    'user_id' => $user->id,
                    'description' => $request->description,
                    'logo' => $request->logo,
                ]);

                return [
                    'name' => $user->name,
                    'message' => 'Company created successfully'
                ];
            });
        } catch (\Exception $e) {
            // Handle the exception
            return [
                'error' => 'Failed to create company: ' . $e->getMessage()
            ];
        }
    }

    public function getCompanyById(string $id)
    {
        $company = Company::with([
            'user:id,name',
            'employees:id,company_id,phone,logo',
            'employees.user:id,name'
        ])
        ->select('id', 'user_id', 'description', 'logo')
        ->findOrFail($id);

        return [
            'id' => $company->id,
            'name' => $company->user->name,
            'description' => $company->description,
            'logo' => $company->logo,
            'employees' => $company->employees->map(function ($employee) {
                return [
                    'name' => $employee->user->name,
                    'phone' => $employee->phone,
                    'logo' => $employee->logo
                ];
            })
        ];
    }

    public function updateCompany(int $id, array $data)
    {
        // Logic to update an existing company
    }

    public function deleteCompany(int $id)
    {
        // Logic to delete a company
    }
}