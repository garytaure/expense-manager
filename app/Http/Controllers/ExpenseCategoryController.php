<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\ExpenseCategories;
use App\Expenses;
use App\Http\Resources\ExpenseCategories as ExpenseCategoryResource;
use App\Http\Resources\ExpenseCategoriesCollection;

use Illuminate\Support\Facades\Auth;

class ExpenseCategoryController extends Controller
{
    public function index()
    {
        if (!Auth::user()->allowed('expense_category_read')) {
            return response()->json(['message' => 'You have no permission to perform this task.'], 403);
        }
        return new ExpenseCategoriesCollection(ExpenseCategories::orderBy('name')->get());
    }

    public function show($id)
    {
        if (!Auth::user()->allowed('expense_category_read')) {
            return response()->json(['message' => 'You have no permission to perform this task.'], 403);
        }
        return new ExpenseCategoryResource(ExpenseCategories::findOrFail($id));
    }

    public function store(Request $request)
    {
        if (!Auth::user()->allowed('expense_category_create')) {
            return response()->json(['message' => 'You have no permission to perform this task.'], 403);
        }
        $request->validate([
            'name' => 'required|max:50',
        ]);
        if (ExpenseCategories::where('name', $request->name)->exists()) {
            return response()->json(['message' => 'Expense Category with the same name already exists.'], 403);
        }
        $expenseCategory = ExpenseCategories::create($request->all());

        return (new ExpenseCategoryResource($expenseCategory))
            ->response()
            ->setStatusCode(200);
    }

    public function update(Request $request)
    {
        if (!Auth::user()->allowed('expense_category_update')) {
            return response()->json(['message' => 'You have no permission to perform this task.'], 403);
        }
        $expenseCategory = ExpenseCategories::findOrFail($request->id);
        $request->validate([
            'name' => 'required|max:50'
        ]);
        if (ExpenseCategories::where('id', '<>', $expenseCategory->id)->where('name', $request->name)->exists()) {
            return response()->json(['message' => 'Expense Category with the same name already exists.'], 403);
        }
        $expenseCategory->name = $request->name;
        $expenseCategory->save();

        return (new ExpenseCategoryResource($expenseCategory))
            ->response()
            ->setStatusCode(200);
    }

    public function delete($id)
    {
        if (!Auth::user()->allowed('expense_category_delete')) {
            return response()->json(['message' => 'You have no permission to perform this task.'], 403);
        }
        $expenseCategory = ExpenseCategories::findOrFail($id);
        if (Expenses::where('expense_category_id', $id)->exists()) {
            return response()->json(['message' => 'Could not delete this cateory, it is currently used in expenses.'], 403);
        }
        $expenseCategory->delete();

        return response()->json(['message' => 'Expense Category deleted.'], 200);
    }
}