<?php

namespace Tests;

use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication, RefreshDatabase, WithFaker;

    private $correctEmail;
    private $fakeEmail;
    private $correctPassword;
    private $fakePassword;

    protected function setUp(): void
    {
        parent::setUp();
        Artisan::call('passport:install');

        $this->correctEmail = 'admin@admin.com';
        $this->fakeEmail = $this->faker->safeEmail;
        $this->fakePassword = $this->faker->password(8);
        $this->correctPassword = 'password';

        $roles = ['admin', 'users'];

        $role = Role::factory(2)->create()->each(function($role, $index) use($roles) {
                    $role->name = $roles[$index];
                    $role->save();
                });

        $user = User::factory(1)->create([
            'name' => "Admin User",
            'email' => $this->correctEmail,
            'password' => bcrypt($this->correctPassword),
            'role_id' => 1,
        ]);
    }

    public function getCorrectEmailAttribute()
    {
        return $this->correctEmail;
    }

    public function getCorrectPasswordAttribute()
    {
        return $this->correctPassword;
    }

    public function getFakeEmailAttribute()
    {
        return $this->fakeEmail;
    }

    public function getFakePasswordAttribute()
    {
        return $this->fakePassword;
    }
}