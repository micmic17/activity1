<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoginControllerTest extends TestCase
{
    /**
     * @test
     */
    public function user_must_enter_email_and_password()
    {
        $this->json('POST', 'api/login')
            ->assertStatus(422)
            ->assertJson([
                "response" => "Login Failed",
                "message" => [
                    [
                        'The email field is required.',
                        'The password field is required.',
                    ]
                ]
            ]);
    }

    /**
     * @test
     */
    public function enter_non_existing_email()
    {
        $this->json('POST', 'api/login', [
            'email' => 'test@test.com',
            'password' => 'password',
        ])->assertStatus(404)
            ->assertJson([
                "response" => "Login Failed",
                "message" => ['Email not found!']
            ]);
    }

    /**
     * @test
     */
    public function enter_incorrect_password()
    {
        $this->json('POST', 'api/login', [
            'email' => 'admin@admin.com',
            'password' => 'wrongpassword',
        ])->assertStatus(422)
            ->assertJson([
                "response" => "Login Failed",
                "message" => ['Password mismatched.']
            ]);
    }

    /**
     * @test
     */
    public function user_successfully_log_in()
    {
        $this->json('POST', 'api/login', [
            'email' => 'admin@admin.com',
            'password' => 'password'
        ])->assertStatus(200)
            ->assertJsonStructure([
            "data" => [
                'token',
                'name',
            ],
            "message"
        ]);
    }
}