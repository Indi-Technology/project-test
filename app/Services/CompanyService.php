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
        // Eager loading untuk menghindari N+1 query
        $companies = Company::with(['user', 'employees.user'])->get();
        return $companies;
    }

    public function createCompany($request)
    {
        // Logic to create a new company
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

                // Return company dengan detail name saja
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

    public function updateCompany(int $id, array $data)
    {
        // Logic to update an existing company
    }

    public function deleteCompany(int $id)
    {
        // Logic to delete a company
    }
}