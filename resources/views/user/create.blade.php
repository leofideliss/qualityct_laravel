@extends('templates.menuLayout')

@section('content')
    <div class="container-default col-8 m-2 p-2">
        <div class="container">
            @if (isset($user))
                <form name="formEdit" id="formEdit" action="{{ route('user.update', $user->id) }}" method="POST">
                    @method('PUT')
                @else
                    <form name="formCad" id="formCad" action="{{ route('user.store') }}" method="POST">
            @endif
            @csrf
            <h3>
                @if (isset($user)) Editar @else Cadastrar @endif
                Usuário
            </h3>

            <div class="row">
                <div class="form-group col-sm">
                    <label for="login">Nome</label>
                    <input type="text" id="login" name="login" class="form-control" placeholder="Nome"
                        value="{{ $user->login ?? '' }}">
                </div>
            </div>
            <div class="row mt-2">
                <div class="form-group col-sm">
                    <label for="email">Email</label>
                    <input type="text" id="email" name="email" class="form-control" placeholder="Email"
                        value="{{ $user->email ?? '' }}">
                </div>
            </div>
            <div class="row mt-2">
                <div class="form-group col-sm">
                    <label for="password">Senha</label>
                    <input type="text" id="password" name="password" class="form-control" placeholder="Senha">
                </div>
            </div>
            <div class="row mt-2">
                <div class="form-group col-sm">
                    <label for="password_confirm">Confirmar Senha</label>
                    <input type="text" id="password_confirm" name="password_confirm" class="form-control"
                        placeholder="Confirmar senha">
                </div>
            </div>
            @php
                if (isset($user)) {
                    $type_user_search = new App\Models\Type_user();
                    $type_user_result = $type_user_search->find($user->id_type_user);
                }
            @endphp
            <div class="row mt-2">
                <div class="form-group">
                    <label for="id_type_user">Tipo de usuário</label>
                    <select name="id_type_user" id="id_type_user" class="form-control">
                        <option value="{{ $type_user_result->id ?? '' }}">
                            {{ $type_user_result->name ?? 'Tipo de usuário' }}</option>
                        @foreach ($type_users as $type_user)
                            <option value="{{ $type_user->id ?? '' }}">{{ $type_user->name ?? '' }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="row justify-content-between">
                <div class="col-3 form-group">
                    <button type="submit" class="form-control btn-primary mt-2" name="submit" id="submit">
                        @if (isset($user)) Editar @else Cadastrar @endif
                    </button>
                </div>
                <div class="col-3 form-group text-end mt-2">
                    <a class="btn btn-danger" href="{{ route('user.index') }}">Cancelar</a>
                </div>
                </form>
            </div>
        </div>
    @endsection
