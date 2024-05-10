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
        if (!$user || !Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return response()->json(['status' => 401, 'message' => 'Invalid email or password']);
        }

        // Oturum açma başarılıysa, bir token oluştur ve döndür
        $token = $user->createToken('Login')->accessToken;
        return response()->json(['token' => $token, 'status' => 200]);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
