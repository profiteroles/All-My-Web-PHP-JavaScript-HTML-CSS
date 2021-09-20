<?php

namespace App\Http\Controllers;


use Illuminate\Validation\ValidationException;

class SessionController extends Controller
{
    public function destroy(){
        auth()->logout();

        return redirect('/')->with('success', 'Your session Ended!');
    }

    public function create(){
        return view('sessions.create');
    }
    public function store(){
        $attributes = request()->validate([
            'email'=> 'required|email',
            'password'=>'required'
        ]);
        if (! auth()->attempt($attributes)){
            throw ValidationException::withMessages([
                'email','Email couldn\'t be found'
            ]);
        }

        session()->regenerate();

        return redirect('/')->with('success', 'You are successfully logged in');
//        else{
//            return back()
//                ->withInput()
//                ->withErrors(['email', 'Email couldn\'t be found']);
//        }
    }
}
