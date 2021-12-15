@extends('templates.menuLayout')

@section('content')
<div class="container-fluid border container-default table-limit">
    @if (session('alert'))
    <div class="alert alert-success mt-2" role="alert">
        {{ session('alert') }}
    </div>
    @endif
    @if (session('message'))
    <div class="alert alert-success mt-2" role="alert">
        {{ session('message') }}
    </div>
    @endif
    <div class="col-4 mt-2">
        <form method="POST" class="row row-cols-lg-auto g-3 align-items-center" action="{{ route('test.search') }}">
            @csrf
            <div class="input-group mb-2">
                <input name="name" id="name" type="text" class="form-control" placeholder="Numero da Ordem de produção" maxlength="6">
                <button class="btn btn-outline-secondary" type="submit" id="btn-search"
                    style="background-color:#2A2D34"><i class="fas fa-search"></i></button>
            </div>
        </form>
    </div>
    <div class="row">
        <div class="col mt-2">
            <div>
                @if (isset($data))
                @foreach ($data as $test)
                <table class="table table-bordered table-test">
                    <tbody>
                        <tr style="background-color: #2980B9; color: white">
                            <th>Ordem de produção:</th>
                            <td>{{ $test['op_number'] }}</td>
                        </tr>
                        <tr>
                            <th>Produto:</th>
                            <td>{{ $test['description'] }}</td>
                        </tr>
                        <tr>
                            <th>Cliente:</th>
                            <td>{{ $test['client'] }}</td>
                        </tr>
                        <tr>
                            <th>Experimentos:</th>
                            <td>
                                <ul>
                                    @php
                                    $continue = 0;
                                    @endphp

                                    @foreach ($test['experiments'] as $experiments)


                                    <li>
                                        {{ $experiments['name'] }}
                                        @if ($experiments['status'] == 0)
                                        (em análise)
                                        @else
                                        @php
                                        $continue++;
                                        @endphp
                                        <i class="fas fa-check" style="color: green"></i>
                                        @endif

                                    </li>
                                    @endforeach


                                </ul>
                            </td>
                        </tr>
                        <tr>

                            <td colspan="2">
                                <a href="{{ route('test.execute', $test['op_number']) }}" class="btn btn-success">
                                    @if ($continue != 0) Continuar @else Inciar @endif
                                </a>
                                <a href="{{ route('test.editExperiments', $test['op_number']) }}" class="btn btn-primary">
                                   Editar
                                </a>
                                <form action="{{ route('test.destroy', $test['op_number']) }}" method="POST"
                                    name="fomrDelete" id="formDelete" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger" type="submit">Excluir</button>
                                </form>
                            </td>
                        </tr>
                    </tbody>
                </table>
                @endforeach
            </div>
            @else
            <div class="alert alert-light text-center" role="alert">
                Não há testes...
            </div>
            @endif
        </div>
    </div>
    @if (isset($data))
    <div class="d-flex justify-content-center">
        {{ $data->links() }}
    </div>
    @endif

</div>
@endsection