@extends('templates.menuLayout')

@section('content')
    <div class="container-default p-2 col-md-6">
        <div class="row justify-content-start">
            <div class="col-md form group">
                @if (isset($measure))
                    <form method="POST" action="{{ route('measure.update', $measure->id) }}">
                        @method('PUT')
                    @else
                        <form method="POST" action="{{ route('measure.store') }}">
                @endif
                @csrf
                <label for="uni">Uni. de Medida</label>
                <input class="form-control" type="text" name="uni" id="uni" placeholder="Ex: Centímetros (CM)"
                    value="{{ $measure->uni ?? '' }}">
                <small>Adicionar abreviação (??)</small>

            </div>
        </div>
        <div class="row justify-content-between mt-2">
            <div class="col-md-4">
                <button class="btn btn-primary" type="submit">
                    @if (isset($measure)) Editar @else Cadastrar @endif
                </button>
            </div>
            <div class="col-md-4 text-end">
                <a href="{{ route('measure.index') }}" class="btn btn-danger mt2-">Voltar</a>
            </div>
        </div>
        </form>
    </div>
@endsection
