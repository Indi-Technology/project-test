<?php

namespace App\Services;

use App\Models\Employee;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class EmployeeService
{
    /**
     * Logic to handle employee-related operations.
     */
    public function getAllEmployees(string $companyId)
    {
        $employees = Employee::with([
            'user:id,name,email', 
            'company:user_id,description,logo'
        ])
        ->select('user_id', 'company_id', 'phone', 'logo')
        ->where('company_id', $companyId)
        ->paginate(10); 

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

    /**
     * Create new employee
     */
    public function createEmployee($request)
    {
        try {
            return DB::transaction(function () use ($request) {
                $user = User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                    'role' => 'employee',
                ]);

                $employee = Employee::create([
                    'user_id' => $user->id,
                    'company_id' => $request->company_id,
                    'phone' => $request->phone,
                    'logo' => $request->logo,
                ]);

                return [
                    'name' => $user->name,
                    'message' => 'Employee created successfully'
                ];
            });
        } catch (\Exception $e) {
            return [
                'error' => 'Failed to create employee: ' . $e->getMessage()
            ];
        }
    }

    /**
     * Get employee by ID
     */
    public function getEmployeeById($id)
    {
        $employee = Employee::with(['user:id,name,email', 'company.user:id,name'])
            ->findOrFail($id);

        return [
            'id' => $employee->user_id,
            'name' => $employee->user->name,
            'email' => $employee->user->email,
            'phone' => $employee->phone,
            'logo' => $employee->logo,
            'company_name' => $employee->company->user->name ?? 'No Company',
            'company_id' => $employee->company_id
        ];
    }

    /**
     * Update employee dengan validasi company - hanya phone dan logo
     */
    public function updateEmployee($id, $data, $companyId)
    {
        try {
            return DB::transaction(function () use ($id, $data, $companyId) {
                $employee = Employee::where('user_id', $id)
                    ->where('company_id', $companyId)
                    ->firstOrFail();

                $employeeData = [
                    'phone' => $data['phone'] ?? $employee->phone,
                ];

                if (isset($data['logo']) && $data['logo']) {
                    if ($employee->logo) {
                        Storage::disk('public')->delete($employee->logo);
                    }
                    
                    $employeeData['logo'] = $data['logo']->store('employee-photos', 'public');
                } else {
                    $employeeData['logo'] = $employee->logo;
                }

                $employee->update($employeeData);

                return [
                    'message' => 'Employee updated successfully'
                ];
            });
        } catch (\Exception $e) {
            return [
                'error' => 'Failed to update employee: ' . $e->getMessage()
            ];
        }
    }

    /**
     * Delete employee dengan validasi company
     */
    public function deleteEmployee($id, $companyId)
    {
        try {
            return DB::transaction(function () use ($id, $companyId) {
                $employee = Employee::where('user_id', $id)
                    ->where('company_id', $companyId)
                    ->firstOrFail();

                if ($employee->logo) {
                    Storage::disk('public')->delete($employee->logo);
                }

                $employee->delete();
                
                $employee->user->delete();

                return [
                    'message' => 'Employee deleted successfully'
                ];
            });
        } catch (\Exception $e) {
            return [
                'error' => 'Failed to delete employee: ' . $e->getMessage()
            ];
        }
    }
}