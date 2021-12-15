@extends('templates.menuLayout')

@section('script')
    <script src="{{ url('assets/js/test/execute.js') }}"></script>
@endsection

@section('content')

    <div class="container-fluid border container-default p-2">
        @if (session('message'))
            <div class="alert alert-success mt-2" role="alert">
                {{ session('message') }}
            </div>
        @endif
        <div class="row">
            <div class="col">
                <h4>Informações</h4>
                <table class="table border border-secondary table-secondary">
                    <tbody>
                        <tr>
                            <th>Cliente:</th>
                            <td>{{ $client->contact_name }}</td>
                            <th>Empresa:</th>
                            <td>{{ $client->company_name }}</td>
                        </tr>
                        <tr>
                            <th>Produto:</th>
                            <td>{{ $product->description }}</td>
                            <th></th>
                            <td></td>
                        </tr>
                        <tr>
                            <th>Tipo do couro:</th>
                            <td>{{ $type_leather->name }}</td>
                            <th>Segmento:</th>
                            <td>{{ $segment->name }}</td>

                        </tr>
                        <tr>
                            <th>Numero da OP:</th>
                            <td id="op">{{ $sample->op_number }}</td>
                            <th>Data da coleta:</th>
                            <td>{{ date('d/m/Y', strtotime($sample->date_col)) }}</td>
                        </tr>

                    </tbody>
                </table>
                <form action="{{ route('test.save', $sample->op_number) }}" method="POST">
                    <div class="row justify-content-start">
                        <div class="col-md-2 form-group ">
                            <label class="text-center">Valores orientativos: </label>
                        </div>
                        <div class="col-md-3 form-group">
                            @if ($spec == false)
                                <small style="color: grey;">Valores orientativos da norma</small>
                            @else
                                <small style="color: grey;">Valores da Esp. do cliente</small>
                            @endif
                        </div>
                    </div>

                    @csrf

                    {{-- progress spinner --}}

                    <div class="row h-100 justify-content-center align-items-center mt-3" id="spinner"
                        style="display: none">
                        <div class="col-md-1">
                            <div class="lds-ring">
                                <div></div>
                                <div></div>
                                <div></div>
                                <div></div>
                            </div>
                        </div>
                    </div>
                    <div class="table-limit-execute">

                        <table class="table text-center mt-2" id="table">
                            <thead>
                                <tr class="table-secondary">
                                    <th>Código experimento</th>
                                    <th>Experimento</th>
                                    <th>Norma de referência</th>
                                    <th>Valores Orientativos</th>
                                    <th>Unid. Medida</th>
                                    <th>Valor obtido</th>
                                    <th> Desgaste</th>
                                    <th>Data</th>
                                </tr>
                            </thead>
                            <tbody id="table">
                                @foreach ($experiments as $experiment)
                                    @php
                                        if ($spec == false) {
                                            $norms = app(App\Http\Controllers\TestController::class)->searchNorm($product->id_segment, $product->id_leather_type, $experiment->id);
                                        } else {
                                            $norms = app(App\Http\Controllers\TestController::class)->searchSpec($product->id, $experiment->id);
                                        }
                                        
                                        $result_search = app(App\Http\Controllers\TestController::class)->searchResult($experiment->id, $sample->op_number);
                                        if ($experiment->id == 14 || $experiment->id == 15) {
                                            $result = explode(' ', $result_search->result);
                                        }
                                        $measure_search = new App\Models\Measure();
                                        if ($norms != null) {
                                            $measure = $measure_search::find($norms->id_uni);
                                        }
                                        
                                    @endphp

                                    <tr>
                                        <td>{{ $experiment->id }}</td>
                                        <td>{{ $experiment->name }}</td>
                                        <td id="norm">{{ $norms->name ?? 'Não definida' }}</td>
                                        <td id="min_value">{{ $norms->min_value ?? 'Não definida' }}</td>
                                        <td id="uni">{{ $measure->uni ?? 'Não definida' }}</td>
                                        <td><input type="text" placeholder="Resultado" id="result[]" name="result[]"
                                               @if(isset($result[0])) value="{{ $result[0] ?? '' }}" @else value="{{ $result_search->result ?? '' }}" @endif></td>
                                        <td>
                                            @if ($experiment->id == 14 || $experiment->id == 15)
                                                <select name="weared[]" id="weared[]">
                                                    @if (isset($result[1]))
                                                        @switch($result[1])
                                                            @case(" O")
                                                                <option value="O">Intacto</option>
                                                            @break
                                                            @case(" G")
                                                                <option value="G">Leve desgaste</option>
                                                            @break
                                                            @case(" D")
                                                                <option value="D">Desgaste</option>
                                                            @break
                                                            @case(" S")
                                                                <option value="S">Forte desgate</option>
                                                            @break
                                                            @default

                                                        @endswitch
                                                    @endif
                                                    <option value="O">Intacto</option>
                                                    <option value="G">Leve desgaste</option>
                                                    <option value="D">Desgaste</option>
                                                    <option value="S">Forte desgate</option>
                                                </select>
                                            @else
                                                <span>-</span>
                                            @endif

                                        </td>
                                        <td>
                                            <input type="date" name="date_finish[]" id="date_finish[]"
                                                value="{{ date('Y-m-d', strtotime($result_search->date_finish ?? date('Y-m-d H:i:s'))) }}">
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
            </div>
        </div>
        @if (session('errors'))
            <div class="alert alert-danger mt-2">
                {{ session('errors') }}
            </div>
        @endif
        <div class="row justify-content-between">
            <div class=" col-md-4">
                <input type="submit" class="btn btn-primary mt-2" name="submit" id="submit" value="Salvar">
                <a href="{{ route('test.finish', $sample->op_number) }}" class="btn btn-success mt-2">Finalizar</a>
            </div>
            <div class=" col-md-4 text-end">
                <a href="{{ route('test.index') }}" class="btn btn-danger mt-2">Voltar</a>
            </div>
        </div>
        </form>
    </div>

@endsection
