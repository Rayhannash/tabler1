<?php

namespace App\Http\Controllers;

use App\Helpers\AccessHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\User;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'user_prefix' => 'required|string',
            'password' => 'required|string|min:4'
        ]);

        $userPrefix = $request->user_prefix;
        $fieldType = filter_var($userPrefix, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        $credentials = [
            $fieldType => $userPrefix,
            'password' => $request->password
        ];

        if (Auth::attempt($credentials)) return redirect()->intended(route('home'));

        return back()
            ->withErrors(['user_prefix' => 'Email atau Password anda tidak tepat'])
            ->withInput();
    }


    public function register(Request $request)
    {
        $request->validate([
            'fullname' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    
        // Membuat pengguna baru
        User::create([
            'fullname' => $request->fullname,
            'username' => $request->username,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role_id' => 2,
            'is_active' => true,
        ]);
    
        return redirect()->route('login')->with('success', 'Registrasi berhasil. Silakan login.');
    }

    public function logout()
    {
        try {
            AccessHelper::clearAccessSession();
            Auth::logout();

            return response()->json([
                'status' => 'success',
                'message' => 'Anda berhasil logut dari sistem.'
            ], 200);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan saat logout dari sistem.'
            ], 500);
        }
    }
}
