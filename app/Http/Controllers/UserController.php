<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller {
    public function store (Request $request) {
        try {
            User::create([
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'name' => $request->name
            ]);

            return response()->json([
                'Message' => 'user created with success '
            ]);
        } catch (Exception $err) {
            return response()->json([
                'Error' => 'error to create a new user'
            ]);
        }
    }
}
