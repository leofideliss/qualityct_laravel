<?php

namespace App\Http\Controllers;

use App\Models\Experiment;
use App\Models\Leather_type;
use App\Models\Products;
use App\Models\Sample;
use App\Models\Test;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExperimentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $experiments = Experiment::paginate(5);
        return view('experiment.index', compact('experiments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $leather_types = Leather_type::all();
        return view('experiment.create', compact('leather_types'));
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
            'id_leather_type' => 'required'
        ]);

        $experiment = [
            'name' => $request->name,
            'id_leather_type' => $request->id_leather_type,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];
        Experiment::create($experiment);
        return redirect()->route('experiment.index')->with('message', 'Experimento adicionado com sucesso!');
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
        $experiment = Experiment::find($id);
        $leather_types = Leather_type::all();
        return view('experiment.create', compact('leather_types', 'experiment'));
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
        $request->validate([
            'name' => 'required',
            'id_leather_type' => 'required'
        ]);

        $experiment = [
            'name' => $request->name,
            'id_leather_type' => $request->id_leather_type,
            'updated_at' => date('Y-m-d H:i:s'),
        ];
        Experiment::where(['id' => $id])->update($experiment);
        return redirect()->route('experiment.index')->with('message', 'Experimento alterado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $experiment = Experiment::find($id);
        $experiment->delete();
        return redirect()->route('experiment.index')->with('alert', 'Experimento excluido com sucesso!');
    }

    public function search(Request $request)
    {
        if ($request->name === "" || $request->name === null)
        return redirect()->route('experiment.index');
        else
            $experiments = Experiment::where('name', 'like','%'.$request->name.'%')->paginate(5);
        return view('experiment.index', compact('experiments'));
    }

    public function loadExperiments($id)
    {
        $product = Products::find($id);
        $experiments = Experiment::where('id_leather_type', '=', $product->id_leather_type)->orderByDesc('id')->get();
        return json_encode($experiments);
    }

    public function searchExp($id_experiment)
    {
        $experiment = Experiment::where('id', '=', $id_experiment)->first();
        return $experiment;
    }

    public function loadNormExperiments($id_leather_type){
        $experiments = Experiment::where('id_leather_type', '=', $id_leather_type)->get();
        return json_encode($experiments);
    }

      // Função utilizada no AJAX devolvendo os experimentos salvos e totods os experimentos.
      public function expSelected($op_number){
          
        $tests = Test::where('op_number','=',$op_number)->get();
        $sample = Sample::firstWhere('op_number', $op_number);
        $product = Products::find($sample->id_product);
      
        $experiments = DB::table('experiments')->where('id_leather_type', '=', $product->id_leather_type)->get();

        foreach ($tests as $key => $test) {
            $exp_selected[$key]= Experiment::find($test->id_experiment);
        }

        return json_encode(['experiments'=>$experiments,'exp_selected'=>$exp_selected]);
    }
}
