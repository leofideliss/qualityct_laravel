<?php

namespace App\Http\Controllers;

use App\Models\State;

use Illuminate\Http\Request;

class StateController extends Controller
{

    private $objState;

    public function __construct()
    {
        $this->objState = new State();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $state =State::paginate(5);
        return view('state.index',compact('state'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('state.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        State::create($request->all());

        return redirect()->route('state.index')->with('success', 'Estado criado com sucesso');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\State  $state
     * @return \Illuminate\Http\Response
     */
    public function show(State $state)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\State  $state
     * @return \Illuminate\Http\Response
     */
    public function edit(State $state)
    {
        $state = $this->objState->find($state->id);
        return view('state.create',compact('state'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\State  $state
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, State $state)
    {
        State::where(['id'=> $state->id])->update(['name'=>$request->name]);
        return redirect()->route('state.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\State  $state
     * @return \Illuminate\Http\Response
     */
    public function destroy(State $state)
    {

        State::destroy($state->id);
        return redirect()->route('state.index');

    }
}
