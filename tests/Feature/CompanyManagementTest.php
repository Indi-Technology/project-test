<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CompanyManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_create_a_company(): void
    {
        $admin = User::factory()->create([
            'email' => 'testadmin@example.com'
        ]);

        $companyData = [
            'name' => 'Test Company',
            'email' => 'company@test.com',
            'description' => 'A test company.'
        ];

        $response = $this->actingAs($admin)
                         ->post(route('companies.store'), $companyData);

        $response->assertRedirect(route('companies.index'));
        $this->assertDatabaseHas('companies', [
            'name' => 'Test Company',
            'email' => 'company@test.com'
        ]);
    }
}
