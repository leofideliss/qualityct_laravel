@extends('templates.menuLayout')

@section('content')

<div class="container-fluid border container-default">
    <div class="row justify-content-between mt-4">
        <h4 style="font-weight: bolder">Lista de clientes</h4>
        <div class="col-4">
            <form method="POST" class="row row-cols-lg-auto g-3 align-items-center"
                action="{{ route('specifications.search') }}">
                @csrf
                <div class="input-group mb-2">
                    <input name="name" id="name" type="text" class="form-control" placeholder="Nome do cliente">
                    <button class="btn btn-outline-secondary" type="submit" id="btn-search"
                        style="background-color:#2A2D34"><i class="fas fa-search"></i></button>
                </div>
            </form>
        </div>
        <div class="col-3 text-end">
            <a href="{{ route('specifications.create') }}" style="color: black"><i class="fas fa-plus"
                    style="color: green"></i>
                Definir Esp. Cliente</a>
        </div>
    </div>
    <table class="table">
        @csrf
        <thead class="text-center">
            <tr class="table-primary">
                <th scope="col">Código</th>
                <th scope="col">Nome da empresa</th>
                <th scope="col">Contato</th>
                <th scope="col">Produto</th>
                <th scope="col" class="text-center">Ações</th>
            </tr>
        </thead>
        <tbody class="text-center">
            

                @foreach ($data as $products)
                @if (isset($products->id_client))
                @php
                $client_search = new App\Models\Clients();
                $client_result = $client_search->find($products->id_client);
                @endphp
                <tr>
                    <th scope="row">{{ $client_result->id }}</th>
                    <td>{{ $client_result->company_name }}</td>
                    <td>{{ $client_result->contact_name }}</td>
                    <td>{{ $products->description }}</td>
                    <td class="text-center in-line">
                        <form method="POST" action="{{ route('specifications.destroy', $products->id) }}">

                            <a class="" href="{{ url("specifications/$products->id/edit") }}" > <i class="fas fa-pen"></i></a>
                            @csrf
                            @method('DELETE')
                            <button class="button-none">  <i class="fas fa-trash-alt" style="color: red"></i></button>
                        </form>
                    </td>
                </tr>
                @endif
                @endforeach

      

        </tbody>
    </table>
    <div class="d-flex justify-content-center">
        {{ $data->links() }}
    </div>
</div>

@endsection