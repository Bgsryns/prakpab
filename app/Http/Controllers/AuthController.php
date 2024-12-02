<?php

namespace App\Http\Controllers;

use App\Models\User;  
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        //
        return view('login');
    }
    public function dologin(Request $request)
    {
        // $email = $request->email;
        // $password = $request->password;
        // $user = \App\Models\User::Where('email', $email)->first();


        if (Auth::attempt($request->only('email', 'password'))) {
            if (Auth::user()->role == 'KONSUMEN') {
                return redirect(route('home.index'));
            }
            return redirect('/user');
        }
        
        return redirect('/login')->with(
            'status_messege',
            ['type' => 'danger', 'text' => 'user tidak ditemukan']
        );
    }
        public function logout()
        {
            Auth::logout();
            return redirect('/login');
        }
       
    }
