<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        $data = $request->json()->all();

        // Минимальная проверка — если всё ок на клиенте
        if (
            empty($data['name']) ||
            empty($data['surname']) ||
            empty($data['email']) ||
            empty($data['password'])
        ) {
            return response()->json(['message' => 'All fields are required.'], 400);
        }

        // Проверка: email уже есть?
        if (User::where('email', $data['email'])->exists()) {
            return response()->json(['message' => 'User already exists.'], 409);
        }

        // Сохраняем
        User::create([
            'name' => $data['name'],
            'surname' => $data['surname'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => 'user'
        ]);

        return response()->json(['message' => 'Registration successful!']);
    }





    public function registerAdmin(Request $request)
    {
        $data = $request->json()->all();

        if (
            empty($data['name']) ||
            empty($data['surname']) ||
            empty($data['email']) ||
            empty($data['password'])
        ) {
            return response()->json(['message' => 'All fields are required.'], 400);
        }

        if (User::where('email', $data['email'])->exists()) {
            return response()->json(['message' => 'Admin already exists.'], 409);
        }

        User::create([
            'name' => $data['name'],
            'surname' => $data['surname'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => 'admin'
        ]);

        return response()->json(['message' => 'Admin registration successful!']);
    }

}