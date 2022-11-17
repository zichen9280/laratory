<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class SessionController extends Controller
{
    public function create(){

        return view('sessions/sign_in');
    }

    public function store(){

        $attributes = request()->validate([
           'email' => 'required|email',
           'password' => 'required'
        ]);


        if(Auth::attempt($attributes)){
            session()->regenerate();
            return redirect("product_list")->with('success', 'Welcome Back!');
        }
        else{
            return back()->withErrors(['email'=>'Invalid email or password.']);
        }

    }

    public function destroy(){
        auth()->logout();

        return redirect('sign_in')->with('success', 'Logout Successful');
    }
}
