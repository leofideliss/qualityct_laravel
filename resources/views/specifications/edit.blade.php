@extends('templates.menuLayout')



@section('content')

<div class="container-fluid mt-2 p-2 container-default">
    <div class="row">
        <div class="col">
            <h3>Cadastrar Especificação</h3>
        </div>
    </div>
    @if (isset($specification))
    <form action="{{route('specifications.update',$specification->id_product)}}" method="POST" id="formEdit"
        name="formEdit">
        @method('PUT')
        @else
        <form action="{{route('specifications.store')}}" method="POST" id="formCad" name="formCad">
            @endif
            @csrf
            @php
            if (isset($specification)) {
            $client_search = new App\Models\Clients();
            $client_result = $client_search->find($specification->id_client);

            $product_search = new App\Models\Products();
            $product_result = $product_search->find($specification->id_product);
            }
            @endphp
            <div class="row">
                <div class="form-group col-sm">
                    <label for="id_client">Cliente *</label>
                    <select class="form-control" name="id_client" id="id_client" disabled>
                        <option value="{{ $client_result->id ?? '' }}">
                            {{ $client_result->contact_name ?? '--- Selecione ---' }}
                        </option>
                        @foreach ($clients as $client)
                        <option value="{{ $client->id }}">{{ $client->contact_name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group col-sm">
                    <label for="id_product">Produto *</label>
                    <select class="form-control" name="id_product" id="id_product" disabled>
                        <option value="{{ $product_result->id ?? '' }}">
                            {{ $product_result->description ?? '--- Selecione o Cliente ---' }}</option>
                        @foreach ($products as $product)
                        <option value="{{ $product->id }}">{{ $product->description }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col">
                    <div style="max-height: 320px;overflow-y: auto;">
                        <table class="table">
                            <thead class="table-primary">
                                <th scope="col">Código</th>
                                <th scope="col">Experimento</th>
                                <th scope="col">Condição do cliente</th>
                                <th scope="col">Parâmetros do valor</th>
                            </thead>
                         
                            <tbody id="tableExperiments">
                                @php
                                $spec =
                                app(App\Http\Controllers\SpecificationsController::class)->searchSpecifications($specification->id_product);
                                $measure_search = new App\Models\Measure();
                               @endphp
                                @for ($i = 0; $i < count($spec); $i++) <tr>
                                    <td>{{$spec[$i]->id_experiment}}</td>
                                    <td>{{$spec[$i]->name}}</td>
                                    <td><input name="min_value[]" id="min_value[]" type="text" placeholder="Ex: >125" class="form-control"
                                            value="{{$spec[$i]->min_value}}"></td>
                                    <td> <select name="uni[]" id="uni[]" class="form-control">
                                        {{$measure = $measure_search->find($spec[$i]->id_uni)}}
                                            <option value="{{$measure->id}}">{{$measure->uni}}</option>
                                            @foreach ($measures as $value)
                                            <option value="{{$value->id}}">{{$value->uni}}</option>
                                        @endforeach
                                        </select></td>
                                    </tr>
                                    @endfor
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row justify-content-between">
                <div class=" col-4">
                    <input type="submit" class="btn btn-primary mt-2" name="submit" id="submit"
                        value=" @if (isset($specification)) Editar @else Cadastrar @endif ">
                </div>
                <div class=" col-4 text-end">
                    <a href="{{ route('specifications.index') }}" class="btn btn-danger mt-2">Cancelar</a>
                </div>
            </div>
        </form>
</div>
@endsection