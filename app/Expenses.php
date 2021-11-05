<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Expenses extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'expense_category_id', 'name', 'entry_date', 'amount'
    ];
}