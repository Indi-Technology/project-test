<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Employee;
use App\Models\Company;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil 10 company pertama
        $companies = Company::with('user')->take(10)->get();

        foreach ($companies as $company) {
            // Buat 11 employee untuk setiap company
            for ($i = 1; $i <= 11; $i++) {
                $user = User::create([
                    'name' => 'Employee ' . $i . ' - ' . $company->user->name,
                    'email' => 'employee' . $i . '_company' . $company->user->name . '@example.com',
                    'password' => bcrypt('password'),
                    'role' => 'employee',
                ]);

                Employee::create([
                    'user_id' => $user->id,
                    'company_id' => $company->user_id,
                    'phone' => '081234567' . str_pad($company->user_id . $i, 2, '0', STR_PAD_LEFT),
                    'logo' => 'employee-photo-' . $company->user_id . '-' . $i . '.jpg',
                ]);
            }
        }
    }
}
