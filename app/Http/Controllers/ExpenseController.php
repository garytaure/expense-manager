<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Expenses;
use App\Http\Resources\Expenses as ExpenseResource;
use App\Http\Resources\ExpensesCollection;

use Illuminate\Support\Facades\Auth;

class ExpenseController extends Controller
{
    public function index()
    {
        if (!Auth::user()->allowed('expense_read')) {
            return response()->json(['message' => 'You have no permission to perform this task.'], 403);
        }
        return new ExpensesCollection(Expenses::all());
    }

    public function show($id)
    {
        if (!Auth::user()->allowed('expense_read')) {
            return response()->json(['message' => 'You have no permission to perform this task.'], 403);
        }
        return new ExpenseResource(Expenses::findOrFail($id));
    }

    public function store(Request $request)
    {
        if (!Auth::user()->allowed('expense_create')) {
            return response()->json(['message' => 'You have no permission to perform this task.'], 403);
        }
        $request->validate([
            'expense_category_id' => 'required|integer',
            'name' => 'required|max:255',
            'entry_date' => 'required|date',
            'amount' => 'required|numeric'
        ]);
        $expense = Expenses::create($request->all());

        return (new ExpenseResource($expense))
            ->response()
            ->setStatusCode(200);
    }

    public function update(Request $request)
    {
        if (!Auth::user()->allowed('expense_update')) {
            return response()->json(['message' => 'You have no permission to perform this task.'], 403);
        }
        $request->validate([
            'name' => 'required|max:50',
            'entry_date' => 'required|date',
            'amount' => 'required|numeric'
        ]);
        $expense = Expenses::findOrFail($request->id);
        $expense->name = $request->name;
        $expense->entry_date = $request->entry_date;
        $expense->amount = $request->amount;
        $expense->save();

        return (new ExpenseResource($expense))
            ->response()
            ->setStatusCode(200);
    }

    public function delete($id)
    {
        if (!Auth::user()->allowed('expense_delete')) {
            return response()->json(['message' => 'You have no permission to perform this task.'], 403);
        }
        $expense = Expenses::findOrFail($id);
        $expense->delete();

        return response()->json(['message' => 'Expense entry deleted.'], 200);
    }
}