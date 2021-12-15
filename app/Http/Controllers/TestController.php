<?php

namespace App\Http\Controllers;

use App\Helpers\CollectionHelper;
use App\Models\Sample;
use App\Models\Products;
use App\Models\Clients;
use App\Models\Experiment;
use App\Models\Leather_type;
use App\Models\Segment;
use App\Models\Test;
use App\Models\Norm;
use App\Models\Specification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade as PDF;
use PhpParser\Node\Expr\FuncCall;
use stdClass;

class TestController extends Controller
{
    public function index()
    {
        $samples = DB::table('samples')->where('status', '=', 'em andamento')->get();

        for ($j = 0; $j < count($samples); $j++) {
            $test = Test::where('op_number', '=', $samples[$j]->op_number)->get();
            $product = Products::find($samples[$j]->id_product);
            $client = Clients::find($samples[$j]->id_client);

            for ($i = 0; $i < count($test); $i++) {
                $experiment = Experiment::find($test[$i]->id_experiment);
                $array_experiments[$i] = [
                    'name' => $experiment->name,
                    'status' => $test[$i]->status
                ];
            }
            $array_experiments = (object) $array_experiments;

            $result[$j] = [
                'op_number' => $samples[$j]->op_number,
                'description' => $product->description,
                'client' => $client->contact_name,
                'experiments' => $array_experiments,
            ];

            unset($array_experiments);
        }

        $object = new stdClass();
        if (isset($result)) {
            $object = $result;

            $data = CollectionHelper::paginate($object, 2);
            return view('test.index', compact('data'));
        }

        return view('test.index');
    }

    public function selectExperiments($op_number)
    {
        $sample = Sample::firstWhere('op_number', $op_number);
        $product = Products::find($sample->id_product);
        $client = Clients::find($sample->id_client);
        $type_leather = Leather_type::find($product->id_leather_type);
        $segment = Segment::find($product->id_segment);
        $experiments = DB::table('experiments')->where('id_leather_type', '=', $type_leather->id)->get();


        return view('test.selectExperiments', compact('sample', 'product', 'client', 'type_leather', 'segment', 'experiments'));
    }

    public function setExperiments(Request $request, $op_number)
    {
        $sample = Sample::firstWhere('op_number', $op_number);


        if ($request->experiments != null && count($request->experiments) > 0) {

            for ($i = 0; $i < count($request->experiments); $i++) {
                $test = [
                    'id_experiment' =>  $request->experiments[$i],
                    'op_number' => $sample->op_number,
                    'result' => '',
                    'date_finish' => null,
                    'status' => false,
                    'specification' => false,
                    'approved' => true,
                ];
                Test::create($test);
            }
            Sample::where(['op_number' => $sample->op_number])->update(['status' => 'em andamento','date_col'=>$sample->date_col]);
            return redirect()->route('test.execute', $op_number)->with('message', 'Experimentos definidos com sucesso!');
        } else {
            Sample::where(['op_number' => $sample->op_number])->update(['status' => 'nao definido']);
            return redirect()->route('test.select', $op_number)->with('alert', 'Selecione pelo menos um experimento!');
        }
    }

    public function destroy($op_number)
    {
        Test::where('op_number', '=', $op_number)->delete();
        Sample::where(['op_number' => $op_number])->update(['status' => 'nao definido']);
        return redirect()->route('test.index')->with('alert', 'Teste excluído com sucesso!');
    }

    public function executeDisplay($op_number)
    {
        $sample = Sample::firstWhere('op_number', $op_number);
        $product = Products::find($sample->id_product);
        $client = Clients::find($sample->id_client);
        $type_leather = Leather_type::find($product->id_leather_type);
        $segment = Segment::find($product->id_segment);
        $tests = Test::where('op_number', '=', $op_number)->get();

        $spec = Specification::where('id_product', '=', $product->id)->exists();
        //dd($spec);
        for ($i = 0; $i < count($tests); $i++) {
            $experiments[$i] = Experiment::find($tests[$i]->id_experiment);
        }
        //   $experiments = DB::table('experiments')->where('id_leather_type', '=', $type_leather->id)->get();

        return view('test.execute', compact('sample', 'product', 'client', 'type_leather', 'segment', 'experiments', 'spec'));
    }



