@extends('templates.menuLayout')

@section('content')
    <div class="content-fluid container-default p-2 col-sm-6">
        <div class="row">
            <h4>
                @if (isset($experiments)) Editar @else Cadastrar @endif experimento
            </h4>
        </div>
        <div class="row">
            @if (isset($experiment))
                <form method="POST" action="{{ route('experiment.update', $experiment->id) }}" name="formEdit" id="formEdit">
                    @method('PUT')
                @else
                    <form method="POST" action="{{route('experiment.store') }}" name="formCad" id="formCad">
            @endif
            @csrf
            <div class="form-group col-sm">
                @php
                    if (isset($experiment)) {
                        $leather_search = new App\Models\Leather_type();
                        $leather_type_result = $leather_search->find($experiment->id_leather_type);
                    }
                @endphp
                <label for="id_leather_type">Tipo do couro</label>
                <select name="id_leather_type" class="form-control" id="id_leather_type">
                    <option value="{{ $leather_type_result->id ?? '' }}">{{ $leather_type_result->name ?? 'Selecione' }}
                    </option>
                    @foreach ($leather_types as $leather_type)
                        <option value="{{ $leather_type->id }}">{{ $leather_type->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-sm">
                <label for="name">Nome do experimento</label>
                <input class="form-control" type="text" name="name" id="name" placeholder="Ex: Escala de cinza" value="{{$experiment->name ?? ''}}">
            </div>
            <div class="row justify-content-between">
                <div class=" col-4">
                    <input type="submit" class="btn btn-primary mt-2" name="submit" id="submit" value=" @if (isset($experiment)) Editar @else Cadastrar @endif ">
                        </div>
                        <div class=" col-4 text-end">
                    <a href="{{ route('experiment.index') }}" class="btn btn-danger mt-2">Cancelar</a>
                </div>
            </div>
            </form>
        </div>
    </div>
@endsection
