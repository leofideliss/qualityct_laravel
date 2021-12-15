@extends('templates.menuLayout')

@section('content')


    <div class="container-fluid border container-default">

        @if (session('message'))
            <div class="alert alert-success mt-2" role="alert">
                {{ session('message') }}
            </div>
        @endif
        @if (session('error'))
        <div class="alert alert-danger mt-2" role="alert">
            {{ session('error') }}
        </div>
    @endif
        <div class="row justify-content-between mt-4">
            <div class="col-10">
                <h4 style="font-weight: bolder">Lista de Usuários</h4>
            </div>
            <div class="col-2">
                <a href="{{ route('user.create') }}" style="color: black"><i class="fas fa-plus" style="color: green"></i>
                    Novo usuário</a>
            </div>
        </div>
        <div class="row justify-content-end mt-2 p-2">
            <table class="table ">
                <thead>
                    <tr class="table-primary">
                        <th scope="col">Código</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Tipo</th>
                        <th scope="col" class="text-center">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($user as $users)
                        @php
                            $type_user_search = new App\Models\Type_user();
                            $type_user = $type_user_search->find($users->id_type_user);
                        @endphp
                        <tr>
                            <th scope="row">{{ $users->id }}</th>
                            <td>{{ $users->login }}</td>
                            <td>{{ $type_user->name }}</td>
                            <td class="text-center in-line">
                                <form method="POST" action="{{ route('user.destroy', $users->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <a href="{{ route('user.edit', $users->id) }}"><i class="fas fa-pen"></i></a>
                                    <button type="submit" class="button-none"> <i class="fas fa-trash-alt"
                                            style="color: red"></i></button>

                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection
