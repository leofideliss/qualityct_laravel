@extends('templates.menuLayout')

@section('content')
    <div class="col-sm mt-2 p-2 container-default">
        <h3>Endereços</h3>
        <table class="table">
            <thead>
                <tr class="text-center">
                    <th scope="col">Codigo</th>
                    <th scope="col">Estado</th>
                    <th scope="col">Cidade</th>
                    <th scope="col">Rua</th>
                    <th scope="col">Numero</th>
                    <th scope="col">Complemento</th>
                    <th scope="col">CEP</th>
                    <th colspan="2" scope="col">Ações</th>
                </tr>
            </thead>
            <tbody class="text-center">
                @foreach ($address as $addresses)
                @php
                    $state = New App\Models\State;
                    $states = $state->find($addresses->id_state);

                    $city = New App\Models\Cities;
                    $cities = $city->find($addresses->id_city);
                @endphp
                    <tr>
                        <th scope="row">{{$addresses->id}}</th>
                        <td>{{$states->name}}</td>
                        <td>{{$cities->name}}</td>
                        <td>{{$addresses->street}}</td>
                        <td>{{$addresses->number}}</td>
                        <td>{{$addresses->complements}}</td>
                        <td>{{$addresses->CEP}}</td>
                        <td><a  href="{{url("address/$addresses->id/edit")}}" class="btn btn-success">Editar</a></td>
                        <td><a  href="{{url("address/$addresses->id")}}" class="btn btn-danger js-del">Excluir</a></td>             
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>

    <a href="{{route('address.create')}}" class="btn btn-primary mt-2">Cadastrar</a>
@endsection