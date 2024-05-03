<?php
namespace App\Http\Controllers;

use \App\Models\User;

use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    public function show()
    {
        $users = User::all();
        return response()->json($users);
    }


    public function detail($id)
    {
        $users = User::find($id);
        return response()->json($users);
    }


    public function delete($id)
    {
        // Find the user by ID
        $user = User::find($id);

        // Check if the user exists
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        // Delete the user
        $user->delete();

        return response()->json(['message' => 'User deleted successfully'], 200);
    }



}
