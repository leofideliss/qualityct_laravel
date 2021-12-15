@extends('templates.menuLayout')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-4 p-2 container-default">
                @if (isset($state))
                    <form action="{{ url("state/$state->id") }}" method="POST">
                        @method('PUT')
                    @else
                        <form action="{{ url('state') }}" method="POST">
                @endif
                @csrf

                <div class="row">

                    <div class="form-group">
                        <h4>
                            @if (isset($state)) Editar @else Cadastrar @endif Estado
                        </h4>
                        <label for="name">Estado</label>
                        <input type="text" class="form-control" name="name" id="name" placeholder="Ex: São Paulo"
                            value="{{ $state->name ?? '' }}" required>

                    </div>
                </div>
                <div class="row">

                    <div class="form-group">

                        <input type="submit" class="form-control btn-primary mt-2" name="submit" id="submit"
                            value=" @if (isset($state)) Editar @else Cadastrar @endif ">
                        </div>
                
                    </div>
                </form>
            </div>
            </div>
            </div>
     
@endsection
