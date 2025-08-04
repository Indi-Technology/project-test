<?php

namespace App\Services;
use App\Models\Company;

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

    public function createCompany(array $data)
    {
        // Logic to create a new company
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