    public function searchSpec($id_product, $id_experiment)
    {
        $spec = Specification::where('id_product', '=', $id_product)->where('id_experiment', '=', $id_experiment)->first();
        return $spec;
    }

    public function searchNorm($id_segment, $id_leather_type, $id_experiment)
    {
        $norm = Norm::where('id_leather_type', '=', $id_leather_type)->where('id_segment', '=', $id_segment)->where('id_experiment', '=', $id_experiment)->first();
        
        return $norm;
    }

    public function finish($op_number)
    {

        $tests = Test::where('op_number', '=', $op_number)->get();
        $i = 0;
        foreach ($tests as $test) {
            if ($test->status == 0)
                $i++;
        }
        if ($i != 0)
            return redirect()->back()->with('errors', "Existe experimentos não realizados!");
        else {
            $sample = Sample::where('op_number', '=', $op_number)->first();
            $product = Products::where('id', '=', $sample->id_product)->first();
            if ($tests[0]->specification == 0) {
                $cont = 0;
                foreach ($tests as $test) {
                    if (Norm::where('id_experiment', '=', $test->id_experiment)->where('id_segment', '=', $product->id_segment)->where('id_leather_type', '=', $product->id_leather_type)->exists())
                        $cont++;
                }
      
                if (count($tests) != $cont)
                    return redirect()->back()->with('errors', "Todos os experimentos devem possuir uma norma cadastrada!");
            }
            $this->calcResult($tests, $product->id_leather_type, $product->id_segment, $product->id);

            //  Test::where('op_number','=',$op_number)->update(['status'=>'finalizado']);
            Sample::where('op_number', '=', $op_number)->update(['status' => 'finalizado','date_col'=>$sample->date_col]);
            Sample::where('op_number', '=', $op_number)->update(['updated_at' => date('Y/m/d H:i:s'),'date_col'=>$sample->date_col]);
            return redirect()->route('test.index')->with('message', "Ordem produção: ($op_number) finalizado com sucesso!");
        }
    }

    public function saveTest(Request $request, $op_number)
    {
        $tests = DB::table('tests')->where('op_number', '=', $op_number)->get();
        $sample = Sample::where('op_number', '=', $op_number)->first();
        $spec = Specification::where('id_product', '=', $sample->id_product)->exists();

        

        for ($i = 0; $i < count($tests); $i++) {
         
            if ($request->result[$i] != null || $request->result[$i] != '') {
                if(isset($request->weared[$i]))
                $result =  $request->result[$i]. " " ."(". $request->weared[$i] .")";
                else
                $result = $request->result[$i];
                Test::where('op_number', '=', $op_number)->where('id_experiment', '=', $tests[$i]->id_experiment)->update(['result' => $result, 'status' => true, 'specification' => $spec]); // 
            }
        }

        return redirect()->route('test.execute', $op_number)->with('message', "Experimentos salvos com sucesso!");
    }

    public function historic()
    {
        $samples = Sample::where('status', '=', 'finalizado')->latest()->paginate(8);
        return view('test.historic', compact('samples'));
    }

    public function searchTest(Request $request)
    {
        if ($request->name === "" || $request->name === null)
            return redirect()->route('test.index');
        else {
            $samples = DB::table('samples')->where('status', '=', 'em andamento')->where('op_number', 'like', '%' . $request->name . '%')->get();
            for ($j = 0; $j < count($samples); $j++) {
                $test = Test::where('op_number', '=', $samples[$j]->op_number)->get();
                $product = Products::find($samples[$j]->id_product);
                $client = Clients::find($samples[$j]->id_client);

                for ($i = 0; $i < count($test); $i++) {
                    $experiment = Experiment::find($test[$i]->id_experiment);
                    $array_experiments[$i] = [
                        'name' => $experiment->name,
                        'status' => $test[$i]->status
                    ];
                }
                $array_experiments = (object) $array_experiments;

                $result[$j] = [
                    'op_number' => $samples[$j]->op_number,
                    'description' => $product->description,
                    'client' => $client->contact_name,
                    'experiments' => $array_experiments,
                ];

                unset($array_experiments);
            }

            $object = new stdClass();
            if (isset($result)) {
                $object = $result;

                $data = CollectionHelper::paginate($object, 2);
                return view('test.index', compact('data'));
            }

            return view('test.index');
        }
    }

