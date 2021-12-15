<?php

namespace App\Http\Controllers;

use App\Models\Clients;
use App\Models\Products;
use App\Models\Sample;
use App\Models\Test;
use App\Models\Test_record;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Record_testController extends Controller
{
    public function saveStatusTest(Request $request, $op_number)
    {
      //  $sample = Sample::firstWhere('op_number', '=', $op_number);

        $tests = DB::table('tests')->where('op_number', '=', $op_number)->get();

        for ($i = 0; $i < count($tests); $i++) {
            if($request->result[$i] != null || $request->result[$i] != ''){
                Test::where('op_number','=',$op_number)->where('id_experiment','=',$tests[$i]->id_experiment)->update(['result' =>  $request->result[$i],'status'=>'em andamento']);
            }
        }

   /*     $test_record = ['id_client' => $client->id, 'client' => $client->company_name, 'id_product' => $product->id, 'product' => $product->description, 'op_number' => $sample->op_number, 'created_at'=> date('Y/m/d H:i:s'),'updated_at'=> date('Y/m/d H:i:s')];

        Test_record::create($test_record);*/
    }

    public function historic(){
        return view('test.historic');
    }

    public function search(){

    }
}
