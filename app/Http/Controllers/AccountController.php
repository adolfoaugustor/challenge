<?php

namespace App\Http\Controllers;

use App\Account;
use \Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Mail;

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

        Mail::send('emails.activeAccount', $this->link, function ($message)use($request){
            $message->from(Config::get('mail.from.teste'))
                    ->to(Auth::user()->email)
                    ->subject('Active Account IDEZ');
        });
        
        return redirect('profile')->with('sucess', 'Account create, verify your email for active account!');
    }

    public function activateAccount($id)
    {
        if(Auth::user()->id === $id){

            $account = Account::where('user_id', $id)->first();
            $account->status = 'accept';
            $account->save();
        }else{
            redirect('profile')->with('error', 'Você');
        }

        return redirect('profile')->with('sucess', 'Account Created!');
    }

    public function link($id)
    {
        echo url("/account/active/{$id}");
    }
}
