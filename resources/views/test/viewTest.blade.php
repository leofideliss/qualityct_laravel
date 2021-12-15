<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>{{ "$sample->op_number.pdf" }}</title>
    <style>
        * {
            font-family: Arial, Helvetica, sans-serif;
        }

        body,
        html {
            width: 100%;
            height: 100%;
        }

        #logo {
            color: grey;
            /* height: 4%; */
            border-bottom-style: solid;
            display: block;
            font-weight: bold;
            font: normal 24pt verdana;
            justify-content: center;
            align-content: center;

        }

        #logo img {
            width: 50px;
            height: 60px;
        }

        #op_number {
            text-align: right;
            color: grey;
        }

        #title {
            font-size: 16pt;
            text-align: center;
            font-weight: bolder;
            margin-top: 2%;
        }

        #table-div {
            margin-top: 4%;
        }

        #table {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        #table td,
        #table th {
            border: 1px solid black;
            padding: 8px;
        }

        #table th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #247BA0;
            color: white;
        }


        .itens {
            margin-top: 3%;
            display: block;
        }

        .header {
            margin-top: 3%;
            border-color: #dcdcdc;
 
            border-top-style: solid;
        }

        .itens-header {

            font-size: 13pt;
            margin-right: 15%;
            margin-top: 1%;

        }

        #test {
            margin-top: 20px;
        }

        #ass-div {
            margin-top: 10%;
        }

        .ass {
            margin: 80px;
            width: 200px;
            border-top: 1px solid black;
            text-align: center;
            display: inline;
        }

        .page-break {
            page-break-after: always;
        }

        #table-header {
            width: 100%;
        }

        #table-header th {
            text-align: left;
        }

        #table-header td {
            text-align: left;
        }

        #label {
            width: 100%;
            height: 100px;
            border-color: #dcdcdc;
            border-bottom-style: solid;
       font-size: 11pt;
            margin-top: 20px;
        }

    </style>

</head>

<body>
    <div id="logo">
        <img src="https://i.ibb.co/DDYFRGg/logo-curtume-2.png" alt="">
        CURTUME TOURO
    </div>
    <div id="op_number">
        <span>{{ $sample->op_number }}</span>
    </div>
    <div id="title">
        Controle de Qualidade
    </div>

    <div class="header">
        <table id="table-header">
            <th>
                <tr>
                    <th>Cliente:</th>
                    <td colspan="2"> {{ $client->company_name }}</td>
                </tr>
            </th>
            <th>
                <tr>
                    <th>Artigo:</th>
                    <td> {{ $product->article }}</td>
                    <th>Cor:</th>
                    <td> {{ $product->color }}</td>
                    <th>Espessura:</th>
                    <td> {{ $product->thickness }}</td>
                </tr>
            </th>
            <th>
                <tr>
                    <th colspan="1">Data da coleta:</th>
                    <td colspan="1"> {{ date('d/m/Y', strtotime($sample->date_col)) }}</td>
                    <th colspan="2">Data da finalização:</th>
                    <td colspan=""> {{ date('d/m/Y', strtotime($sample->updated_at)) }}</td>
                </tr>
            </th>
        </table>
        {{-- <div class="itens-header">
            Cliente: {{$client->company_name}}
        </div>
        <div class="itens-header">
            Produto: {{$product->description}}
        </div>
        <div class="itens-header">
            Data da finalização: {{ date('d/m/Y', strtotime($sample->updated_at))}}
        </div>--}}
    </div> 
   



    <div id="test">
        <h3>Teste realizados</h3>
    </div>


    <table id="table">
        <thead>
            <th>Experimento</th>
            <th>Norma</th>
            <th>Unidade de medida</th>
            <th>Valor de Referência</th>
            <th>Resultado</th>

        </thead>
        <tbody>
            @foreach ($rows as $row)
                {{-- @php
            if ($test->specification == 0) {
            //Busca os valores da norma.
            $norms =
            app(App\Http\Controllers\TestController::class)->searchNorm($product->id_segment,$product->id_leather_type,$test->id_experiment);
            } else {
            //Busca os valores da especificação.
            $norms =
            app(App\Http\Controllers\TestController::class)->searchSpec($product->id,$test->id_experiment);
            }

            $exp =  app(App\Http\Controllers\ExperimentController::class)->searchExp($test->id_experiment);

            //Busca os resultados do teste
            // $result_search =
            // app(App\Http\Controllers\TestController::class)->searchResult($experiment->id,$sample->op_number);

            //Resultado baseado na porcentagem dos testes que atenderam os valores orientados.
            $conclusion = app(App\Http\Controllers\TestController::class)->calcResult($sample->op_number);
            @endphp --}}
                @php
                    $measure_search = new App\Models\Measure();
                    
                    $measure = $measure_search::find($row['uni']);
                    
                @endphp
                <tr>
                    <td>{{ $row['name'] }} </td>
                    <td>{{ $row['norm'] ?? 'Não definida' }} </td>
                    <td>{{ $measure->uni ?? 'Não definida' }} </td>
                    <td>{{ $row['min_value'] ?? 'Não definida' }} </td>
                    <td>{{ $row['result'] ?? 'Não realizado' }} </td>

                </tr>
            @endforeach

        </tbody>
    </table>
    <div id="label">
        <b> Legenda Fricção Seco/Úmido</b><br>
        <small> O = Intacto </small><br>
        <small>G = Leve desgaste </small><br>
        <small> D = Desgaste</small><br>
        <small> S = Forte desgaste</small> <br>

    </div>

    <div id="test">

        @if ($result == '100.00 %')
            <small>**Todos os experimentos de acordo com as Normas</small>
        @else
            <small>**Testes que não atenderam as Normas: </small>
            @foreach ($rows as $row)
                @if ($row['approved'] == false)
                    <small>{{ $row['name'] . ';' }} </small>
                @endif
            @endforeach
        @endif
    </div>

    <div id="ass-div">

        <div class="ass">
            Assinatura do Químico
        </div>
        <div class="ass">
            Assinatura do Diretor
        </div>

    </div>

</body>

</html>
