<?php

namespace Tests\Feature\Company;

use App\Models\User;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class DeleteCompanyTest extends TestCase
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
        $company = $this->actingAs($this->user, 'api')->json('POST', '/api/company', [
            'name' => $this->faker->company,
            'email' => $this->faker->companyEmail,
            'logo' => $this->file
        ]);
        $this->id = $company->original['data']->id;
    }

    /**
     * @test
     */
    public function login_user_can_delete_specific_company()
    {
        $response = $this->actingAs($this->user, 'api')->json('DELETE', '/api/company/' . $this->id);

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
        $response = $this->actingAs($this->user, 'api')->json('DELETE', '/api/company/100');

        $response->assertStatus(404)
                ->assertJson([
                    "response" => "Deleting Failed",
                    "message" => [
                        "Company not found!"
                    ]
                ]);
    }
}