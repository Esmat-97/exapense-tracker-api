<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;


class AuthController extends Controller
{
    //

    public function register(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'name' => 'required',
            'email' => 'required|string|email|unique:users,email',
            'password' => 'required',
        ]);

        // Create and save the new user
        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $user->save();

        // Return a response indicating success
        return response()->json(['message' => 'User registered successfully'], 201);
    }

    /**
     * Authenticate a user and generate a token.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        // Attempt to authenticate the user
        if (Auth::attempt($request->only('email', 'password'))) {
            // Authentication successful, generate a token
            $user = Auth::user();
            $token = $user->createToken('authToken')->plainTextToken;

            // Return the token as a response
            return response()->json(['token' => $token , 'user' => $user], 200);
        }

        // Authentication failed, return an error response
        return response()->json(['message' => 'Unauthorized'], 401);
    }

    /**
     * Logout the authenticated user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */



     public function logout(Request $request)
     {
         if (auth()->check()) {
             // Perform logout logic here
             $request->user()->tokens()->delete();
                // Logout the user
             return response()->json(['message' => 'Logged out successfully'], 200);
         } else {
             return response()->json(['message' => 'Unauthorized'], 401);
         }
     }
}
