<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Expense;


class ExpenseController extends Controller
{
    //

    public function show()
    {
        $users = Expense::all();
        return response()->json($users);
    }

    


    public function detail($id)
    {
        $users = Expense::find($id);
        return response()->json($users);
    }



    public function delete($id)
    {
        // Find the user by ID
        $user = Expense::find($id);

        // Check if the user exists
        if (!$user) {
            return response()->json(['message' => 'Expense not found'], 404);
        }

        // Delete the user
        $user->delete();

        return response()->json(['message' => 'Expense deleted successfully'], 200);
    }
    

    

    public function select($user_id)
    {
        // Retrieve expenses associated with the specified user ID
        $expenses = Expense::where('user_id', $user_id)->get();

        // Check if any expenses were found
        if ($expenses->isEmpty()) {
            return response()->json(['message' => 'No expenses found for the user'], 404);
        }

        // Return the expenses as a JSON response
        return response()->json($expenses, 200);
    }



    public function countAmount($user_id)
{
    // Count the total amount for the specified user ID
    $totalAmount = Expense::where('user_id', $user_id)->sum('amount');

    // Return the total amount as a JSON response
    return response()->json(['total_amount' => $totalAmount], 200);
}



    
    
    public function store(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'description' => 'required',
            'amount' => 'required',
            'user_id' => 'required|exists:users,id', // Assuming there is a 'users' table with an 'id' column
        ]);

        // Create a new expense instance
        $expense = new Expense();
        $expense->description = $request->input('description');
        $expense->amount = $request->input('amount');
        $expense->user_id = $request->input('user_id');

        // Save the expense to the database
        $expense->save();

        // Return a JSON response indicating success
        return response()->json(['message' => 'Expense created successfully'], 201);
    }
}
