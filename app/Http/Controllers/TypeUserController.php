<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Type_user;
class TypeUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $type_user = Type_user::all();
        return view('type_user.index',compact('type_user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('type_user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(['name'=>'required']);

        Type_user::create($request->all());

        return redirect()->route('type_user.index')->with('message',"Tipo de usuário adicionado com sucesso!");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       $type_user =  Type_user::find($id);
        return view('type_user.create',compact('type_user'));
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
        $request->validate(['name'=>'required']);

        Type_user::where(['id'=>$id])->update(['name'=> $request->name]);
        return redirect()->route('type_user.index')->with('message',"Usuário alterado com sucesso!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $type =  Type_user::find($id);
        $type->delete();
        return redirect()->route('type_user.index')->with('error',"Tipo de usuário excluido com sucesso!");
    }
}
