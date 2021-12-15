<?php

namespace App\Http\Controllers;

use App\Models\Experiment;
use App\Models\Leather_type;
use App\Models\Measure;
use App\Models\Norm;
use App\Models\Products;
use App\Models\Sample;
use App\Models\Segment;
use App\Models\Test;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class NormController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $norms = Norm::paginate(5);
        return view('norm.index', compact('norms'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $leathers = Leather_type::all();
        $segments = Segment::all();
        $experiments = Experiment::all();
        $measures = Measure::all();
        return view('norm.create', compact('leathers', 'segments', 'experiments','measures'));
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
            'id_segment' => 'required',
            'id_leather_type' => 'required',
            'min_value' => 'required',
            'id_experiment' => 'required',
            'id_uni' => 'required',
            'norm_file' => 'nullable|mimes:pdf'
        ]);

        switch ($request->id_uni) {
            case '1':
                $min_value = $request->min_value . " (Kgf)";
                break;
            case '2':
                $min_value = $request->min_value . " (N)";
                break;
            case '3':
                $min_value = $request->min_value . " (%)";
                break;
            case '4':
                $min_value = $request->min_value . " (E/C)";
                break;
            case '5':
                $min_value = $request->min_value . " (mm)";
                break;

            default:

                break;
        }

        $norm = [
            'name' => $request->name,
            'id_segment' => $request->id_segment,
            'id_leather_type' => $request->id_leather_type,
            'id_experiment' => $request->id_experiment,
            'id_uni' => $request->id_uni,
            'min_value' => $min_value,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        if ($request->file('norm_file') != null)
            if ($request->file('norm_file')->isValid()) {
                $name = $request->name;
                $extension = $request->file('norm_file')->extension();
                $filename = "{$name}.{$extension}";
                $request->file('norm_file')->storeAs('norms', $filename);
                // return redirect()->route('import.index')->with('message', 'Arquivo adicionado com sucesso!');
            }
        Norm::create($norm);
        return redirect()->route('norm.index')->with('message', 'Norma adicionada com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $norm = Norm::find($id);

        if (Storage::disk('norms')->exists("$norm->name.pdf")) {
            $file = storage_path('app' . DIRECTORY_SEPARATOR . 'norms') . DIRECTORY_SEPARATOR . "$norm->name.pdf";
            return response()->file($file);
        } else {
            return redirect()->route('norm.index')->with('file_not_found', "Arquivo não encontrado!");
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $leathers = Leather_type::all();
        $segments = Segment::all();
        $experiments = Experiment::all();
        $norm = Norm::find($id);
        $measures = Measure::all();
        return view('norm.create', compact('norm', 'leathers', 'segments', 'experiments','measures'));
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
            'id_segment' => 'required',
            'id_leather_type' => 'required',
            'id_experiment' => 'required',
            'min_value' => 'required',
            'id_uni' => 'required',
            'norm_file' => 'nullable|mimes:pdf'
        ]);

        switch ($request->id_uni) {
            case '1':
                $min_value = $request->min_value . " (Kgf)";
                break;
            case '2':
                $min_value = $request->min_value . " (N)";
                break;
            case '3':
                $min_value = $request->min_value . " (%)";
                break;
            case '4':
                $min_value = $request->min_value . " (E/C)";
                break;
            case '5':
                $min_value = $request->min_value . " (mm)";
                break;

            default:

                break;
        }

        $norm = [
            'name' => $request->name,
            'id_segment' => $request->id_segment,
            'id_leather_type' => $request->id_leather_type,
            'id_uni' => $request->id_uni,
            'min_value' => $min_value,
            'id_experiment' => $request->id_experiment,
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        if ($request->file('norm_file') != null)
            if ($request->file('norm_file')->isValid()) {
                $name = $request->name;
                $extension = $request->file('norm_file')->extension();
                $filename = "{$name}.{$extension}";
                $request->file('norm_file')->storeAs('norms', $filename);
                // return redirect()->route('import.index')->with('message', 'Arquivo adicionado com sucesso!');
            }
        // return redirect()->route('import.index')->with('message', 'Arquivo adicionado com sucesso!');




        Norm::where(['id' => $id])->update($norm);
        return redirect()->route('norm.index')->with('message', 'Norma alterada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $norm = Norm::find($id);
        $norm->delete();
        return redirect()->route('norm.index')->with('deleted', 'Norma excluida com sucesso!');
    }

    public function search(Request $request)
    {
        if ($request->name === "" || $request->name === null)
            return redirect()->route('norm.index');
        else
            $norms = Norm::where('name', 'like', '%' . $request->name . '%')->paginate(5);


        return view('norm.index', compact('norms'));
    }

    public function searchNorm($op_number)
    {
        $sample = Sample::where('op_number', '=', $op_number)->first();
        $product = Products::where('id', '=', $sample->id_product)->first();

        $tests = Test::where('op_number', '=', $op_number)->get();

        for ($i = 0; $i < count($tests); $i++) {
            $norms[$i] = Norm::where('id_experiment', '=', $tests[$i]->id_experiment)->where('id_segment', '=', $product->id_segment)->where('id_leather_type', '=', $product->id_leather_type)->first();
        }

        return json_encode($norms);
    }
}
