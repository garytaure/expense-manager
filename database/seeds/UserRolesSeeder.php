<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_roles')->insert([
            'name' => 'Administrator',
            'role_create' => true,
            'role_read' => true,
            'role_update' => true,
            'role_delete' => true,
            'user_create' => true,
            'user_read' => true,
            'user_update' => true,
            'user_delete' => true,
            'expense_category_create' => true,
            'expense_category_read' => true,
            'expense_category_update' => true,
            'expense_category_delete' => true,
            'expense_create' => true,
            'expense_read' => true,
            'expense_update' => true,
            'expense_delete' => true,
        ]);
    }
}