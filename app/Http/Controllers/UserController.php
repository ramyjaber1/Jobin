<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // Show Register form
    public function register(){
        return view('users.register');
    }

    // create a new user
    public function store(Request $request){
        $formFields = $request->validate([
            'name' => ['required', 'min:3'],
            'email' => ['required', 'email',Rule::unique('users','email')],
            'password' => ['required','confirmed','min:6'],
        ]);

        // Hash Password 
        $formFields['password'] = bcrypt($formFields['password']);

        // Create User
        $user = User::create($formFields);

        // Login
        auth()->login($user);
        return redirect('/')->with('message','User created and logged in');
    }

    // Logout
    public function logout(Request $request){
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('message','You have been logged out');
    }

    // Show Login
    public function login(){
        return view('users.login');
    }
    // Login user
    public function authenticate(Request $request){
        $formFields = $request->validate([
            'email' => ['required'],
            'password' => ['required',],
        ]);

        if(auth()->attempt($formFields)){
            $request->session()->regenerate();
            return redirect('/')->with('message','You are loggedIn!');
        }
        return back()->withErrors(['email' =>'Invalid Credentials'])->onlyInput('email');
    }
}
