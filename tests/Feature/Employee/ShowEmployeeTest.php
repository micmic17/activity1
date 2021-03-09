<?php

namespace Tests\Feature\Employee;

use App\Models\User;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ShowEmployeeTest extends TestCase
{
    use WithFaker;

    private $data;

    protected function setUp(): void
    {
        parent::setUp();
        Artisan::call('storage:link');

        $user = User::whereEmail('admin@admin.com')->first();
        $company = $this->actingAs($user, 'api')->json('POST', '/api/company', [
                        'name' => $this->faker->company,
                        'email' => $this->faker->companyEmail,
                    ]);
        $this->data = [
            'first_name' => $this->faker->firstNameMale,
            'last_name' => $this->faker->lastName,
            'email' => $this->faker->companyEmail,
            'phone' => $this->faker->phoneNumber,
            'company_id' => $company->original['data']->id,
        ];

        $this->json('POST', '/api/employee', $this->data);
    }

    /**
     * @test
     */
    public function login_user_can_see_specific_company()
    {
        $response = $this->json('GET', '/api/employee/' . $this->data['company_id']);

        $response->assertStatus(200)
                ->assertJsonStructure([
                    "data",
                    "message"
                ]);
    }

    /**
     * @test
     */
    public function company_does_not_exist()
    {
        $response = $this->json('GET', '/api/employee/300');

        $response->assertStatus(404)
                ->assertJson([
                    "response" => "",
                    "message" => [
                        "Employee not found!"
                    ]
                ]);
    }
}