<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $customer = Role::create([
            'name' => 'customer',
            'display_name' => 'Customer', // optional
            'description' => 'User is the customer of a given project', // optional
        ]);

        $admin = Role::create([
            'name' => 'admin',
            'display_name' => 'User Administrator', // optional
            'description' => 'User is allowed to manage and edit other users', // optional
        ]);

        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'phone' => '085693296980',
            'email_verified_at' => now(),
            'password' => Hash::make('123456789'), // password
            'remember_token' => Str::random(10),
        ])->attachRole('admin');
        User::create([
            'name' => 'Admin2',
            'email' => 'admin2@gmail.com',
            'phone' => '085693296980',
            'email_verified_at' => now(),
            'password' => Hash::make('123456789'), // password
            'remember_token' => Str::random(10),
        ])->attachRole('admin');
    }
}
