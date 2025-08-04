<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Company;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i <= 25; $i++) {
            $user = User::create([
                'name' => 'Company ' . $i,
                'email' => 'company' . $i . '@example.com',
                'password' => bcrypt('password'), 
                'role' => 'company',
            ]);

            Company::create([
                'user_id' => $user->id,
                'description' => 'Description for company ' . $i,
                'logo' => 'logo-' . $i . '.png',
            ]);
        }
    }
}
