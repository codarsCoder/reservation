<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ApiUserController extends Controller
{


    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 401, 'message' => $validator->errors()->first()]);
        }

        // Kullanıcıyı e-posta adresine göre bul
        $user = User::where('email', $request->email)->first();

        // Kullanıcıyı doğrulamak için Auth  kullan
        if (!$user) {
            return response()->json(['status' => 401, 'message' => 'Invalid email or password']);
        }

        // Oturum açma başarılıysa, bir token oluştur ve döndür
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $token = $user->createToken('Login')->accessToken;
            return response()->json(['token' => $token, 'status' => 200]);
        }

    }

    public function register(Request $request)
    {
        // Gelen isteği doğrulama
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users,email',
            'password' => 'required|string|min:8',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 422, 'errors' => $validator->errors()]);
        }

        // Kullanıcı oluştur
        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);

        // Kullanıcının oturumunu aç
        Auth::login($user);

        // Kullanıcının erişim anahtarını oluştur ve dön
        $token = $user->createToken('Login')->accessToken;
        return response()->json(['token' => $token, 'status' => 200]);
    }

  

}
