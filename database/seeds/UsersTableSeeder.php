<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = factory(User::class)->create([
            'name'  => 'John',
            'email' => 'manager@mail.com',
        ]);

        $user->attachRole(\App\Models\Role::where('name', User::ROLE_MANAGER)->first());

        $user = factory(User::class)->create([
            'name'  => 'User',
            'email' => 'test@mail.com',
        ]);

        $user->attachRole(\App\Models\Role::where('name', User::ROLE_USER)->first());
    }
}
