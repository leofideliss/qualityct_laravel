<?php

namespace App\Http\Controllers;


use App\Models\Sample;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    protected $table = 'users';

    public function showFormLogin()
    {
        return view('login');
    }

    public function home()
    {
        if (Auth::check() === true) {
            $samples = Sample::where('status', '=', 'nao definido')->get();
            return view('home', compact('samples'));
        }


        return redirect()->route('login');
    }

    public function login(Request $request)
    {

        if (!strlen($request->login) > 0 || strlen($request->login) > 10)
            return redirect()->back()->withInput()->withErrors(['Login inválido']);

        $credentials = ['login' => $request->login, 'password' => $request->password];

        if (Auth::attempt($credentials)) {
            $current_user = Auth::user();
            if ($current_user->id_type_user == 2)
                return redirect()->route('test.historicDir');

            return redirect()->route('home');
        }



        return redirect()->back()->withInput()->withErrors(['Dados inválidos']);
    }

    public function logout()
    {
        Auth::logout();

        return redirect('home');
    }
}
