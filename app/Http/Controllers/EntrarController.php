<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EntrarController extends Controller
{
    public function index()
    {
        return view('entrar.index');
    }

    public function entrar(Request $request)
    {
        $email = $request->email;
        $password = $request->password;


        if(!Auth::attempt(['email' => $email, 'password' => $password, 'status' => 1])) {
            return redirect()->back()->withErrors(['email' => 'Usuário ou senha inválidos']);
        } 

        return view('home');
    }
}