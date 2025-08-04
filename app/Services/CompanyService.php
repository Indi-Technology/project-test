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
        ->select('user_id', 'description', 'logo')
        ->get()
        ->map(function ($company) {
            return [
                'id' => $company->user_id,
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
        ->select('user_id', 'description', 'logo')
        ->findOrFail($id);

        return [
            'id' => $company->user_id,
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

    public function updateCompany(string $id, array $data)
    {
        try {
            return DB::transaction(function () use ($id, $data) {
                $company = Company::findOrFail($id);
                $company->update($data);

                return [
                    'name' => $company->user->name,
                    'message' => 'Company updated successfully'
                ];
            });
        } catch (\Exception $e) {
            // Handle the exception
            return [
                'error' => 'Failed to update company: ' . $e->getMessage()
            ];
        }
    }

    public function deleteCompany(string $id)
    {
        try {
            return DB::transaction(function () use ($id) {
                $company = Company::findOrFail($id);
                $company->delete();

                return [
                    'name' => $company->user->name,
                    'message' => 'Company deleted successfully'
                ];
            });
        } catch (\Exception $e) {
            // Handle the exception
            return [
                'error' => 'Failed to delete company: ' . $e->getMessage()
            ];
        }
    }
}