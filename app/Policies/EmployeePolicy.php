<?php
namespace App\Policies;
use App\Models\Employee;
use App\Models\User;
class EmployeePolicy
{
    public function viewAny(User $user): bool { return true; }
    public function view(User $user, Employee $employee): bool
    {
        return $user->isAdmin() || $user->company_id === $employee->company_id;
    }
    public function create(User $user): bool { return true; }
    public function update(User $user, Employee $employee): bool
    {
        return $user->isAdmin() || $user->company_id === $employee->company_id;
    }
    public function delete(User $user, Employee $employee): bool
    {
        return $user->isAdmin() || $user->company_id === $employee->company_id;
    }
}
