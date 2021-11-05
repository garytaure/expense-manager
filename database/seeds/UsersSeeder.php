<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $token = Str::random(60);
        DB::table('users')->insert([
            'role_id' => 1,
            'name' => 'Admin User',
            'email' => 'admin@domain.com',
            'password' => Hash::make('password'),
            'api_token' => hash('sha256', $token)
        ]);
    }
}