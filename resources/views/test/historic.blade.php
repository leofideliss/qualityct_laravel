@extends('templates.menuLayout')
@section('content')

<div class="container-fluid container-default p-2 mt-2">
    <div class="row justify-content-between">

        <div class="col-md">
            <h4 style="font-weight: bolder">Lista de testes realizados</h4>
        </div>
        <div class="col-md">
            <form method="POST" class="row row-cols-lg-auto g-3 align-items-center" action="{{route('test.searchHistoric')}}">
                @csrf
                <div class="input-group mb-2">
                    <input name="name" id="name" type="text" class="form-control" placeholder="Numero da ordem de produção" maxlength="6">
                    <button class="btn btn-outline-secondary" type="submit" id="btn-search" style="background-color:#2A2D34"><i class="fas fa-search"></i></button>
                  </div>
            </form>
        </div>
      
    </div>

    <div class="row">
        <div class="col">
        <table class="table">
            <thead>
                <tr class="table-primary">
                    <th>OP da amostra</th>
                    <th>Produto</th>
                    <th>Empresa</th>
                    <th>Data da finalização</th>
                    <th>Ações</th>
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
                    <td>{{date('d-m-Y', strtotime($sample->updated_at ))}}</td>
                    <td>
                        <a href="{{ route('test.execute', $sample->op_number) }}"><i class="fas fa-pen"></i></a>
                        <a href="{{route('test.viewpdf',$sample->op_number)}}" target="_blank"><i class="far fa-eye" style="color: black"></i></a>
                        <a href="{{route('test.downloadPdf',$sample->op_number)}}" target="_blank"><i class="fas fa-file-download" style="color:grey"></i></a>
                   
                    </td>
                    
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="d-flex justify-content-center">
            {{$samples->links()}}
        </div>
    </div>
</div>
</div>


    
@endsection