<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $data = $request->json()->all();

        if (empty($data['email']) || empty($data['password'])) {
            return response()->json(['message' => 'Email and password are required.'], 400);
        }

        if (Auth::attempt([
            'email' => $data['email'],
            'password' => $data['password']
        ])) {
            $request->session()->regenerate();

            return response()->json(['message' => 'Login successful!']);
        }

        return response()->json(['message' => 'Invalid credentials.'], 401);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
