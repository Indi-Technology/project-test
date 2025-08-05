<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Employee;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EmployeeSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 */
	public function run(): void
	{
		$company = Company::all();

		for ($i = 1; $i <= 60; $i++) {
			Employee::create([
				'company_id' => $company->random()->id,
				'name'       => 'Employee ' . $i,
				'email'      => 'employee' . $i . '@example.com',
				'phone'      => '+62 812345678' . $i,
			]);
		}
	}
}
