@extends('templates.menuLayout')

@section('content')
<div class="container-fluid border container-default ">
    <div class="row justify-content-between mt-4">
        <h4>Normas de referência</h4>
        <div class="col-4">
            <form method="POST" class="row row-cols-lg-auto g-3 align-items-center" action="{{ route('norm.search') }}">
                @csrf
                <div class="input-group mb-2">
                    <input name="name" id="name" type="text" class="form-control" placeholder="Norma">
                    <button class="btn btn-outline-secondary" type="submit" id="btn-search"
                        style="background-color:#2A2D34"><i class="fas fa-search"></i></button>
                </div>
            </form>
        </div>
        <div class="col-2 text-end">
            <a href="{{ route('norm.create') }}" style="color: black"><i class="fas fa-plus" style="color: green"></i>Nova norma</a>
        </div>
    </div>
        <!-- alerta de arquivo de norma não encontrado -->
    <div class="row">
        <div class="col">
            @if (session('file_not_found'))
            <div class="alert alert-danger mt-2">
                {{ session('file_not_found') }}
            </div>
            @endif
        </div>
    </div>
    <!-- alerta de registro adicionado ou alterado -->
    <div class="row">
        <div class="col">
            @if (session('message'))
            <div class="alert alert-success mt-2">
                {{ session('message') }}
            </div>
            @endif
        </div>
    </div>
    <!-- alerta de registro excluido -->
    <div class="row">
        <div class="col">
            @if (session('deleted'))
            <div class="alert alert-warning mt-2" role="alert">
                {{ session('deleted') }}
            </div>
            @endif
        </div>
    </div>

    <div class="row">
        <div class="col">
            <table class="table">
                <thead>
                    <tr class="table-primary">
                        <th>Norma</th>
                        <th style="width: 5px">Experimento</th>
                        <th>Valores</th>
                        <th>Unid. Medida</th>
                        <th>Tipo do couro</th>
                        <th>Segmento</th>
                        <th class="text-center">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($norms as $norm)
                    @php
                    $segment_search = new App\Models\Segment();
                    $leather_search = new App\Models\Leather_type();
                    $experiment_search = new App\Models\Experiment();
                    $measure_search = new App\Models\Measure();

                    $segment = $segment_search->find($norm->id_segment);
                    $leather_type = $leather_search->find($norm->id_leather_type);
                    $experiment = $experiment_search->find($norm->id_experiment);
                    $measure = $measure_search->find($norm->id_uni);
                    @endphp
                    <tr>
                        <td>{{ $norm->name }}</td>
                        <td>{{ $experiment->name }}</td>
                        <td>{{ $norm->min_value }}</td>
                        <td>{{ $measure->uni }}</td>
                        <td>{{ $leather_type->name }}</td>
                        <td>{{ $segment->name }}</td>
                     
                        <td class="text-center in-line">
                            <form method="POST" action="{{ route('norm.destroy', $norm->id) }}">
                                <a href="{{ route('norm.show', $norm->id) }}" target="_blank" ><i class="fas fa-eye"
                                        style="color: black"></i></a>

                                <a href="{{ route('norm.edit',$norm->id) }}" ><i class="fas fa-pen"></i></a>
                                @csrf
                                @method('DELETE')
                                <button class="button-none"> <i class="fas fa-trash-alt"
                                        style="color: red"></i></button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-center">
            {!! $norms->links() !!}
        </div>
    </div>

</div>
@endsection