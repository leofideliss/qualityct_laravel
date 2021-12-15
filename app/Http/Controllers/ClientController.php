<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use App\Models\Clients;
use App\Models\Cities;
use App\Models\State;
use App\Models\Addresses;
use App\Models\Products;




class ClientController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $client = Clients::paginate(5);

        return view('client.index', compact('client'));
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
        return view('client.create', compact('state', 'city'));
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
            [
                //'id_state' => 'required',
                //  'id_city' => 'required',
                //  'street' => 'required',
                // 'number' => 'required|numeric',
                //   'neighborhoods' => 'required',
                'company_name' => 'required',
                'contact_name' => 'required',
                //   'phone' => 'required|celular',
                'CNPJ'  => 'required'
            ]
        );

        $address = [
            'CEP' => $request->CEP,
            'id_state' =>  $request->id_state,
            'id_city' =>  $request->id_city,
            'street' =>  $request->street,
            'number' =>  $request->number,
            'neighborhoods' =>  $request->neighborhoods,
            'complements' =>  $request->complements,
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
        ];

        Addresses::create($address);

        $client = [
            'company_name' => $request->company_name,
            'CNPJ' => $request->CNPJ,
            'contact_name' => $request->contact_name,
            'phone' => $request->phone,
            'email' => $request->email,
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
            'id_address' => DB::table('addresses')
                ->latest()
                ->first()->id,
        ];


        Clients::create($client);

        return redirect()->route('client.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $client = Clients::find($id);
        $products = Products::where('id_client', $id)->paginate(2);
        return view('client.info', compact('client', 'products'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $client = Clients::find($id);
        $address = Addresses::find($client->id_address);
        $city = Cities::all();
        $state = State::all();
        return view('client.create', compact('client', 'address', 'city', 'state'));
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
        $request->validate(
            [
                // 'id_state' => 'required',
                // 'id_city' => 'required',
                //   'street' => 'required',
                //  'number' => 'required|numeric',
                //   'neighborhoods' => 'required',
                'company_name' => 'required',
                'contact_name' => 'required',
                //   'phone' => 'required|celular',
                'CNPJ'  => 'required'
            ]
        );

        Clients::where(['id' => $id])->update([
            'company_name' => $request->company_name,
            'CNPJ' => $request->CNPJ,
            'contact_name' => $request->contact_name,
            'phone' => $request->phone,
            'email' => $request->email,
            'updated_at' => date("Y-m-d H:i:s"),
        ]);
        $client_result = Clients::find($id);
        Addresses::where(['id' => $client_result->id_address])->update([
            'CEP' => $request->CEP,
            'id_state' =>  $request->id_state,
            'id_city' =>  $request->id_city,
            'street' =>  $request->street,
            'number' =>  $request->number,
            'neighborhoods' =>  $request->neighborhoods,
            'complements' =>  $request->complements,
            'updated_at' => date("Y-m-d H:i:s"),
        ]);

        return redirect()->route('client.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $client = Clients::find($id);
        $client->delete();

        return redirect()->route('client.index')->with('success', 'Cliente deletado com sucesso');
    }

    public function search(Request $request)
    {
        if ($request->name === "" || $request->name === null)
            return redirect()->route('client.index');
        else
            $client = Clients::where('contact_name', 'like', '%' . $request->name . '%')->paginate(5);


        return view('client.index', compact('client'));
    }
}
