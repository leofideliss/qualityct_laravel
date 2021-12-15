<?php

namespace App\Http\Controllers;

use App\Models\Addresses;
use Illuminate\Http\Request;
use App\Models\Cities;
use App\Models\State;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $city = Cities::all();
        $state = State::all();
        $address = Addresses::all();
        return view('address.index',compact('city','state','address'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $city = Cities::all();
        $state = State::all();
        return view('address.create',compact('city','state'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(
            ['CEP' => 'required',
            'id_state' => 'required',
            'id_city' => 'required',
            'street' => 'required',
            'number' => 'required',
            'neighborhoods' => 'required',
            'complements' => 'required',
        ]);

        Addresses::create($request->all());

        return redirect()->route('address.index');
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
        $city = Cities::all();
        $state = State::all();
        $address = Addresses::find($id);
        return view('address.create',compact('city','state','address'));
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
