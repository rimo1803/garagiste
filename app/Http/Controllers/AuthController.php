<?php


namespace App\Http\Controllers;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;


class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }
    public function showRegistrationForm(){
        return view('auth.register');
    }
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            if ($user->role === 'Administrateur') {
                return redirect('home');
            } else {
                Auth::logout();
                return back()->withErrors([
                    'email' => 'Vous n\'avez pas les autorisations nécessaires pour accéder à cette page.',
                ]);
            }
        }

        return back()->withErrors([
            'email' => 'Les informations d\'identification fournies ne sont pas valides.',
        ]);
    }

    public function logout()
    {
        Auth::logout();
        return redirect('login');
    }
    public function register(Request $request)
{
    $request->validate([
        'firstname' => 'required|string|max:255',
        'lastname' => 'required|string|max:255',
        'username' => 'required|string|max:255|unique:users',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:8|confirmed',
        'address' => 'required|string|max:255',
        'phone' => 'required|string|max:20',
    ]);


    $user = User::create([
        'firstname' => $request->firstname,
        'lastname' => $request->lastname,
        'username' => $request->username,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'role' => 'Client',
        'address' => $request->address,
        'phone' => $request->phone,
    ]);

    Auth::login($user);

    return redirect('home');
}



}


