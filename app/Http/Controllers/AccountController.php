<?php

namespace App\Http\Controllers;

use App\Account;
use \Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

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
        $request->validate([
            'social_reason' => 'required|string|max:255',
            'fantasy_name'  => 'required|string|max:255',
            'amount'        => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/',
        ]);
        
        Account::create([
            'user_id' => Auth::user()->id,
            'social_reason' => $request->social_reason,
            'fantasy_name' => $request->fantasy_name,
            'cpf_cnpj' => Auth::user()->cpf_cnpj,
            'agency' => 1,
            'amount' => floatval($request->amount),
            'number' => intval(Carbon::now()->format('Y').Auth::user()->id),
            'type_account' => strlen(Auth::user()->cpf_cnpj) <= 14 ? 'person' : 'company',
        ]);

        return redirect('profile')->with('sucess', 'Conta criada!');
    }
}
