<?php
 
namespace App\Http\Controllers\Auth;
 
use App\Http\Controllers\Controller;
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
        
       
        if (auth()->attempt(array('email' => $input['email'], 'password' => $input['password'], 'status' => 'aktif'))) {
            $user = auth()->user();
        
            if ($user->role == 'admin') {
                return redirect()->route('admin.home');
            } elseif ($user->role == 'guru') {
                return redirect()->route('guru.home');
            } elseif ($user->role == 'staff') {
                return redirect()->route('staff.home');
            }
        }
    
        // If authentication fails or the user type is not recognized
        return redirect()->route('login')->with('error', 'Email-Address And Password Are Wrong.');
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        return redirect()->route('login'); // Redirect to login page after logout
    }
}    