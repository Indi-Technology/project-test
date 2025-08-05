<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 */
	public function run(): void
	{
		User::create([
			'name'              => 'Admin',
			'email'             => 'admin@admin.com',
			'password'          => bcrypt('password'),
			'email_verified_at' => now(),
			'role'              => 'admin',
		]);

		for ($i = 1; $i <= 20; $i++) {
			User::create([
				'name'              => 'Company ' . $i,
				'email'             => 'company' . $i . '@example.com',
				'password'          => bcrypt('password'),
				'email_verified_at' => now(),
				'role'              => 'user',
			]);
		}
	}
}
