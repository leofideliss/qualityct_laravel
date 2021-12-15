@extends('templates.menuLayout')

@section('content')
<div class="container-fluid col-md container-default p-2" >
    <div class="row justify-content-start p-2" >

            <h3>Informações do cliente</h3>
            <table class="table ">
                <tbody>
                    <tr>
                        <th>Código:</th>
                        <td>{{ $client->id }}</td>
                    </tr>
                    <tr>
                        <th>Nome da empresa:</th>
                        <td>{{ $client->company_name }}</td>
                    </tr>
                    <tr>
                        <th>CNPJ:</th>
                        <td>{{ $client->CNPJ }}</td>
                    </tr>
                    <tr>
                        <th>Contato:</th>
                        <td>{{ $client->contact_name }}</td>
                    </tr>
                    <tr>
                        <th>Email:</th>
                        <td>{{ $client->email }}</td>
                    </tr>
                    <tr>
                        <th>Telefone:</th>
                        <td>{{ $client->phone }}</td>
                    </tr>
                </tbody>
            </table>
    
    </div>
    <div class="row justify-content-between">
        <div class="col-md-4">
            <h3>Produtos</h3>
        </div>
        <div class="col-md-4 text-end">
            <a style="color: black;" href="{{url("client/$client->id/products/create")}}"><i class="fas fa-plus" style="color: green"></i>Novo produto</a>
        </div>
    </div>
    <div class="row justify-content-start">
     <div class="col-md">
  
            <table class="table text-center">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>código</th>
                        <th>Descrição</th>
                        <th>Segmento</th>
                        <th>Tipo do Couro</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                    <tr>
                        @php
                            $segment_search = New App\Models\Segment;
                            $segment = $segment_search->find($product->id_segment);

                            $leather_type_search = New App\Models\Leather_type;
                            $leather_type = $leather_type_search->find($product->id_leather_type);
                        @endphp
                        <td><input type="radio" name="{{$product->description}}" id="{{$product->id}}"></td>
                        <td>{{$product->id}}</td>
                        <td>{{$product->description}}</td>
                        <td>{{$segment->name}}</td>
                        <td>{{$leather_type->name}}</td>
                        <td class="text-center in-line">
                            <form method="POST" action="{{ url("client/$product->id_client/products/$product->id") }}">
                              
                                <a href="{{ url("client/$product->id_client/products/$product->id/edit") }}"><i class="fas fa-pen"></i></a>
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
            <div class="d-flex justify-content-center">
                {{ $products->links() }}
            </div>
        </div>
       
        </div>
        <a href="{{route('client.index')}}" class="btn btn-primary mt-2">Voltar</a>
    </div>
   
</div>



@endsection