@extends('templates.menuLayout')

@section('content')
    <div class="container-fluid container-default">
        <div class="row justify-content-center">
            <div class="mt-4 col-md-4 text-center h-100 d-flex flex-column justify-content-center align-items-center">
                <p >Bem vindo ao QualityCT !</p>
                <a href="{{ route('sample.create') }}" class="btn btn-success"><i class="fas fa-flask"></i>Iniciar novo
                    teste</a>
            </div>
        </div>

        <div class="row mt-5" >
            <div class="col h-100">
                <h5>Aguardando a seleção dos experimentos : </h5>
                <hr class="dropdown-divider">
                <div class="table-limit-home">
                    
                <table class="table table-striped ">
                    <thead>
                        <tr>

                            <th>Ordem Produção</th>
                            <th>Produto</th>
                            <th>Empresa</th>
                            <th>Data da coleta</th>
                            <th>Status</th>
                            <th class="text-center">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($samples as $sample)
                            @php
                                $product_search = new App\Models\Products();
                                $client_search = new App\Models\Clients();
                                
                                $product_result = $product_search->find($sample->id_product);
                                $client_result = $client_search->find($sample->id_client);
                            @endphp
                            <tr>

                                <td>{{ $sample->op_number }}</td>
                                <td>{{ $product_result->description }}</td>
                                <td>{{ $client_result->contact_name }}</td>
                                <td>{{ date('d-m-Y', strtotime($sample->date_col)) }}</td>
                                <td>
                                    @if ($sample->status == 'nao definido')
                                        <a href="{{ route('test.select', $sample->op_number) }}" style="color: black"> <i
                                                class="fas fa-check" style="color: green"></i>Selecionar experimentos</a>
                                    @else
                                        @if ($sample->status == 'finalizado')
                                            <a href="#"><i class="fas fa-file-download"
                                                    style="color:grey"></i>Finalizado</a>
                                        @else
                                            <span style="color: black"> <i class="far fa-clock" style="color: grey"></i> Em
                                                andamento...</span>
                                        @endif

                                    @endif
                                </td>
                                <td class="text-center in-line">
                                    <form method="POST" action="{{ route('sample.destroy', $sample->op_number) }}">
                                        {{-- <a href="{{  route("sample.show",$sample->op_number)}}"><i class="fas fa-eye"
                                        style="color: black"></i></a> --}}
                                        <a href="{{ url("sample/$sample->op_number/edit") }}"><i
                                                class="fas fa-pen"></i></a>
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
            </div>
        </div>

    </div>
@endsection
