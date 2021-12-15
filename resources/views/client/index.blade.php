@extends('templates.menuLayout')

@section('content')

<div class="container-fluid border container-default">
    <div class="row justify-content-between mt-4">
        <h4 style="font-weight: bolder">Lista de clientes</h4>
        <div class="col-4">
            <form method="POST" class="row row-cols-lg-auto g-3 align-items-center" action="{{route('client.search')}}">
                @csrf
                <div class="input-group mb-2">
                    <input name="name" id="name" type="text" class="form-control" placeholder="Nome do cliente" >
                    <button class="btn btn-outline-secondary" type="submit" id="btn-search" style="background-color:#2A2D34"><i class="fas fa-search"></i></button>
                  </div>
            </form>
        </div>
        <div class="col-2 text-end">
            <a style="color: black;" href="{{ route('client.create') }}"><i class="fas fa-plus" style="color: green"></i>
                Novo cliente</a>
        </div>
    </div>
    <table class="table">
        @csrf
        <thead class="text-center">
            <tr class="table-primary">
                <th scope="col">Código</th>
                <th scope="col">Contato</th>
                <th scope="col">Email</th>
                <th scope="col">Nome da empresa</th>
                <th scope="col">CNPJ</th>
                <th scope="col" class="text-center">Ações</th>
            </tr>
        </thead>
        <tbody class="text-center">
            @foreach ($client as $clients)
            <tr>
                <th scope="row">{{$clients->id}}</th>
                <td>{{$clients->contact_name}}</td>
                <td>{{$clients->email}}</td>
                <td>{{$clients->company_name}}</td>
                <td>{{$clients->CNPJ}}</td>
                <td class="text-center in-line">
                    <form method="POST" action="{{ route("client.destroy",$clients->id)}}">
                    <a href="{{  route("client.show",$clients->id)}}"><i class="fas fa-eye" style="color: black"></i></a>
                    <a href="{{ url("client/$clients->id/edit") }}"><i class="fas fa-pen"></i></a>
@csrf
@method('DELETE')
                 <button class="button-none">  <i class="fas fa-trash-alt"
                            style="color: red"></i></button>
                        </form>
                </td>
            </tr>
            @endforeach

        </tbody>
    </table>
    <div class="d-flex justify-content-center">
        {!! $client->links() !!}
    </div>
</div>



@endsection