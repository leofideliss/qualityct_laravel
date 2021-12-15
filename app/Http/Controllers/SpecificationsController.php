<?php

namespace App\Http\Controllers;

use App\Helpers\CollectionHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Clients;
use App\Models\Experiment;
use App\Models\Measure;
use App\Models\Products;
use App\Models\Specification;
use App\Models\Sample;
use App\Models\Test;


class SpecificationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $products = Products::all();
        $result = [$i = 0];
        foreach ($products as $value) {
            if (DB::table('specifications')->where('id_product', $value->id)->exists())
                $result[$i++] = $value;
        }
        $data = CollectionHelper::paginate($result, 5);



        return view('specifications.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $clients = Clients::all();
        $products = Products::all();
        return view('specifications.create', compact('clients', 'products'));
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
            'id_client' => 'required',
            'id_product' => 'required',
        ]);

        $product = Products::find($request->id_product);
        $experiments = Experiment::where('id_leather_type', '=', $product->id_leather_type)->get();


        for ($i = 0; $i < count(($experiments)); $i++) {
            if ($request->min_value[$i] != null && $request->uni[$i] != '') {
                switch ($request->uni[$i]) {
                    case '1':
                        $min_value = $request->min_value[$i] . " (Kgf)";
                        break;
                    case '2':
                        $min_value = $request->min_value[$i] . " (N)";
                        break;
                    case '3':
                        $min_value = $request->min_value[$i] . " (%)";
                        break;
                    case '4':
                        $min_value = $request->min_value[$i] . " (E/C)";
                        break;
                    case '5':
                        $min_value = $request->min_value[$i] . " (mm)";
                        break;

                    default:

                        break;
                }
            }
            else
            return redirect()->back()->with('msg',"Existe experimentos não preenchidos !");


            $specifications[$i] = [
                'id_client' => $request->id_client,
                'name' => 'Esp. Cliente',
                'min_value' => $min_value,
                'id_product' => $product->id,
                'id_experiment' => $experiments[$i]->id,
                'id_uni' => $request->uni[$i],
                'created_at' => date('Y/m/d H:i:s'),
                'updated_at' => date('Y/m/d H:i:s'),
            ];
            Specification::create($specifications[$i]);
        }
        return redirect()->route('specifications.index');
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
        $specification = Specification::where('id_product', '=', $id)->first();

        $clients = Clients::where('id', '=', $specification->id_client)->get();
        $products = Products::where('id', '=', $specification->id_product)->get();
        $measures = Measure::all();

        return view('specifications.edit', compact('specification', 'clients', 'products', 'measures'));
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
        $experiments = Experiment::where('id_leather_type', '=', $id)->get();

        for ($i = 0; $i < count(($experiments)); $i++) {
            $str = explode(' ', $request->min_value[$i]);
            switch ($request->uni[$i]) {
                case '1':
                    if (count($str) == 2)
                        $min_value = $request->min_value[$i] . " (Kgf)";
                    else
                        $min_value = $request->min_value[$i];
                    break;
                case '2':
                    if (count($str) == 2)
                        $min_value = $request->min_value[$i] . " (N)";
                    else
                        $min_value = $request->min_value[$i];
                    break;
                case '3':
                    if (count($str) == 2)
                        $min_value = $request->min_value[$i] . " (%)";
                    else
                        $min_value = $request->min_value[$i];
                    break;
                case '4':
                    if (count($str) == 2)
                        $min_value = $request->min_value[$i] . " (E/C)";
                    else
                        $min_value = $request->min_value[$i];
                    break;
                case '5':
                    if (count($str) == 2)
                        $min_value = $request->min_value[$i] . " (mm)";
                    else
                        $min_value = $request->min_value[$i];
                    break;

                default:

                    break;
            }

            Specification::where('id_product', $id)->where('id_experiment', '=', $experiments[$i]->id)->update([
                'min_value' => $min_value,
                'id_uni' => $request->uni[$i],
                'updated_at' => date('Y/m/d H:i:s'),
            ]);
        }
        return redirect()->route('specifications.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Specification::where('id_product', '=', $id)->delete();
        return redirect()->route('specifications.index');
    }

    public function loadSpecifications($id)
    {
        $specifications = Specification::where('id_product', '=', $id)->get();
        return json_encode($specifications);
    }

    public function searchSpecifications($id)
    {
        $spec = Specification::where('id_product', '=', $id)->get();
        return $spec;
    }

    public function search(Request $request) // Busca para exibir no index
    {
        $result = [$i = 0];
        if ($request->name === "" || $request->name === null)
            return redirect()->route('specifications.index');
        else {
            $client = Clients::where('company_name', 'like', '%' . $request->name . '%')->get();

            foreach ($client as $cli) {
                $product = Products::where('id_client', '=', $cli->id)->get();
                foreach ($product as $prod) {
                    if (DB::table('specifications')->where('id_product', $prod->id)->exists())
                        $result[$i++] = $prod;
                }
            }
        }
        $data = CollectionHelper::paginate($result, 5);
        return view('specifications.index', compact('data'));
    }

    public function searchSpec($op_number) //Busca para a requisição AJAX
    {
        $sample = Sample::where('op_number', '=', $op_number)->first();
        $product = Products::where('id', '=', $sample->id_product)->first();

        $tests = Test::where('op_number', '=', $op_number)->get();

        for ($i = 0; $i < count($tests); $i++) {
            $specifications[$i] = Specification::where('id_experiment', '=', $tests[$i]->id_experiment)->where('id_product', '=', $product->id)->first();
        }

        return json_encode($specifications);
    }
}
