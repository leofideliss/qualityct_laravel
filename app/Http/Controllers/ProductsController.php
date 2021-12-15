<?php

namespace App\Http\Controllers;

use App\Models\Clients;
use App\Models\Leather_type;
use App\Models\Products;
use Illuminate\Http\Request;
use App\Models\Segment;


class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $url = explode("/", url()->current());
        $client = Clients::find($url[4]);
        return view('products.index', compact('client'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $segments = Segment::all();
        $leather_types = Leather_type::all();
        // Id do cliente na posição 4 da url
        $url = explode("/", url()->current());
        $client = Clients::find($url[4]);
        return view('products.create', compact('segments', 'leather_types', 'client'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $url = explode("/", url()->current());
        $client = Clients::find($url[4]);
        $request->validate(
            ['color' => 'required', 'article' => 'required', 'thickness' => 'required',  'id_segment' => 'required', 'id_leather_type']
        );
        $description = "$request->article $request->color ($request->thickness)";
        $product =  ['description' => $description, 'color' => $request->color, 'article' => $request->article, 'thickness' => $request->thickness,  'id_client' =>  $client->id, 'id_segment' =>  $request->id_segment, 'id_leather_type' => $request->id_leather_type, 'created_at' => date('Y/m/d H:i:s'), 'updated_at' => date('Y/m/d H:i:s')];

        Products::create($product);
        return redirect()->route("client.show", $client->id);
    }

    public function dirStore(Request $request)
    {

        $request->validate(
            ['color' => 'required', 'article' => 'required', 'thickness' => 'required',  'id_segment' => 'required', 'id_leather_type', 'id_client' => 'required']
        );

        $description = "$request->article $request->color ($request->thickness)";
        $product =  ['description' => $description, 'color' => $request->color, 'article' => $request->article, 'thickness' => $request->thickness, 'id_client' =>  $request->id_client, 'id_segment' =>  $request->id_segment, 'id_leather_type' => $request->id_leather_type, 'created_at' => date('Y/m/d H:i:s'), 'updated_at' => date('Y/m/d H:i:s')];

        Products::create($product);
        return redirect()->route("sample.create");
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
    public function edit($id_client ,$id_product)
    {
        $products = Products::find($id_product);

        $segments = Segment::all();
        $leather_types = Leather_type::all();



        return view('products.create', compact('products', 'segments', 'leather_types', ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id_client ,$id)
    {
        $request->validate(
            [
                'color' => 'required',
                'article' => 'required',
                'thickness' => 'required',
                'id_segment' => 'required',
                'id_leather_type' => 'required',
                'updated_at' => date('Y/m/d H:i:s')
            ]
        );

        $description = "$request->article $request->color ($request->thickness)";

        $product =  [
            'description' => $description,
            'color' => $request->color,
            'article' => $request->article,
            'thickness' => $request->thickness,
            'id_segment' =>  $request->id_segment,
            'id_leather_type' => $request->id_leather_type,
            'updated_at' => date('Y/m/d H:i:s')
        ];

        Products::where(['id' => $id])->update($product);
        $url = explode("/", url()->current());
        return redirect()->route("client.show", $url[4]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_client,$id)
    {
        $product = Products::find($id);
        $product->delete();
      //  $url = explode("/", url()->current());
        return redirect()->route("client.show", $id_client);
    }

    public function createDir()
    {
        $segments = Segment::all();
        $leather_types = Leather_type::all();
        $clients = Clients::all();

        return view('products.createDirect', compact('segments', 'leather_types', 'clients'));
    }

    public function loadProducts($id)
    {
        $products = Products::where('id_client', '=', $id)->get();
        return json_encode($products);
    }

    public function search(Request $request)
    {
    }

    public function listProducts($id_client)
    {
        $products = Products::where('id_client', '=', $id_client)->get();

        foreach ($products as $key => $product) {
            $segment = Segment::find($product->id_segment);
            $leather = Leather_type::find($product->id_leather_type);

            $data[$key] = [
                'product_id' => $product->id,
                'product_desc' => $product->description,
                'segment' => $segment->name,
                'leather' => $leather->name,
                'client_id' => $product->id_client
            ];
        }

        if (isset($data))
            return json_encode($data);

        return json_encode([
            'id' => 0,
            'msg' => "Nenhum produto encontrado!"
        ]);
    }

    public function list()
    {
        $clients = Clients::all();
        return view('products.list', compact('clients'));
    }

    public function deleteProd($id)
    {
        $product = Products::find($id);
        $product->delete();
        return json_encode(['msg'=>'Produto deletado com sucesso']);
    }

}
