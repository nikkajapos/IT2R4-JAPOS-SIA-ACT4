<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends BaseController {
    
    public function index() {
        return response()->json(User::all(), 200);
    }

    public function store(Request $request) {
        try {
            $this->validate($request, [
                'name' => 'required|string|max:255',
                'username' => 'required|string|max:255|unique:users',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:6',
                'gender' => 'required|string|in:Male,Female,Other'
            ]);

            // Create a new user
            $user = User::create([
                'name' => $request->name,
                'username' => $request->username,
                'email' => $request->email,
                'password' => Hash::make($request->password), // Fixed bcrypt error
                'gender' => $request->gender
            ]);

            return response()->json([
                'message' => 'User created successfully!',
                'user' => $user
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'User registration failed!',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
