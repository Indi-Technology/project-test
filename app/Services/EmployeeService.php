<?php

namespace App\Services;
use App\Models\Company;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class EmployeeService 
{
    /**
     * Logic to handle employee-related operations.
     */
    public function getAllEmployees(string $companyId)
    {
        // Eager loading with pagination (10 entries per page)
        $employees = Employee::with([
            'user:id,name,email', 
            'company:user_id,description,logo'
        ])
        ->select('user_id', 'company_id', 'phone', 'logo')
        ->where('company_id', $companyId)
        ->paginate(10); // Using paginate() instead of get()

        // Transform data using getCollection() for pagination
        $employees->getCollection()->transform(function ($employee) {
            return [
                'id' => $employee->user_id,
                'name' => $employee->user->name,
                'email' => $employee->user->email,
                'phone' => $employee->phone,
                'logo' => $employee->logo,
                'company' => [
                    'id' => $employee->company->user_id,
                    'description' => $employee->company->description,
                    'logo' => $employee->company->logo
                ]
            ];
        });

        return $employees;
    }

    public function createEmployee($request, string $companyId)
    {
        try {
            return DB::transaction(function () use ($request, $companyId) {
                $user = User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                    'role' => 'employee',
                ]);

                $employee = Employee::create([
                    'user_id' => $user->id,
                    'company_id' => $companyId,
                    'phone' => $request->phone,
                    'logo' => $request->logo,
                ]);

                return $employee;
            });
        } catch (\Exception $e) {
            // Handle exception
            throw new \Exception('Error creating employee: ' . $e->getMessage());
        }
    }

    public function updateEmployee($request, string $employeeId)
    {
        try {
            return DB::transaction(function () use ($request, $employeeId) {
                $employee = Employee::findOrFail($employeeId);
                $employee->update([
                    'phone' => $request->phone,
                    'logo' => $request->logo,
                ]);

                return $employee;
            });
        } catch (\Exception $e) {
            // Handle exception
            throw new \Exception('Error updating employee: ' . $e->getMessage());
        }
    }

    public function deleteEmployee(string $employeeId)
    {
        try {
            return DB::transaction(function () use ($employeeId) {
                $employee = Employee::findOrFail($employeeId);
                $employee->delete();

                return $employee;
            });
        } catch (\Exception $e) {
            // Handle exception
            throw new \Exception('Error deleting employee: ' . $e->getMessage());
        }
    }
}