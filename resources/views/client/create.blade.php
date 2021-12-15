@extends('templates.menuLayout')

@section('script')
    <script src="{{url('assets/js/client/create.js')}}"></script>
@endsection

@section('content')
    <div class="container-fluid container-default p-3">
        @if ($errors->all())
            <div class="alert alert-danger mt-1" role="alert">
                @foreach ($errors->all() as $error)
                    {{ $error }}
                @endforeach
            </div>
        @endif
        @if (isset($client))
            <form name="formEdit" id="formEdit" action="{{ url("client/$client->id") }}" method="POST">
                @method('PUT')
            @else
                <form name="formCad" id="formCad" action="{{ url('client') }}" method="POST">
        @endif
        @csrf
        <div>
            <h4>
                @if (isset($client)) Editar @else Cadastrar @endif
                Cliente
            </h4>
            <div class="row">
                <div class="form-group col-sm">
                    <label for="company_name">Nome da empresa *</label>
                    <input type="text" id="company_name" name="company_name" class="form-control" placeholder=""
                        value="{{ $client->company_name ?? old('company_name') }}">
                </div>
                <div class="form-group col-sm">
                    <label for="CNPJ">CNPJ </label>
                    <input type="text" id="CNPJ" name="CNPJ" class="form-control" placeholder=""
                        value="{{ $client->CNPJ ?? old('CNPJ') }}" maxlength="18">
                </div>
            </div>
            <div class="row mt-2">
                <div class="form-group col-6">
                    <label for="contact_name">Nome do Contato *</label>
                    <input type="text" id="contact_name" name="contact_name" class="form-control" placeholder=""
                        value="{{ $client->contact_name ?? old('contact_name') }}">
                </div>
                <div class="form-group col-3">
                    <label for="phone">Telefone *</label>
                    <input type="text" id="phone" name="phone" class="form-control" placeholder=""
                        value="{{ $client->phone ?? old('phone') }}" maxlength="10">
                </div>
                <div class="form-group col-3">
                    <label for="email">Email </label>
                    <input type="text" id="email" name="email" class="form-control" placeholder="Ex: exemplo@dominio.com"
                        value="{{ $client->email ?? old('email') }}">
                </div>
                <div class="container mt-2">
                    <h4>
                        Endereço
                    </h4>
                    <div class="row">
                        @php
                            if (isset($address)) {
                                $state_serach = new App\Models\State();
                                $states_result = $state_serach->find($address->id_state);
                            
                                $city_search = new App\Models\Cities();
                                $cities_result = $city_search->find($address->id_city);
                            }
                        @endphp
                        <div class="form-group col-md-5 ">
                            <label for="CEP">CEP </label>
                            <input type="text" class="form-control" name="CEP" id="CEP" placeholder=""
                                value="{{ $address->CEP ?? old('CEP') }}" maxlength="9">
                        </div>
                        {{-- <div class="form-group col-sm ">
                            <label for="id_state">Estado *</label>
                            <select class="form-control" name="id_state" id="id_state">
                                <option value="{{ $states_result->id ?? '' }}">
                                    {{ $states_result->name ?? 'Selecione' }} </option>
                                @foreach ($state as $states)
                                    <option value="{{ $states->id }}">{{ $states->name }}</option>
                                @endforeach
                            </select>
                        </div> --}}
                        <div class="form-group col-md-2 ">
                            <label for="uf">UF </label>
                            <input type="text" class="form-control" name="id_state" id="uf" placeholder=""
                                value="{{ $states_result->name ?? old('id_state')}}">
                        </div>
                        {{-- <div class="form-group col-sm ">
                            <label for="id_city">Cidade *</label>
                            <select class="form-control" name="id_city" id="id_city">
                                <option value="{{ $cities_result->id ?? '' }}">
                                    {{ $cities_result->name ?? 'Selecione' }} </option>
                                @foreach ($city as $cities)
                                    <option value="{{ $cities->id }}">{{ $cities->name }}</option>
                                @endforeach
                            </select>
                        </div> --}}
                        <div class="form-group col-md-5">
                            <label for="city">Cidade </label>
                            <input type="text" class="form-control" name="id_city" id="localidade" placeholder=""
                                value="{{ $cities_result->name ?? old('id_city')}}">
                        </div>
                    </div>
                    <div class="row ">
                        <div class="form-group col-sm  mt-2">
                            <label for="street">Rua *</label>
                            <input type="text" class="form-control" name="street" id="logradouro" placeholder=""
                                value="{{ $address->street ?? old('street') }}">
                        </div>
                        <div class="form-group col-2 mt-2">
                            <label for="number">Número *</label>
                            <input type="text" class="form-control" name="number" id="number" placeholder=""
                                value="{{ $address->number ?? old('number') }}">
                        </div>
                    </div>
                    <div class="row ">
                        <div class="form-group col-sm  mt-2">
                            <label for="neighborhoods">Bairro *</label>
                            <input type="text" class="form-control" name="neighborhoods" id="bairro" placeholder=""
                                value="{{ $address->neighborhoods ?? old('neighborhoods') }}">
                        </div>
                        <div class="form-group col-sm mt-2">
                            <label for="complements">Complemento</label>
                            <input type="text" class="form-control" name="complements" id="complemento" placeholder=""
                                value="{{ $address->complements ?? old('complements') }}">
                        </div>
                    </div>
                    <div class="row justify-content-between">
                        <div class=" col-4">
                            <input type="submit" class="btn btn-primary mt-2" name="submit" id="submit" value=" @if (isset($client)) Editar @else Cadastrar @endif ">
                                </div>
                                <div class=" col-4 text-end">
                            <a href="{{ route('client.index') }}" class="btn btn-danger mt-2">Cancelar</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </form>

    </div>
@endsection