    public function searchResult($experiment_id, $op_number)
    {
        $test = DB::table('tests')->where('op_number', '=', $op_number)->where('id_experiment', '=', $experiment_id)->first();
        return $test;
    }

    public function viewPdf($op_number)
    {
        $sample = Sample::firstWhere('op_number', $op_number);
        $product = Products::find($sample->id_product);
        $client = Clients::find($sample->id_client);
        //    $type_leather = Leather_type::find($product->id_leather_type);
        //     $segment = Segment::find($product->id_segment);
        //   $experiments = DB::table('experiments')->where('id_leather_type', '=', $product->id_leather_type)->get();

        $tests = Test::where('op_number', '=', $op_number)->get();

        // Calcular o resultado.
        $result = $this->calcResult($tests, $product->id_leather_type, $product->id_segment, $product->id);
        // Variavel para adicionar o nome da norma, no caso de ser esp. do cliente.


        for ($i = 0; $i < count($tests); $i++) {
            if ($tests[$i]->specification == 0) {
                $norm = Norm::where('id_experiment', '=', $tests[$i]->id_experiment)->where('id_leather_type', '=', $product->id_leather_type)->where('id_segment', '=', $product->id_segment)->first();
                $name = $norm->name;
            } else {
                $norm = Specification::where('id_experiment', '=', $tests[$i]->id_experiment)->where('id_product', '=', $product->id)->first();
                $name = "Esp. do Cliente";
            }

            $experiment = Experiment::find($tests[$i]->id_experiment);
            $uni = explode(" ", $norm->min_value);
            $rows[$i] = [
                'name' => $experiment->name,
                'norm' => $name,
                'uni' => $norm->id_uni,
                'min_value' => $norm->min_value,
                'result' => $tests[$i]->result,
                'approved' => $tests[$i]->approved,
            ];
        }




        /*
        $samples = Sample::where('op_number', '=', $op_number)->first();

        $test = Test::where('op_number', '=', $samples->op_number)->get();
        $product = Products::find($samples->id_product);
        $client = Clients::find($samples->id_client);

        for ($i = 0; $i < count($test); $i++) {
            $experiment = Experiment::find($test[$i]->id_experiment);
            $array_experiments[$i] = [
                'name' => $experiment->name,
                'status' => $test[$i]->status,
                'result' => $test[$i]->result,
            ];
        }

        $data = [
            'op_number' => $samples->op_number,
            'description' => $product->description,
            'client' => $client->contact_name,
            'experiments' => $array_experiments,
        ];*/

        return PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('test.viewTest', compact('sample', 'product', 'client', 'rows', 'result'))->stream();
    }


    public function downloadPdf($op_number)
    {
        $sample = Sample::firstWhere('op_number', $op_number);
        $product = Products::find($sample->id_product);
        $client = Clients::find($sample->id_client);
        //    $type_leather = Leather_type::find($product->id_leather_type);
        //     $segment = Segment::find($product->id_segment);
        //   $experiments = DB::table('experiments')->where('id_leather_type', '=', $product->id_leather_type)->get();

        $tests = Test::where('op_number', '=', $op_number)->get();

        // Calcular o resultado.
        $result = $this->calcResult($tests, $product->id_leather_type, $product->id_segment, $product->id);
        // Variavel para adicionar o nome da norma, no caso de ser esp. do cliente.


        for ($i = 0; $i < count($tests); $i++) {
            if ($tests[$i]->specification == 0) {
                $norm = Norm::where('id_experiment', '=', $tests[$i]->id_experiment)->where('id_leather_type', '=', $product->id_leather_type)->where('id_segment', '=', $product->id_segment)->first();
                $name = $norm->name;
            } else {
                $norm = Specification::where('id_experiment', '=', $tests[$i]->id_experiment)->where('id_product', '=', $product->id)->first();
                $name = "Esp. do Cliente";
            }

            $experiment = Experiment::find($tests[$i]->id_experiment);
            $uni = explode(" ", $norm->min_value);
            $rows[$i] = [
                'name' => $experiment->name,
                'norm' => $name,
                'uni' => $norm->id_uni,
                'min_value' => $norm->min_value,
                'result' => $tests[$i]->result,
                'approved' => $tests[$i]->approved,
            ];
        }




        /*
        $samples = Sample::where('op_number', '=', $op_number)->first();

        $test = Test::where('op_number', '=', $samples->op_number)->get();
        $product = Products::find($samples->id_product);
        $client = Clients::find($samples->id_client);

        for ($i = 0; $i < count($test); $i++) {
            $experiment = Experiment::find($test[$i]->id_experiment);
            $array_experiments[$i] = [
                'name' => $experiment->name,
                'status' => $test[$i]->status,
                'result' => $test[$i]->result,
            ];
        }

        $data = [
            'op_number' => $samples->op_number,
            'description' => $product->description,
            'client' => $client->contact_name,
            'experiments' => $array_experiments,
        ];*/

        return PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('test.viewTest', compact('sample', 'product', 'client', 'rows', 'result'))->download("$op_number.pdf");
    }

