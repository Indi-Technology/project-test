<?php
namespace App\Providers;

use App\Models\Company;
use App\Models\Employee;
use App\Policies\CompanyPolicy;
use App\Policies\EmployeePolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Company::class => CompanyPolicy::class,
        Employee::class => EmployeePolicy::class,
    ];

    public function boot(): void
    {
        // ...
    }
}
