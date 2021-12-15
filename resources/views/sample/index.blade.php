@extends('templates.menuLayout')

@section('content')
<div class="container-fluid border container-default">
    <div class="row justify-content-between mt-4">
        <h4 style="font-weight: bolder">Lista de amostras</h4>
        <div class="col-4">
            <form method="POST" class="row row-cols-lg-auto g-3 align-items-center"
                action="{{ route('sample.search') }}">
                @csrf
                <div class="input-group mb-2">
                    <input name="name" id="name" type="text" class="form-control" placeholder="Nº da OP" maxlength="6">
                    <button class="btn btn-outline-secondary" type="submit" id="btn-search"
                        style="background-color:#2A2D34"><i class="fas fa-search"></i></button>
                </div>
            </form>
        </div>
        <div class="col-2">
            <a href="{{ route('sample.create') }}" style="color: black"><i class="fas fa-plus" style="color: green"></i>
                Nova amostra</a>
        </div>
    </div>
    @if (session('message'))
    <div class="alert alert-success mt-2">
        {{ session('message') }}
    </div>
    @endif
    @if (session('alert'))
    <div class="alert alert-waring mt-2">
        {{ session('alert') }}
    </div>
    @endif
    <table class="table">
        <thead>
            <tr class="table-primary">
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
            $product_search = new App\Models\Products;
            $client_search = new App\Models\Clients;

            $product_result = $product_search->find($sample->id_product);
            $client_result = $client_search->find($sample->id_client);
            @endphp
            <tr>

                <td>{{$sample->op_number}}</td>
                <td>{{$product_result->description}}</td>
                <td>{{$client_result->contact_name}}</td>
                <td>{{date('d-m-Y', strtotime($sample->date_col))}}</td>
                <td>@if ($sample->status == 'nao definido')
                    <a href="{{route('test.select',$sample->op_number)}}" style="color: black"> <i class="fas fa-check"
                            style="color: green"></i>Selecionar experimentos</a>
                    @else
                    @if ($sample->status == 'finalizado')
                        <span style="font-weight: bolder">Finalizado</span>
                    @else
                    <span style="color: black"> <i class="far fa-clock" style="color: grey"></i> Em andamento...</span>
                    @endif

                    @endif</td>
                <td class="text-center in-line">
                    <form method="POST" action="{{ route("sample.destroy",$sample->op_number)}}">
                        {{-- <a href="{{  route("sample.show",$sample->op_number)}}"><i class="fas fa-eye"
                                style="color: black"></i></a> --}}
                        <a href="{{ url("sample/$sample->op_number/edit") }}"><i class="fas fa-pen"></i></a>
                        @csrf
                        @method('DELETE')
                        <button class="button-none"> <i class="fas fa-trash-alt" style="color: red"></i></button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-center">
        {!! $samples->links() !!}
    </div>
</div>

</div>

</div>
@endsection