    public function calcResult($tests, $id_leather_type, $id_segment, $id_product)
    {
        //$sample = Sample::where('op_number', '=', $op_number)->first();
        //$product = Products::where('id', '=', $sample->id_product)->first();
        //$tests = Test::where('op_number', '=', $op_number)->get();

        $cont = 0;
        foreach ($tests as $value) {
            $approved = true;
            if ($value->specification == 0)
                $norm = Norm::where('id_experiment', '=', $value->id_experiment)->where('id_leather_type', '=', $id_leather_type)->where('id_segment', '=', $id_segment)->first();
            else
                $norm = Specification::where('id_experiment', '=', $value->id_experiment)->where('id_product', '=', $id_product)->first();

            $op = explode(" ", $norm->min_value);
            $result_value = str_replace(",", ".", $value->result);
            $result_norm = str_replace(",", ".", $op[1]);
            $result_value = str_replace("/", ".", $value->result);
            $result_norm = str_replace("/", ".", $op[1]);

            switch ($op[0]) {
                case '<':
                    if (floatval($result_value) < floatval($result_norm))
                        $cont++;
                    else
                        $approved = false;
                    break;
                case '<=':
                    if (floatval($result_value) <= floatval($result_norm))
                        $cont++;
                    else
                        $approved = false;
                    break;
                case '=':
                    if (floatval($result_value) == floatval($result_norm))
                        $cont++;
                    else
                        $approved = false;
                    break;
                case '>':
                    if (floatval($result_value) > floatval($result_norm))
                        $cont++;
                    else
                        $approved = false;
                    break;
                case '>=':
                    if (floatval($result_value) >= floatval($result_norm))
                        $cont++;
                    else
                        $approved = false;
                    break;

                default:
                    # code...
                    break;
            }
            Test::where('id', '=', $value->id)->update(['approved' => $approved]);
        }
        $tot_tests = count($tests);
        $percent = (100 * $cont) / $tot_tests;
        return number_format($percent, 2) . " %";
        // if (floatval($percent) <= 25)
        //     return 'Péssima';
        // if (floatval($percent) > 25 && floatval($percent) <= 50)
        //     return 'Ruim';
        // if (floatval($percent) > 50 && floatval($percent) <= 75)
        //     return 'Regular';
        // if (floatval($percent) > 75 && floatval($percent) <= 90)
        //     return 'Boa';
        // if (floatval($percent) > 90 && floatval($percent) <= 100)
        //     return 'Ótima';
    }


    // public function downloadPdf($op_number)
    // {
    //     $sample = Sample::firstWhere('op_number', $op_number);
    //     $product = Products::find($sample->id_product);
    //     $client = Clients::find($sample->id_client);
    //     $type_leather = Leather_type::find($product->id_leather_type);
    //     $segment = Segment::find($product->id_segment);
    //     $experiments = DB::table('experiments')->where('id_leather_type', '=', $type_leather->id)->get();

    //     /*
    //     $samples = Sample::where('op_number', '=', $op_number)->first();

