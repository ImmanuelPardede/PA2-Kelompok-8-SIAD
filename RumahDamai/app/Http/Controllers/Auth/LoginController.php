<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Illuminate\Http\Request;

class LoginController extends Controller
{

    use AuthenticatesUsers;

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        $input = $request->all();
    
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);
    
        $credentials = [
            'email' => $input['email'],
            'password' => $input['password'],
        ];
    
        // Mencoba melakukan otentikasi pengguna
        if (auth()->attempt(array_merge($credentials, ['status' => 'aktif']))) {
            $user = auth()->user();
    
            // Memeriksa peran pengguna yang masuk
            if ($user->role == 'admin' || $user->role == 'guru' || $user->role == 'staff' || $user->role == 'direktur') {
                return redirect()->route('dashboard');
            }
        } else {
            // Pengecekan jika akun tidak aktif
            $user = User::where('email', $input['email'])->first();
            if ($user && $user->status !== 'aktif') {
                return back()->withErrors(['email' => 'Akun Anda sudah dinonaktifkan.']);
            }
        }
    
        // Jika auth()->attempt mengembalikan false, tandai bahwa ada kesalahan
        return back()->withErrors(['email' => 'Email atau password salah.']);
    }
    


    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        return redirect()->route('login'); // Redirect to login page after logout
    }
}
