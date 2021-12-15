<?php

namespace App\Http\Controllers;

use App\Models\Type_user;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::check() === true) {
            $user = User::all();
            return view('user.index', compact('user'));
        }

        return redirect()->back()->withInput()->withErrors(['Acesso negado']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $type_users = Type_user::all();
        return view('user.create', compact('type_users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(['login' => 'required', 'email' => 'required', 'password' => 'required', 'id_type_user' => 'required']);
        $user = [
            'login' => $request->login,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'id_type_user' => $request->id_type_user,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];
        User::create($user);

        return redirect()->route('user.index')->with('message', "Usuário adicionado com sucesso!");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $type_users = Type_user::all();

        return view('user.create', compact('user', 'type_users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate(['login' => 'required', 'email' => 'required', 'password' => 'required', 'id_type_user' => 'required']);
        $user = [
            'login' => $request->login,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'id_type_user' => $request->id_type_user,

            'updated_at' => date('Y-m-d H:i:s'),
        ];

        User::where(['id' => $id])->update($user);
        return redirect()->route('user.index')->with('message', 'Usuário atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect()->route('user.index')->with('error','Usuário deletado com sucesso!');
    }
}
