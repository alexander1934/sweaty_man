<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class RegisterController extends Controller
{
    public function create() {
        return view('authorization');
    }

    public function store(Request $request) {

        $request->validate([
            'loginReg' => 'required|string',
            'emailReg' =>  'required|string|unique:users,email,id_to_ignore',
            'passwordReg' => 'required|string|min:8'
        ]);

        $user = User::create([
            'name' => $request->loginReg,
            'email' => $request->emailReg,
            'password' => Hash::make($request->passwordReg)
        ]);

        Auth::login($user);

        return redirect('/userAccount');
    }
}
