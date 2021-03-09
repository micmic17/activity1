<?php

namespace Tests\Feature\Employee;

use App\Models\User;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CreateEmployeeTest extends TestCase
{
    
    use WithFaker;

    private $first_name;
    private $last_name;
    private $email;
    private $phone;
    private $user;
    private $data;

    protected function setUp(): void
    {
        parent::setUp();
        Artisan::call('storage:link');

        $this->user = User::whereEmail('admin@admin.com')->first();
        $this->data = [
            'first_name' => $this->faker->firstNameMale,
            'last_name' => $this->faker->lastName,
            'email' => $this->faker->companyEmail,
            'phone' => $this->faker->phoneNumber,
            'company_id' => 1
        ];
    }

    /**
     * @test
     */
    public function login_user_can_create_employee()
    {
        $company = $this->actingAs($this->user, 'api')->json('POST', '/api/company', [
            'name' => $this->faker->company,
            'email' => $this->faker->companyEmail,
        ]);

        $this->data['company_id'] = $company->original['data']->id;

        $response = $this->actingAs($this->user, 'api')->json('POST', '/api/employee', $this->data);
        $response->assertStatus(200)
                ->assertJsonStructure([
                    "data",
                    "message"
                ]);

        return $response;
    }

    /**
     * @test
     */
    public function non_login_user_cannot_create_company()
    {
        $response = $this->json('POST', '/api/employee', $this->data);

        $response->assertStatus(401)
                ->assertJson([
                    "message" => 'Permission Denied'
                ]);
    }

    /**
     * @test
     */
    public function name_and_email_should_be_required()
    {
        $company = $this->actingAs($this->user, 'api')->json('POST', '/api/company', [
            'name' => $this->faker->company,
            'email' => $this->faker->companyEmail,
        ]);

        $this->data['company_id'] = $company->original['data']->id;
        $this->data['first_name'] = $this->data['last_name'] = null;
        
        // $this->withOutExceptionHandling();
        $response = $this->actingAs($this->user, 'api')->json('POST', '/api/employee', $this->data);

        $response->assertStatus(422)
                ->assertJson([
                    "message" => 'The given data was invalid.',
                    "errors" => [
                        "first_name" => [
                            'The first name field is required.'
                        ],
                        "last_name" => [
                            'The last name field is required.'
                        ]
                    ]
                ]);
    }

    /**
     * @test
     */
    public function email_should_be_unique()
    {
        $company = $this->actingAs($this->user, 'api')->json('POST', '/api/company', [
            'name' => $this->faker->company,
            'email' => $this->faker->companyEmail,
        ]);

        // Creating new data
        $this->data['company_id'] = $company->original['data']->id;
        $firstData = $this->actingAs($this->user, 'api')->json('POST', '/api/employee', $this->data);
        
        // Inserting new data with existing email
        $this->data['email'] = $firstData->original['data']->email;
        $response = $this->actingAs($this->user, 'api')->json('POST', '/api/employee', $this->data);

        $response->assertStatus(422)
                ->assertJson([
                    "message" => 'The given data was invalid.',
                    "errors" => [
                        "email" => [
                            'Someone from the company already took this email'
                        ]
                    ]
                ]);
    }
}