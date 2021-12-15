@extends('templates.menuLayout')

@section('content')
    <div class="container-fluid border container-default">
        <div class="row justify-content-between mt-4">
            <div class="col-10">
                <h4 style="font-weight: bolder">Lista de cidades</h4>
            </div>
            <div class="col-2">
                <a href="{{ route('city.create') }}" style="color: black"><i class="fas fa-plus"
                        style="color: green"></i> Nova cidade</a>
            </div>
        </div>
        <table class="table">
            <thead>
                <tr class="table-primary">
                    <th scope="col">Codigo</th>
                    <th scope="col">Cidade</th>
                    <th scope="col">Estado</th>
                    <th scope="col" class="text-center">Ações</th>
                </tr>
            </thead>
            <tbody class="">
                @foreach ($city as $cities)
                    @php
                        $state = new App\Models\State();
                        $states = $state->find($cities->id_state);
                    @endphp
                    <tr>
                        <th scope="row">{{ $cities->id }}</th>
                        <td>{{ $cities->name }}</td>
                        <td>{{ $states->name }}</td>
                        <td class="text-center">
                            <a href=""><i class="fas fa-eye" style="color: black"></i></a>
                            <a href="{{ url("city/$cities->id/edit") }}"><i class="fas fa-pen"></i></a>

                            <a class="js-del" href="{{ url("city/$cities->id") }}"><i class="fas fa-trash-alt"
                                    style="color: red"></i></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="d-flex justify-content-center">
            {!! $city->links() !!}
        </div>
    </div>
@endsection
