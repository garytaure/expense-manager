<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

use App\User;
use App\UserRoles;
use App\Expenses;
use App\ExpenseCategories;
use Exception;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $usersTotal = 0;
        try {
            $usersTotal = User::all()->count();
        } catch (Exception $e) {
        }
        $userRolesTotal = 0;
        try {
            $userRolesTotal = UserRoles::all()->count();
        } catch (Exception $e) {
        }
        $expensesTotal = 0;
        try {
            $expensesTotal = Expenses::all()->count();
        } catch (Exception $e) {
        }
        $expenseCategoriesTotal = 0;
        try {
            $expenseCategoriesTotal = ExpenseCategories::all()->count();
        } catch (Exception $e) {
        }
        return response()->json(["data" => ["usersTotal" => $usersTotal, "userRolesTotal" => $userRolesTotal, "expensesTotal" => $expensesTotal, "expenseCategoriesTotal" => $expenseCategoriesTotal]], 200);
    }
}