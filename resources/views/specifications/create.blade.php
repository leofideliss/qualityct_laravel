@extends('templates.menuLayout')

@section('script')
    <script src="{{ url('assets/js/specification/create.js') }}"></script>
@endsection

@section('content')

    <div class="container-fluid mt-2 p-2 container-default">
        @if (session('msg'))
            <div class="alert alert-danger" role="alert">

                {{ session('msg') }}

            </div>
        @endif

        @if ($errors->all())
        <div class="alert alert-danger mt-1" role="alert">
            @foreach ($errors->all() as $error)
              
                    {{ $error }}
    
            @endforeach
        </div>
        @endif
        <div class="row">
            <div class="col">
                <h3>Cadastrar Especificação</h3>
            </div>
        </div>
        @if (isset($specification))
            <form action="{{ route('specifications.update', $specification->id) }}" method="POST" id="formEdit"
                name="formEdit">
                @method('PUT')
            @else
                <form action="{{ route('specifications.store') }}" method="POST" id="formCad" name="formCad">
        @endif
        @csrf
        @php
            if (isset($specification)) {
                $client_search = new App\Models\Clients();
                $client_result = $client_search->find($sample->id_client);
            
                $product_search = new App\Models\Products();
                $product_result = $product_search->find($sample->id_product);
            }
        @endphp
        <div class="row">
            <div class="form-group col-sm">
                <label for="id_client">Cliente *</label>
                <select class="form-control" name="id_client" id="id_client">
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
                <select class="form-control" name="id_product" id="id_product">
                    <option value="{{ $product_result->id ?? '' }}">
                        {{ $product_result->description ?? '--- Selecione o Cliente ---' }}</option>

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
                            {{-- <td><label for="experiments">Experimento</label></td>
                        <td><input type="text" placeholder="Ex: >125" class="form-control"></td>
                        <td> <select name="uni" id="uni" class="form-control">
                                <option value="{{ $norm->uni ?? '' }}">{{ $norm->uni ?? 'Selecione' }}</option>
                                <option value="Quilograma-força(Kgf)">Quilograma-força (Kgf)</option>
                                <option value="Newtons (N)">Newtons (N)</option>
                                <option value="Porcentagem (%)">Porcentagem (%)</option>
                            </select></td> --}}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="row justify-content-between">
            <div class=" col-4">
                <input type="submit" class="btn btn-primary mt-2" name="submit" id="submit" value=" @if (isset($specification)) Editar @else Cadastrar @endif ">
                            </div>
                            <div class=" col-4 text-end">
                <a href="{{ route('specifications.index') }}" class="btn btn-danger mt-2">Cancelar</a>
            </div>
        </div>
        </form>
    </div>
@endsection
