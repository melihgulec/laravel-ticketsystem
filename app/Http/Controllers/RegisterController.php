<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class RegisterController extends Controller
{
    public function create(){
        return view('register.create');
    }

    public function store(){
        $attributes = request()->validate([
            'name' => [
                'required',
                'min:3',
                'max:255'
            ],
            'username' => [
                'required',
                'min:3',
                'max:255',
                Rule::unique("users", "username")
            ],
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique("users", "email")
            ],
            'password' => [
                'required',
                'min:7',
                'max:255'
            ],
        ]);

        User::create($attributes);

        return redirect('/')->with('dialogMessage', 'Your account has been created.');
    }
}
