<?php

namespace Tests\Feature\Employee;

use App\Models\User;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class UpdateEmployeeTest extends TestCase
{
    use WithFaker;

    private $user;
    private $data;
    private $dataToUpdate;

    protected function setUp(): void
    {
        parent::setUp();
        Artisan::call('storage:link');

        $this->user = User::whereEmail('admin@admin.com')->first();
        $company = $this->actingAs($this->user, 'api')->json('POST', '/api/company', [
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

        $this->dataToUpdate = $this->json('POST', '/api/employee', $this->data);
    }

    /**
     * @test
     */
    public function login_user_can_update_employee()
    {
        $this->withOutExceptionHandling();
        $response = $this->json('PATCH', '/api/employee/' . $this->data['company_id'], [
            'first_name' => $this->faker->firstNameMale,
            'last_name' => $this->faker->lastName,
            'email' => $this->faker->companyEmail,
            'phone' => $this->faker->phoneNumber,
        ]);

        $response->assertStatus(200)
                ->assertJsonStructure([
                    "data",
                    "message"
                ]);
    }

    /**
     * @test
     */
    public function name_and_email_should_be_required()
    {
        $response = $this->json('PATCH', '/api/employee/' . $this->data['company_id'], [
            'first_name' => null,
            'last_name' => null,
            'email' => $this->faker->companyEmail,
            'phone' => $this->faker->phoneNumber,
        ]);

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

    /** @test */
    public function email_should_be_unique()
    {
        // Creating new data
        $firstData = $this->json('POST', '/api/employee', [
            'first_name' => $this->faker->firstNameMale,
            'last_name' => $this->faker->lastName,
            'email' => $this->faker->companyEmail,
            'phone' => $this->faker->phoneNumber,
            'company_id' => $this->data['company_id'],
        ]);
        
        // Inserting new data with existing email
        $this->data['email'] = $firstData->original['data']->email;
        $response = $this->json('PATCH', '/api/employee/' . $firstData->original['data']->id , $this->data);

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

    /**
     * @test
     */
    public function employee_does_not_exist()
    {
        $response = $this->json('PATCH', '/api/employee/300', [
            'first_name' => $this->faker->firstNameMale,
            'last_name' => $this->faker->lastName,
            'email' => $this->faker->companyEmail,
            'phone' => $this->faker->phoneNumber,
        ]);

        $response->assertStatus(404)
                ->assertJson([
                    "response" => "Update Failed",
                    "message" => [
                        "Employee not found!"
                    ]
                ]);
    }
}