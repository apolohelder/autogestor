<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Mostra o formulário de login
     *
     * @return \Illuminate\View\View
     */
    public function loginForm()
    {
        if (Auth::check()) {
            return redirect()->route('admin.index');
        }
        return view('auth.login');
    }

    /**
     * Faz o logout do usuário
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
