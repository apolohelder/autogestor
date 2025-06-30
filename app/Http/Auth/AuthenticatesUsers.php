<?php

namespace App\Http\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

trait AuthenticatesUsers
{
    public function username(){
        return 'username';
    }

    public function login(Request $request){

        // Pega as credenciais fornecidas
        $credentials = $request->only('username', 'password');

        // Determina se o campo fornecido é um e-mail ou um nome
        $fieldType = filter_var($request->username, FILTER_VALIDATE_EMAIL) ? 'email' : 'name';

        // Tenta autenticar o usuário usando o campo correto
        if (Auth::attempt([$fieldType => $credentials['username'], 'password' => $credentials['password']])) {
            return redirect()->intended('dashboard');
        }
        
        return back()->withErrors([
            'username' => 'Não conseguimos verificar as credenciais fornecidas.',
        ]);
    }
}
