@extends('templates.menuLayout')

@section('content')
<div class="container-default col-5 m-2 p-3">
    <div class="contaienr">

        <form action="{{ route('products.dirStore') }}" id="formCad" name="formCad" method="POST">

            <h3>
                @if (isset($products)) Editar @else Cadastrar @endif
                Produtos
            </h3>
            @csrf

            <div class="form-group col-sm">
                <label for="id_client">Cliente *</label>
                <select class="form-control" name="id_client" id="id_client">
                    <option value="{{ $client_result->id ?? '' }}">
                        {{ $client_result->contact_name ?? '--- Selecione ---' }}
                    </option>
                    @foreach ($clients as $client)
                    <option value="{{ $client->id }}">{{ $client->contact_name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group mt-2">
                <label for="color">Cor</label>
                <input type="text" class="form-control" placeholder="Cor" id="color" name="color">
            </div>

            <div class="form-group mt-2">
                <label for="article">Artigo</label>
                <input type="text" class="form-control" placeholder="Artigo" id="article" name="article">
            </div>
            {{-- <div class="form-group mt-2">
                <label for="class">Classe</label>
                <input type="text" class="form-control" placeholder="Classe" id="class" name="class">
            </div> --}}
            <div class="form-group mt-2">
                <label for="thickness">Espessura</label>
                <input type="text" class="form-control" placeholder="Espessura" id="thickness" name="thickness" maxlength="8">
            </div>



            <div class="form-group mt-2">
                @php
                if (isset($products)) {
                $segment_search = new App\Models\Segments();
                $segment_result = $segment_search->find($products->id_segments);

                $leather_search = new App\Models\Leather_type();
                $leather_result = $leather_search->find($products->id_leather_type);
                }

                @endphp
                <label for="id_segment">Segmento</label>
                <select name="id_segment" id="id_segment" class="form-control">
                    <option value="{{ $segment_result->id ?? '' }}">{{ $segment_result->name ?? 'Segmento' }}</option>
                    @foreach ($segments as $segment)
                    <option value="{{ $segment->id }}">{{ $segment->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group mt-2">
                <label for="id_leather_type">Tipo de Couro</label>
                <select name="id_leather_type" id="id_leather_type" class="form-control">
                    <option value="{{ $leather_result->id ?? '' }}">{{ $leather_result->name ?? 'Tipo de Couro' }}
                    </option>
                    @foreach ($leather_types as $leather_type)
                    <option value="{{ $leather_type->id }}">{{ $leather_type->name }}</option>
                    @endforeach
                </select>

            </div>
            <div class="row justify-content-start">
                <div class=" col-4">
                    <input type="submit" class="btn btn-primary mt-2" name="submit" id="submit"
                        value=" @if (isset($products)) Editar @else Cadastrar @endif ">
                </div>
            </div>
        </form>
    </div>
</div>
@endsection