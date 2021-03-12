<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoginControllerTest extends TestCase
{
    private function getCorrectEmail()
    {
        return TestCase::getCorrectEmailAttribute();
    }

    private function getFakeEmail()
    {
        return TestCase::getFakeEmailAttribute();
    }

    private function getCorrectPassword()
    {
        return TestCase::getCorrectPasswordAttribute();
    }

    private function getFakePassword()
    {
        return TestCase::getFakePasswordAttribute();
    }

    /**
     * @test
     */
    public function login_displays_the_login_form()
    {
        $response = $this->get(route('login'));

        $response->assertStatus(200);
        $response->assertViewIs('auth.login');
    }

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
            'email' => $this->getFakeEmail(),
            'password' => $this->getCorrectPassword(),
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
            'email' => $this->getCorrectEmail(),
            'password' => $this->getFakePassword(),
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
            'email' => $this->getCorrectEmail(),
            'password' => $this->getCorrectPassword(),
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