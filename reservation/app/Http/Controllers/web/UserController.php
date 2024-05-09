<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function register(Request $request)
    {
        if ($request->isMethod('post')) {
            // Giriş verilerini doğrula
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8',
            ]);

            // Doğrulama başarısızsa hata mesajlarını gönder
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            // Kullanıcı kayıt verilerini alın
            $data = $request->all();



            // Kullanıcıyı veritabanına kaydet
            $user = User::create($data);

            // Kullanıcı kayıt işlemi tamamlandıktan sonra giriş yapabilir
            Auth::login($user);

            return response()->json(['status' => 200]);
        }

        return view('home');
    }


    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // E-posta adresine ait kullanıcıyı alalım
        $user = User::where('email', $credentials['email'])->first();

        if (!$user) {
            return redirect()->back()->withErrors(['message' => 'You entered an incorrect email or password!'])->withInput();
        }

        if (Auth::attempt($credentials)) {
            return redirect()->route('home');
        } else {
            return redirect()->back()->withErrors(['message' => 'You entered an incorrect email or password!'])->withInput();
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
