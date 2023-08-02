<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Models\User;

class ApiKeyController extends Controller
{
    public function generate(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->api_token = Str::random(40); // generates a random 40-character string for the API key
        $user->save();

        return response()->json([
            'user' => $user,
            'api_token' => $user->api_key
        ], 201);
    }
}
