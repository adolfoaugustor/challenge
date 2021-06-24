<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Account;
use Auth;
use Hash;

class AccountController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function register()
    {
        return view('admin.account');
    }

    public function storeAccount(Request $request)
    {
        // 'user_id',
        // 'social_reason',
        // 'fantasy_name',
        // 'agency',
        // 'number',
        // 'digit',
        // 'type_account',]
        dd($request->request);
        
        $request->validate([
            'user_id' => 'required|string|max:255',
            'social_reason' => 'required|string|email|max:255|unique:users',
            'fantasy_name' => 'required|formato_cpf_cnpj|unique:users',

            'agency' => 'required|string|min:8|confirmed',
            'number' => 'required',
            'digit' => 'required',
            'type_account' => 'required',
        ]);

        // Account::create([
        //     'user_id' => $request->name,
        //     'social_reason' => $request->email,
        //     'fantasy_name' => $request->surname,
        //     'agency' => $request->cpf_cnpj,
        //     'number' => $request->cellphone,
        //     'digit' => $request->cellphone,
        //     'type_account' => ,
        // ]);

        return redirect('profile');
    }

    public function login()
    {
        return view('auth.login');
    }

    public function authenticate(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->intended('home');
        }

        return redirect('login')->with('error', 'Oppes! You have entered invalid credentials');
    }

    public function logout() {
        Auth::logout();

        return redirect('login');
    }

    public function home()
    {
        return view('home');
    }
}
