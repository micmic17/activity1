<?php

namespace Tests\Feature\Company;

use App\Models\User;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class ShowCompanyTest extends TestCase
{
    use WithFaker;

    private $name;
    private $email;
    private $website;
    private $logo;
    private $user;
    private $id;

    protected function setUp(): void
    {
        parent::setUp();
        Artisan::call('storage:link');

        $this->user = User::whereEmail('admin@admin.com')->first();

        $this->file = UploadedFile::fake()->image('avatar.jpg', 100, 100);
        
        $data = [
            'name' => $this->faker->company,
            'email' => $this->faker->companyEmail,
            'logo' => $this->file
        ];

        $company = $this->actingAs($this->user, 'api')->json('POST', '/api/company', $data);
        $this->id = $company->original['data']->id;
    }

    /**
     * @test
     */
    public function login_user_can_see_specific_company()
    {
        $response = $this->actingAs($this->user, 'api')->json('get', '/api/company/' . $this->id);

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
        $response = $this->actingAs($this->user, 'api')->json('GET', '/api/company/100');

        $response->assertStatus(404)
                ->assertJson([
                    "response" => "",
                    "message" => [
                        "Company not found!"
                    ]
                ]);
    }
}