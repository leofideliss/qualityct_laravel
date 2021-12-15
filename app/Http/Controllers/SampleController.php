<?php

namespace App\Http\Controllers;

use App\Models\Clients;

use App\Models\Products;
use App\Models\Sample;

use Illuminate\Http\Request;


class SampleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $samples = Sample::paginate(5);
        return view('sample.index', compact('samples'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Products::all();
        $clients = Clients::all();
        return view('sample.create', compact('products', 'clients'));
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
            'op_number' => 'required',
            'measure' => 'required',
            'date_col' => 'required',
            //'obs'=>'required',
            'id_client' => 'required',
            'id_product' => 'required',
        ]);

        $sample = [
            'op_number' => $request->op_number,
            'measure' => $request->measure,
            'date_col' => $request->date_col,
            'obs' => $request->obs,
            'id_client' => $request->id_client,
            'id_product' => $request->id_product,
            'status' => 'nao definido'
        ];

        if (Sample::create($sample))
            return redirect()->route('sample.index')->with('message', 'Amostra adicionada com sucesso!');
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
        $products = Products::all();
        $clients = Clients::all();
        $sample = Sample::where('op_number', '=', $id)->first();
        return view('sample.create', compact('products', 'clients', 'sample'));
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
        // $request->validate(['op_number'=>'required',
        // 'measure'=>'required',
        // 'date_col'=>'required',
        // 'obs'=>'required',
        // 'id_client'=>'required',
        // 'id_product'=>'required',
        // ]);

        $sample = [
            'op_number' => $request->op_number,
            'measure' => $request->measure,
            'date_col' => $request->date_col,
            'obs' => $request->obs,
            'id_client' => $request->id_client,
            'id_product' => $request->id_product,

        ];

        Sample::where('op_number', '=', $id)->update($sample);

        return redirect()->route('sample.index')->with('message', "Amostra atualizada!!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sample = Sample::where('op_number', '=', $id);
        $sample->delete();
        return redirect()->route('sample.index')->with('message', "Amostra excluida com sucesso!");
    }

    public function sampleExists($op_number)
    {
        $exist = Sample::where('op_number', '=', $op_number)->exists();
        return json_encode($exist);
    }


    public function search(Request $request)
    {
        if ($request->name === "" || $request->name === null)
            return redirect()->route('sample.index');
        else
            $samples = Sample::where('op_number', '=', $request->name)->paginate(5);

        return view('sample.index', compact('samples'));
    }
}
