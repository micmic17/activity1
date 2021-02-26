<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $roles = ['admin', 'users'];

        \App\Models\Role::factory(2)->create()->each(function($role, $index) use($roles) {
            $role->name = $roles[$index];
            $role->save();
        });

        \App\Models\User::factory(1)->create()->each(function($user, $index) {
            $user->name = 'Admin User';
            $user->email = 'admin@admin.com';
            $user->role_id = 1;

            $user->save();
        });
    }
}
