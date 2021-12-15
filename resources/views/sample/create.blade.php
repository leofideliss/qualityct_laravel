@extends('templates.menuLayout')

@section('script')
    <script src="{{url('assets/js/sample/create.js')}}"></script>
@endsection

@section('content')

<div class="contaienr-fluid container-default p-3">
    @if ($errors->all())
    @foreach ($errors as $error)
    <div class="alert alert-danger mt-1" role="alert">
        {{ $error }}
    </div>
    @endforeach
    @endif

    @if (isset($sample))
    <form action="{{ route('sample.update', $sample->op_number) }}" id="formEdit" name="formEdit" method="POST">
        @method('PUT')
        @else
        <form action="{{ route('sample.store') }}" id="formCad" name="formCad" method="POST">
            @endif
            @csrf
            <div class="row justify-content-start">
                <h4>@if(isset($sample))Editar @else Definir @endif amostra</h4>
            </div>
            @php
            if (isset($sample)) {
            $client_search = new App\Models\Clients();
            $client_result = $client_search->find($sample->id_client);

            $product_search = new App\Models\Products();
            $product_result = $product_search->find($sample->id_product);
            }
            @endphp
            <div class="row">
                <div class="form-group col-sm">
                    <label for="id_client">Cliente *</label>
                    <select class="form-control" name="id_client" id="id_client" >
                        <option value="{{ $client_result->id ?? '' }}">{{ $client_result->contact_name ?? 'Selecione' }}
                        </option>
                        @foreach ($clients as $client)
                        <option value="{{ $client->id }}">{{ $client->contact_name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group col-sm">
                    <label for="id_product">Produto *</label>
                    <select class="form-control" name="id_product" id="id_product">
                        <option value="{{ $product_result->id ?? '' }}">
                            {{ $product_result->description ?? '--- Selecione ---' }}</option>
              
                    </select>
                </div>
            </div>
            <div class="row mt-2">
                <div class="form-group col-sm">
                    <label for="op_number">Ordem de produção *</label>
                    <input class="form-control" type="text" name="op_number" id="op_number"
                        value="{{$sample->op_number ?? ''}}" maxlength="6">
                </div>

                <div class="form-group col-sm">
                    <label for="measure">Medida da amostra</label>
            <select name="measure" id="measure" class="form-control">
                <option value="{{$sample->measure ?? ''}}">{{$sample->measure ?? 'Selecione'}}</option>
                <option value="A4(21x29,7 cm)">A4(21x29,7 cm)</option>
                <option value="A5(14,8x21 cm)">A5(14,8x21 cm)</option>
                <option value="A6(10,5x14,8 cm)">A6(10,5x14,8 cm)</option>
                <option value="A7(7,4x10,5 cm)">A7(7,4x10,5 cm)</option>
            </select>
                </div>
           
                <div class="form-group col-sm">
                    <label for="date_col">Data da coleta *</label>
                    <input class="form-control" type="date" name="date_col" id="date_col"  value="{{date("Y-m-d", strtotime($sample->date_col ?? date("Y-m-d H:i:s")))}}">
                </div>
            </div>

            <div class="row mt-2">
                <div class="form-group">
                    <label for="obs">Observação</label>
                    <textarea class="form-control" id="obs" name="obs" rows="3">{{$sample->obs ?? ''}}</textarea>
                </div>
            </div>
            
            <div class="row justify-content-between">
                <div class=" col-4">
                    <input type="submit" class="btn btn-primary mt-2" name="submit" id="submit"
                        value=" @if (isset($sample)) Editar @else Cadastrar @endif ">
                </div>
                <div class=" col-4 text-end">
                    <a href="{{ route('sample.index') }}" class="btn btn-danger mt-2">Cancelar</a>
                </div>
            </div>
        </form>

</div>
@endsection