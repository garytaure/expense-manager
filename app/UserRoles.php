<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserRoles extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'role_create', 'role_read', 'role_update', 'role_delete', 'user_create', 'user_read', 'user_update', 'user_delete', 'expense_category_create', 'expense_category_read', 'expense_category_update', 'expense_category_delete', 'expense_create', 'expense_read', 'expense_update', 'expense_delete',
    ];
}