@extends('templates.menuLayout')

@section('content')

    <div class="container-default col-8 mt-2">
        
        <div class="container">
          
                <h3>
                    @if (isset($address)) Editar @else Cadastrar @endif Endereço
                </h3>
          
            @if (isset($address))
                <form name="formEdit" id="formEdit" action="{{ url("address/$address->id") }}" method="POST">
                    @method('PUT')
                @else
                    <form name="formCad" id="formCad" action="{{ url('address') }}" method="POST">
            @endif
            @csrf

            <div class="row">
                @php
                    if (isset($address)) {
                        $state_serach = new App\Models\State();
                        $states_result = $state_serach->find($address->id_state);
                    
                        $city_search = new App\Models\Cities();
                        $cities_result = $city_search->find($address->id_city);
                    }
                @endphp
                <div class="col-3 form-group mt-2">
                    <label for="CEP">CEP</label>
                    <input type="text" class="form-control" name="CEP" id="CEP" placeholder="CEP"
                        value="{{ $address->CEP ?? '' }}" required>
                </div>

                <div class="col-sm form-group mt-2">
                    <label for="id_state">Estado</label>
                    <select class="form-control" name="id_state" id="id_state">
                        <option value="{{ $states_result->id ?? '' }}">{{ $states_result->name ?? 'Estado' }} </option>
                        @foreach ($state as $states)
                            <option value="{{ $states->id }}">{{ $states->name }}</option>
                        @endforeach
                    </select>
                </div>


                <div class="col-sm form-group mt-2">
                    <label for="id_city">Cidade</label>
                    <select class="form-control" name="id_city" id="id_city">
                        <option value="{{ $cities_result->id ?? '' }}">{{ $cities_result->name ?? 'Cidade' }} </option>
                        @foreach ($city as $cities)
                            <option value="{{ $cities->id }}">{{ $cities->name }}</option>
                        @endforeach
                    </select>
                </div>

            </div>

            <div class="row ">

                <div class="col-10 form-group mt-2">
                    <label for="street">Rua</label>
                    <input type="text" class="form-control" name="street" id="street" placeholder="Rua"
                        value="{{ $address->street ?? '' }}" required>
                </div>

                <div class="col-2 form-group mt-2">
                    <label for="number">Número</label>
                    <input type="text" class="form-control" name="number" id="number" placeholder="Nº"
                        value="{{ $address->number ?? '' }}" required>
                </div>

            </div>


            <div class="row ">
                <div class="col-sm form-group mt-2">
                    <label for="neighborhoods">Bairro</label>
                    <input type="text" class="form-control" name="neighborhoods" id="neighborhoods" placeholder="Bairro"
                        value="{{ $address->neighborhoods ?? '' }}" required>
                </div>

                <div class="col-sm form-group mt-2">
                    <label for="complements">Complemento</label>
                    <input type="text" class="form-control" name="complements" id="complements" placeholder="Complemento"
                        value="{{ $address->complements ?? '' }}" required>
                </div>
            </div>


            </form>
        </div>
    </div>
    <div class="row justify-content-start">
        <div class="col-2 form-group">

            <input type="submit" class="form-control btn-primary mt-2" name="submit" id="submit" value=" @if (isset($address)) Editar @else Cadastrar @endif ">
            </div>
        </div>
@endsection