    //     $test = Test::where('op_number', '=', $samples->op_number)->get();
    //     $product = Products::find($samples->id_product);
    //     $client = Clients::find($samples->id_client);

    //     for ($i = 0; $i < count($test); $i++) {
    //         $experiment = Experiment::find($test[$i]->id_experiment);
    //         $array_experiments[$i] = [
    //             'name' => $experiment->name,
    //             'status' => $test[$i]->status,
    //             'result' => $test[$i]->result,
    //         ];
    //     }

    //     $data = [
    //         'op_number' => $samples->op_number,
    //         'description' => $product->description,
    //         'client' => $client->contact_name,
    //         'experiments' => $array_experiments,
    //     ];*/
    //     return PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('test.viewTest', compact('sample', 'product', 'client', 'type_leather', 'segment', 'experiments'))->download("$op_number.pdf");
    // }

    public function selectValuesRef($op_number)
    {
        $sample = Sample::where('op_number', '=', $op_number)->first();
        $product = Products::where('id', '=', $sample->id_product)->first();
        $tests = Test::where('op_number', '=', $op_number)->get();
    }

    public function editExperiments($op_number)
    {
        $sample = Sample::firstWhere('op_number', $op_number);
        $product = Products::find($sample->id_product);
        $client = Clients::find($sample->id_client);
        $type_leather = Leather_type::find($product->id_leather_type);
        $segment = Segment::find($product->id_segment);
        $experiments = DB::table('experiments')->where('id_leather_type', '=', $type_leather->id)->get();
        $tests = Test::where('op_number', '=', $op_number)->get();

        foreach ($tests as $key => $test) {
            $exp_selected[$key] = Experiment::find($test->id_experiment);
        }

        return view('test.selectExperiments', compact('sample', 'product', 'client', 'type_leather', 'segment', 'experiments', 'exp_selected'));
    }

    public function updateExperiments(Request $request, $op_number)
    {
        $sample = Sample::where('op_number', '=', $op_number)->first();
        $product = Products::find($sample->id_product);

        $not_selected = Experiment::where('id_leather_type', '=', $product->id_leather_type)->whereNotIn('id', $request->experiments)->get();

        foreach ($not_selected as $value) {
            if (Test::where('op_number', '=', $op_number)->where('id_experiment', '=', $value->id)->exists()) {
                $not_test = Test::where('op_number', '=', $op_number)->where('id_experiment', '=', $value->id)->first();
                $not_test->delete();
            }
        }

        if ($request->experiments != null && count($request->experiments) > 0) {

            for ($i = 0; $i < count($request->experiments); $i++) {
                if (Test::where('op_number', '=', $op_number)->where('id_experiment', '=', $request->experiments[$i])->doesntExist()) {
                    $test = [
                        'id_experiment' =>  $request->experiments[$i],
                        'op_number' => $sample->op_number,
                        'result' => '',
                        'date_finish' => null,
                        'status' => false,
                        'specification' => false,
                        'approved' => true,
                    ];
                    Test::create($test);
                }
            }
            Sample::where(['op_number' => $sample->op_number])->update(['status' => 'em andamento' ,'date_col' => $sample->date_col]);
            return redirect()->route('test.execute', $op_number)->with('message', 'Experimentos atualizados com sucesso!');
        } else {
            Sample::where(['op_number' => $sample->op_number])->update(['status' => 'nao definido']);
            return redirect()->route('test.select', $op_number)->with('alert', 'Selecione pelo menos um experimento!');
        }
    }

    public function historicDir()
    {
        $samples = Sample::where('status', '=', 'finalizado')->latest()->paginate(8);
        return view('test.reultsDirector', compact('samples'));
    }

    public function searchHistoric(Request $request)
    {

        if ($request->name === '' || $request->name === null)
            if ($request->type == '1')
                return redirect()->route('test.historicDir');
            else
                return redirect()->route('test.historic');
        else {

            $samples = Sample::where('status', '=', 'finalizado')->where('op_number', '=', $request->name)->paginate(8);
            if ($request->type == '1') {

                return view('test.reultsDirector', compact('samples'));
            } else {

                return view('test.historic', compact('samples'));
            }
        }
    }
}
