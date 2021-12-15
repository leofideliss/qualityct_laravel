@extends('templates.menuLayout')

@section('script')
    <script src="{{ url('assets/js/test/selectExperiments.js') }}"></script>
@endsection


@section('content')
    <div class="container-fluid border container-default p-2">
        @if (session('message'))

            <div class="alert alert-success mt-1" role="alert">
                {{ session('message') }}
            </div>

        @endif

        @if (session('alert'))
            <div class="alert alert-danger mt-1" role="alert">
                {{ session('alert') }}
            </div>
        @endif

        <div class="row">
            <div class="col">
                <h4>Informações</h4>
                <table class="table border border-secondary table-secondary">
                    <tbody>
                        <tr>
                            <th>Cliente:</th>
                            <td>{{ $client->contact_name }}</td>
                            <th>Empresa:</th>
                            <td>{{ $client->company_name }}</td>
                        </tr>
                        <tr>
                            <th>Produto:</th>
                            <td>{{ $product->description }}</td>
                            <th></th>
                            <td></td>
                        </tr>
                        <tr>
                            <th>Tipo do couro:</th>
                            <td>{{ $type_leather->name }}</td>
                            <th>Segmento:</th>
                            <td>{{ $segment->name }}</td>

                        </tr>
                        <tr>
                            <th>Numero da OP:</th>
                            <td id="op_number">{{ $sample->op_number }}</td>
                            <th>Data da coleta:</th>
                            <td>{{ date('d/m/Y', strtotime($sample->date_col)) }}</td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <h4>Experimentos recomendados</h4>
        </div>
        <div class="row justify-content-between">
            <div class="col-md-4">
                @if (isset($exp_selected))
                    <form method="POST" action="{{ route('test.updateExperiments', $sample->op_number) }}"
                        name="formEdit" id="formEdit">
                        @method('PUT')
                    @else
                        <form method="POST" action="{{ route('test.setExperiments', $sample->op_number) }}"
                            name="formCad" id="formCad">
                @endif

                @csrf
                @foreach ($experiments as $experiment)
                    <div class="d-block mt-1">
                        <input type="checkbox" name="experiments[]" id="experiments" value="{{ $experiment->id }}">
                        <label for="experiments[]">{{ $experiment->name }}</label>
                    </div>
                @endforeach


            </div>
            <div class="col-md-6">
                @if (isset($exp_selected))
                    <div class="alert alert-secondary" role="alert">
                        <p><i class="fas fa-exclamation-triangle" style="color: red; font-size: 15pt"></i>Atenção !</p>
                        <hr>
                        <p>Remover experimentos selecionados anteriormente também apagará os seus respectivos resultados.
                        </p>
                    </div>
                @endif
            </div>

      
            
        </div>
        <div class="row justify-content-between">
            <div class="col-md-4">
                <button type="submit" class="btn btn-primary mt-2">
                @if (isset($exp_selected)) Alterar experimentos @else Definir
                        experimentos @endif
                </button>
            </div>
            <div class="col-md-4 text-end">
                @if (isset($exp_selected))
                    <a href="{{ route('test.index') }}" class="btn btn-danger">Voltar</a>
                @else
                    <a href="{{ route('sample.index') }}" class="btn btn-danger">Voltar</a>
                @endif
            </div>
        </div>
    </form>
    </div>
@endsection
