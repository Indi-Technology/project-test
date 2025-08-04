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
            'employees:user_id,company_id,phone,logo', 
            'employees.user:id,name'
        ])
        ->select('user_id', 'description', 'logo')
        ->paginate(10); 

        $companies->getCollection()->transform(function ($company) {
            return [
                'id' => $company->user_id,
                'name' => $company->user->name,
                'description' => $company->description,
                'logo' => $company->logo,
                'employees_count' => $company->employees->count(),
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

                $company = $user->companies()->create([
                    'description' => $request->description,
                    'logo' => $request->logo,
                ]);

                return [
                    'name' => $user->name,
                    'message' => 'Company created successfully'
                ];
            });
        } catch (\Exception $e) {
            return [
                'error' => 'Failed to create company: ' . $e->getMessage()
            ];
        }
    }

    public function getCompanyById(string $id)
    {
        $company = Company::with('user:id,name,email')
            ->select('user_id', 'description', 'logo')
            ->findOrFail($id);

        return [
            'id' => $company->user_id,
            'name' => $company->user->name,
            'email' => $company->user->email,
            'description' => $company->description,
            'logo' => $company->logo,
        ];
    }

    public function getCompanyWithEmployees(string $id, int $perPage = 10)
    {
        $company = Company::with('user:id,name,email')
            ->select('user_id', 'description', 'logo')
            ->findOrFail($id);

        $employees = $company->employees()
            ->with('user:id,name')
            ->select('user_id', 'company_id', 'phone', 'logo')
            ->paginate($perPage);

        $employees->getCollection()->transform(function ($employee) {
            return [
                'id' => $employee->user_id,
                'name' => $employee->user->name,
                'phone' => $employee->phone,
                'logo' => $employee->logo
            ];
        });

        return [
            'company' => [
                'id' => $company->user_id,
                'name' => $company->user->name,
                'email' => $company->user->email,
                'description' => $company->description,
                'logo' => $company->logo,
            ],
            'employees' => $employees
        ];
    }

    public function updateCompany(string $id, array $data)
    {
        try {
            return DB::transaction(function () use ($id, $data) {
                $company = Company::where('user_id', $id)->firstOrFail();
                
                $company->update([
                    'description' => $data['description'] ?? $company->description,
                    'logo' => $data['logo'] ?? $company->logo,
                ]);

                if (isset($data['name'])) {
                    $company->user->update(['name' => $data['name']]);
                }

                return [
                    'message' => 'Company updated successfully'
                ];
            });
        } catch (\Exception $e) {
            return [
                'error' => 'Failed to update company: ' . $e->getMessage()
            ];
        }
    }

    public function deleteCompany(string $id)
    {
        try {
            return DB::transaction(function () use ($id) {
                $company = Company::where('user_id', $id)->firstOrFail();
                
                $company->employees()->delete();
                
                $company->delete();
                
                $company->user->delete();

                return [
                    'message' => 'Company deleted successfully'
                ];
            });
        } catch (\Exception $e) {
            return [
                'error' => 'Failed to delete company: ' . $e->getMessage()
            ];
        }
    }
}