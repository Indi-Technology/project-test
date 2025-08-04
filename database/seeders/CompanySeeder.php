<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 */
	public function run(): void
	{
		for ($i = 1; $i <= 20; $i++) {
			Company::create([
				'name'        => 'Company ' . $i,
				'email'       => 'company' . $i . '@example.com',
				'description' => 'This is a sample company description for Company ' . $i,
			]);
		}
	}
}
