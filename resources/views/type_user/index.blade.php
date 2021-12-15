@extends('templates.menuLayout')

@section('content')

<div class="container-fluid border container-default">
    @if (session('message'))
    <div class="alert alert-success mt-2">
        {{session('message')}}
    </div>
@endif
@if (session('error'))
<div class="alert alert-danger mt-2" role="alert">
    {{ session('error') }}
</div>
@endif
        <div class="row justify-content-between mt-4">
            <div class="col-10">
                <h4 style="font-weight: bolder">Lista de Tipos de usuários</h4>
            </div>
            <div class="col-2 text-end">
                <a href="{{ route('type_user.create') }}" style="color: black"><i class="fas fa-plus" style="color: green"></i>
                    Novo Tipo</a>
            </div>
        </div>
        <table class="table text-center">
            <thead >
                <tr class="table-primary">
                    <th scope="col">Código</th>
                    <th scope="col">Tipo de usuário</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($type_user as $type_users)
                    <tr>
                        <th scope="row">{{$type_users->id}}</th>
                        <td>{{$type_users->name}}</td>
                        <td class="text-center in-line">
                            <form method="POST" action="{{ route('type_user.destroy', $type_users->id) }}">
                                @csrf
                                @method('DELETE')
                                <a href="{{ route('type_user.edit', $type_users->id) }}"><i class="fas fa-pen"></i></a>
                                <button type="submit" class="button-none"> <i class="fas fa-trash-alt"
                                        style="color: red"></i></button>

                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    


@endsection
