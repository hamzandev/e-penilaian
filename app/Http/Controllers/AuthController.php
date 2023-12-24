<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    function index(): View
    {
        return view('auth.form');
    }

    function process(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required|min:8'
        ]);

        $loggedin = Auth::attempt($request->except('_token'));
        if (!$loggedin) {
            return redirect(route('login.form'))
                ->with('error', 'Email atau Password kamu salah!');
        }
        return redirect(route('dashboard'));
    }
}
