@extends('templates.menuLayout')

@section('content')

<div class="container">

    <div class="container-default col-4 p-2 mt-2">
            @if (isset($city))
                <form name="formEdit" id="formEdit" action="{{ url("city/$city->id") }}" method="POST">
                    @method('PUT')
            @else
                <form name="formCad" id="formCad" action="{{ url('city') }}" method="POST">
            @endif

            @csrf

            <div class="row">
                
                <div class="form-group">
                   
                        <h3>
                            @if (isset($city)) Editar @else Cadastrar @endif Cidade
                        </h3>
                        <label for="name">Cidade</label>
                    <input type="text" class="form-control" name="name" id="name" placeholder="Cidade"
                        value="{{ $city->name ?? '' }}" required>
                </div>

            </div>
            <div class="row">
                @php
                    if (isset($city)) {
                        $state2 = new App\Models\State();
                        $state2 = $state->find($city->id_state);
                    }
                @endphp
                <div class="form-group mt-2">
                    <label for="id_state">Estado</label>
                    <select class="form-control" id="exampleFormControlSelect1" name="id_state" id="id_state">
                        <option value="{{ $state2->id ?? '' }}">{{ $state2->name ?? 'Estado' }} </option>
                        @foreach ($state as $states)
                            <option value="{{ $states->id }}">{{ $states->name }}</option>
                        @endforeach
                    </select>
                </div>

            </div>
            <div class="row">
                <div class="form-group">

                    <input type="submit" class="form-control btn-primary mt-2" name="submit" id="submit" value=" @if (isset($city)) Editar @else Cadastrar @endif ">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
@endsection
