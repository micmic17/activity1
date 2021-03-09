<?php

namespace Tests\Feature\Company;

use App\Models\User;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class UpdateCompanyTest extends TestCase
{
    use WithFaker;

    private $name;
    private $email;
    private $website;
    private $logo;
    private $user;
    private $id;
    private $data;

    protected function setUp(): void
    {
        parent::setUp();
        Artisan::call('storage:link');

        $this->user = User::whereEmail('admin@admin.com')->first();
        $this->file = UploadedFile::fake()->image('avatar.jpg', 100, 100);
        $this->data = [
            'name' => $this->faker->company,
            'email' => $this->faker->companyEmail,
            'logo' => $this->file
        ];

        $company = $this->actingAs($this->user, 'api')->json('POST', '/api/company', $this->data);
        $this->id = $company->original['data']->id;
    }

    /**
     * @test
     */
    public function login_user_can_update_company()
    {
        $response = $this->actingAs($this->user, 'api')->json('PATCH', '/api/company/' . $this->id, [
            'name' => $this->faker->company,
            'email' => $this->faker->companyEmail,
            'logo' => UploadedFile::fake()->image('avatar.jpg', 100, 100)
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
        $this->data['name'] = $this->data['email'] = null;
        
        $response = $this->actingAs($this->user, 'api')->json('PATCH', '/api/company/' . $this->id, $this->data);

        $response->assertStatus(422)
                ->assertJson([
                    "message" => 'The given data was invalid.',
                    "errors" => [
                        "name" => [
                            'The name field is required.'
                        ],
                        "email" => [
                            'The email field is required.'
                        ]
                    ]
                ]);
    }

    /**
     * @test
     */
    public function name_should_be_required()
    {
        $this->data['name'] = null;
    
        $response = $this->actingAs($this->user, 'api')->json('PATCH', '/api/company/' . $this->id, $this->data);

        $response->assertStatus(422)
                ->assertJson([
                    "message" => 'The given data was invalid.',
                    "errors" => [
                        "name" => [
                            'The name field is required.'
                        ]
                    ]
                ]);
    }

    /**
     * @test
     */
    public function email_should_be_required()
    {
        $this->data['email'] = null;
    
        $response = $this->actingAs($this->user, 'api')->json('PATCH', '/api/company/' . $this->id, $this->data);

        $response->assertStatus(422)
                ->assertJson([
                    "message" => 'The given data was invalid.',
                    "errors" => [
                        "email" => [
                            'The email field is required.'
                        ]
                    ]
                ]);
    }

    /**
     * @test
     */
    public function logo_dimension_should_be_atleast_100_by_100()
    {
        $this->data['logo'] = UploadedFile::fake()->image('avatar.jpg', 59, 59)->size(100);
    
        $response = $this->actingAs($this->user, 'api')->json('PATCH', '/api/company/' . $this->id, $this->data);

        $response->assertStatus(422)
                ->assertJson([
                    "message" => 'The given data was invalid.',
                    "errors" => [            
                        "logo" => [
                            'Min dimension is 100x100!',
                        ]
                    ]
                ]);
    }

    /**
     * @test
     */
    public function company_does_not_exist()
    {
        $response = $this->actingAs($this->user, 'api')->json('PATCH', '/api/company/100', $this->data);

        $response->assertStatus(404)
                ->assertJson([
                    "response" => "Update Failed",
                    "message" => [
                        "Company not found!"
                    ]
                ]);
    }
}